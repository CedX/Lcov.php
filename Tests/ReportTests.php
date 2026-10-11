<?php declare(strict_types=1);
namespace Belin\Lcov;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\{Test, TestDox};

/**
 * Tests the features of the {@see Report} class.
 */
#[TestDox("Report")]
class ReportTests extends TestCase {

	/**
	 * The test fixture.
	 */
	private static string $coverage;

	/**
	 * Method invoked before the first test is run.
	 */
	public static function setUpBeforeClass(): void {
		self::$coverage = file_get_contents("Resources/Lcov.info") ?: "";
	}

	#[Test, TestDox("parse()")]
	public function parse(): void {
		$report = Report::parse(self::$coverage);

		// It should have a test name.
		$report->testName |> Should::be("Example");

		// It should contain three source files.
		$report->sourceFiles |> count(...) |> Should::be(3);
		$report->sourceFiles[0] |> Should::beOfType(SourceFile::class);
		$report->sourceFiles[0]->path |> Should::be("/home/CedX/Lcov.php/Fixture.php");
		$report->sourceFiles[1]->path |> Should::be("/home/CedX/Lcov.php/Func1.php");
		$report->sourceFiles[2]->path |> Should::be("/home/CedX/Lcov.php/Func2.php");

		// It should have detailed branch coverage.
		/** @var BranchCoverage $branches */
		$branches = $report->sourceFiles[1]->branches;
		$branches->data |> count(...) |> Should::be(4);
		$branches->found |> Should::be(4);
		$branches->hit |> Should::be(4);

		[$data] = $branches->data;
		$data |> Should::beOfType(BranchData::class);
		$data->lineNumber |> Should::be(8);

		// It should have detailed function coverage.
		/** @var FunctionCoverage $functions */
		$functions = $report->sourceFiles[1]->functions;
		$functions->data |> count(...) |> Should::be(1);
		$functions->found |> Should::be(1);
		$functions->hit |> Should::be(1);

		[$data] = $functions->data;
		$data |> Should::beOfType(FunctionData::class);
		$data->functionName |> Should::be("func1");

		// It should have detailed line coverage.
		/** @var LineCoverage $lines */
		$lines = $report->sourceFiles[1]->lines;
		$lines->data |> count(...) |> Should::be(9);
		$lines->found |> Should::be(9);
		$lines->hit |> Should::be(9);

		[$data] = $lines->data;
		$data |> Should::beOfType(LineData::class);
		$data->checksum |> Should::be("5kX7OTfHFcjnS98fjeVqNA");

		// It should throw an exception if the report is invalid or empty.
		$this->expectException(\InvalidArgumentException::class);
		Report::parse("TN:Example");
	}

	#[Test, TestDox("tryParse()")]
	public function tryParse(): void {
		Report::tryParse(self::$coverage) |> Should::beOfType(Report::class);
		Report::tryParse("TN:Example") |> Should::beNull();
	}

	#[Test, TestDox("__toString()")]
	public function testToString(): void {
		(string) new Report("") |> Should::beEmpty();

		$sourceFile = new SourceFile("");
		(string) new Report("LcovTest", [$sourceFile]) |> Should::be("TN:LcovTest\n$sourceFile");
	}
}
