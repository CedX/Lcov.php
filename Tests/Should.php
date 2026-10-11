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
 * @param string $expectedType The expected type.
 * @return \Closure The closure that tests whether the specified object is an instance of the expected type.
 */
function shouldBeOfType(string $expectedType): \Closure {
	return match ($expectedType) {
		"array" => static fn($value) => Assert::assertIsArray($value),
		"bool", "boolean" => static fn($value) => Assert::assertIsBool($value),
		"double", "float" => static fn($value) => Assert::assertIsFloat($value),
		"int", "integer" => static fn($value) => Assert::assertIsInt($value),
		"object" => static fn($value) => Assert::assertIsObject($value),
		"string" => static fn($value) => Assert::assertIsString($value),
		default => static fn($value) => Assert::assertInstanceOf($expectedType, $value) // @phpstan-ignore argument.type
	};
}

/**
 * Tests whether the specified condition is true.
 * @return \Closure The closure that tests whether the specified condition is true.
 */
function shouldBeTrue(): \Closure {
	return static fn($actual) => Assert::assertTrue($actual);
}
