<?php declare(strict_types=1);
namespace Belin\Lcov;

use PHPUnit\Framework\Assert;

/**
 * Provides assertions for working with unit tests.
 */
class Should {

	/**
	 * Tests whether the specified values are equal.
	 * @param mixed $expected The value expected by the test.
	 * @return \Closure The closure that tests whether the actual value equals the expected value.
	 */
	public static function be(mixed $expected): \Closure {
		return static fn($actual) => Assert::assertEquals($expected, $actual);
	}

	/**
	 * Tests whether the specified sequence is empty.
	 * @return \Closure The closure that tests whether the specified sequence is empty.
	 */
	public static function beEmpty(): \Closure {
		return static fn($sequence) => Assert::assertEmpty($sequence);
	}

	/**
	 * Tests whether the specified condition is false.
	 * @return \Closure The closure that tests whether the specified condition is false.
	 */
	public static function beFalse(): \Closure {
		return static fn($condition) => Assert::assertFalse($condition);
	}

	/**
	 * Tests whether the specified value is `null`.
	 * @return \Closure The closure that tests whether the specified value is `null`.
	 */
	public static function beNull(): \Closure {
		return static fn($value) => Assert::assertNull($value);
	}

	/**
	 * Tests whether the specified value is an instance of the expected type.
	 * @param string $expectedType The expected type.
	 * @return \Closure The closure that tests whether the specified value is an instance of the expected type.
	 */
	public static function beOfType(string $expectedType): \Closure {
		return match ($expectedType) {
			"array" => static fn($value) => Assert::assertIsArray($value),
			"bool", "boolean" => static fn($value) => Assert::assertIsBool($value),
			"callable" => static fn($value) => Assert::assertIsCallable($value),
			"double", "float" => static fn($value) => Assert::assertIsFloat($value),
			"int", "integer" => static fn($value) => Assert::assertIsInt($value),
			"object" => static fn($value) => Assert::assertIsObject($value),
			"resource" => static fn($value) => Assert::assertIsResource($value),
			"string" => static fn($value) => Assert::assertIsString($value),
			default => static fn($value) => Assert::assertInstanceOf($expectedType, $value) // @phpstan-ignore argument.type
		};
	}

	/**
	 * Tests whether the specified condition is true.
	 * @return \Closure The closure that tests whether the specified condition is true.
	 */
	public static function beTrue(): \Closure {
		return static fn($condition) => Assert::assertTrue($condition);
	}

	/**
	 * Tests whether the specified string ends with the given suffix.
	 * @param non-empty-string $expectedSuffix The string expected to be a suffix of the tested value.
	 * @return \Closure The closure that tests whether the specified string ends with the given suffix.
	 */
	public static function endWith(string $expectedSuffix): \Closure {
		return static fn($value) => Assert::assertStringEndsWith($expectedSuffix, $value);
	}

	/**
	 * Tests whether the specified values are unequal.
	 * @param mixed $notExpected The value not expected by the test.
	 * @return \Closure The closure that tests whether the actual value does not equal the expected value.
	 */
	public static function notBe(mixed $notExpected): \Closure {
		return static fn($actual) => Assert::assertNotEquals($notExpected, $actual);
	}

	/**
	 * Tests whether the specified value is not `null`.
	 * @return \Closure The closure that tests whether the specified value is not `null`.
	 */
	public static function notBeNull(mixed $value): \Closure {
		return static fn($value) => Assert::assertNotNull($value);
	}

	/**
	 * Tests whether the specified string begins with the given prefix.
	 * @param non-empty-string $expectedPrefix The string expected to be a prefix of the tested value.
	 * @return \Closure The closure that tests whether the specified string begins with the given prefix.
	 */
	public static function startWith(string $expectedPrefix): \Closure {
		return static fn($value) => Assert::assertStringStartsWith($expectedPrefix, $value);
	}
}
