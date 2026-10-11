<?php declare(strict_types=1);
namespace Belin\Lcov;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\{Test, TestDox};

/**
 * Tests the features of the {@see SourceFile} class.
 */
#[TestDox("SourceFile")]
class SourceFileTests extends TestCase {

	#[Test, TestDox("__toString()")]
	public function testToString(): void {
		(string) new SourceFile("") |> Should::be("SF:\nend_of_record");

		$sourceFile = SourceFile::withCoverage("/home/CedX/Lcov.php");
		$format = "SF:/home/CedX/Lcov.php\n$sourceFile->functions\n$sourceFile->branches\n$sourceFile->lines\nend_of_record";
		(string) $sourceFile |> Should::be($format);
	}
}
