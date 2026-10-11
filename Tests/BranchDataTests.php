<?php declare(strict_types=1);
namespace Belin\Lcov;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\{Test, TestDox};

/**
 * Tests the features of the {@see BranchData} class.
 */
#[TestDox("BranchData")]
class BranchDataTests extends TestCase {

	#[Test, TestDox("__toString()")]
	public function testToString(): void {
		(string) new BranchData |> shouldBe("BRDA:0,0,0,-");
		(string) new BranchData(blockNumber: 3, branchNumber: 2, lineNumber: 127, taken: 1) |> shouldBe("BRDA:127,3,2,1");
	}
}
