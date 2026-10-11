<?php declare(strict_types=1);
namespace Belin\Lcov;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\{Test, TestDox};

/**
 * Tests the features of the {@see FunctionCoverage} class.
 */
#[TestDox("FunctionCoverage")]
class FunctionCoverageTests extends TestCase {

	#[Test, TestDox("__toString()")]
	public function testToString(): void {
		(string) new FunctionCoverage |> Should::be("FNF:0\nFNH:0");

		$data = new FunctionData(executionCount: 3, functionName: "main", lineNumber: 127);
		(string) new FunctionCoverage(data: [$data], found: 23, hit: 11) |> Should::be("$data\nFNF:23\nFNH:11");
	}
}
