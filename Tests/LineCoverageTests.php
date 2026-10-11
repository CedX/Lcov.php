<?php declare(strict_types=1);
namespace Belin\Lcov;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\{Test, TestDox};

/**
 * Tests the features of the {@see LineCoverage} class.
 */
#[TestDox("LineCoverage")]
class LineCoverageTests extends TestCase {

	#[Test, TestDox("__toString()")]
	public function testToString(): void {
		(string) new LineCoverage |> Should::be("LF:0\nLH:0");

		$data = new LineData(executionCount: 3, lineNumber: 127);
		(string) new LineCoverage(data: [$data], found: 23, hit: 11) |> Should::be("$data\nLF:23\nLH:11");
	}
}
