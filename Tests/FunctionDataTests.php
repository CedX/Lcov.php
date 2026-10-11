<?php declare(strict_types=1);
namespace Belin\Lcov;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\{Test, TestDox};

/**
 * Tests the features of the {@see FunctionData} class.
 */
#[TestDox("FunctionData")]
class FunctionDataTests extends TestCase {

	#[Test, TestDox("__toString()")]
	public function testToString(): void {
		(string) new FunctionData |> Should::be("FN:0,\nFNDA:0,");
		(string) new FunctionData(executionCount: 3, functionName: "main", lineNumber: 127) |> Should::be("FN:127,main\nFNDA:3,main");
	}
}
