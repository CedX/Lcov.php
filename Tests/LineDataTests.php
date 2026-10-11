<?php declare(strict_types=1);
namespace Belin\Lcov;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\{Test, TestDox};

/**
 * Tests the features of the {@see LineData} class.
 */
#[TestDox("LineData")]
class LineDataTests extends TestCase {

	#[Test, TestDox("__toString()")]
	public function testToString(): void {
		(string) new LineData |> Should::be("DA:0,0");
		(string) new LineData(
			checksum: "ed076287532e86365e841e92bfc50d8c",
			executionCount: 3,
			lineNumber: 127
		) |> Should::be("DA:127,3,ed076287532e86365e841e92bfc50d8c");
	}
}
