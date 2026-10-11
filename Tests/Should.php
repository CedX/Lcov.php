<?php declare(strict_types=1);
namespace Belin\Lcov;

use PHPUnit\Framework\Assert;

/**
 * Tests whether the specified values are equal.
 * @param mixed $expected The value expected by the test.
 * @return \Closure The closure that tests whether the actual value equals the expected value.
 */
function shouldBe(mixed $expected): \Closure {
	return static fn($actual) => Assert::assertEquals($expected, $actual);
}

/**
 * Tests whether the specified value is empty.
 * @return \Closure The closure that tests whether the specified value is empty.
 */
function shouldBeEmpty(): \Closure {
	return static fn($actual) => Assert::assertEmpty($actual);
}

/**
 * Tests whether the specified condition is false.
 * @return \Closure The closure that tests whether the specified condition is false.
 */
function shouldBeFalse(): \Closure {
	return static fn($actual) => Assert::assertFalse($actual);
}

/**
 * Tests whether the specified condition is `null`.
 * @return \Closure The closure that tests whether the specified condition is `null`.
 */
function shouldBeNull(): \Closure {
	return static fn($actual) => Assert::assertNull($actual);
}

/**
 * Tests whether the specified object is an instance of the expected type.
 * @param class-string<object> $expectedType The expected type.
 * @return \Closure The closure that tests whether the specified object is an instance of the expected type.
 */
function shouldBeOfType(string $expectedType): \Closure {
	return static fn($value) => Assert::assertInstanceOf($expectedType, $value);
}

/**
 * Tests whether the specified condition is true.
 * @return \Closure The closure that tests whether the specified condition is true.
 */
function shouldBeTrue(): \Closure {
	return static fn($actual) => Assert::assertTrue($actual);
}
