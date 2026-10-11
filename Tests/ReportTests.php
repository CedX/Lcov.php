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
		$report->testName |> shouldBe("Example");

		// It should contain three source files.
		$report->sourceFiles |> count(...) |> shouldBe(3);
		$report->sourceFiles[0] |> shouldBeOfType(SourceFile::class);
		$report->sourceFiles[0]->path |> shouldBe("/home/CedX/Lcov.php/Fixture.php");
		$report->sourceFiles[1]->path |> shouldBe("/home/CedX/Lcov.php/Func1.php");
		$report->sourceFiles[2]->path |> shouldBe("/home/CedX/Lcov.php/Func2.php");

		// It should have detailed branch coverage.
		/** @var BranchCoverage $branches */
		$branches = $report->sourceFiles[1]->branches;
		$branches->data |> count(...) |> shouldBe(4);
		$branches->found |> shouldBe(4);
		$branches->hit |> shouldBe(4);

		[$data] = $branches->data;
		$data |> shouldBeOfType(BranchData::class);
		$data->lineNumber |> shouldBe(8);

		// It should have detailed function coverage.
		/** @var FunctionCoverage $functions */
		$functions = $report->sourceFiles[1]->functions;
		$functions->data |> count(...) |> shouldBe(1);
		$functions->found |> shouldBe(1);
		$functions->hit |> shouldBe(1);

		[$data] = $functions->data;
		$data |> shouldBeOfType(FunctionData::class);
		$data->functionName |> shouldBe("func1");

		// It should have detailed line coverage.
		/** @var LineCoverage $lines */
		$lines = $report->sourceFiles[1]->lines;
		$lines->data |> count(...) |> shouldBe(9);
		$lines->found |> shouldBe(9);
		$lines->hit |> shouldBe(9);

		[$data] = $lines->data;
		$data |> shouldBeOfType(LineData::class);
		$data->checksum |> shouldBe("5kX7OTfHFcjnS98fjeVqNA");

		// It should throw an exception if the report is invalid or empty.
		$this->expectException(\InvalidArgumentException::class);
		Report::parse("TN:Example");
	}

	#[Test, TestDox("tryParse()")]
	public function tryParse(): void {
		Report::tryParse(self::$coverage) |> shouldBeOfType(Report::class);
		Report::tryParse("TN:Example") |> shouldBeNull();
	}

	#[Test, TestDox("__toString()")]
	public function testToString(): void {
		(string) new Report("") |> shouldBeEmpty();

		$sourceFile = new SourceFile("");
		(string) new Report("LcovTest", [$sourceFile]) |> shouldBe("TN:LcovTest\n$sourceFile");
	}
}
