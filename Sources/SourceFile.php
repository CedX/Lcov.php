<?php declare(strict_types=1);
namespace Belin\Lcov;

/**
 * Provides the coverage data of a source file.
 */
class SourceFile implements \Stringable {

	/**
	 * The branch coverage.
	 */
	public ?BranchCoverage $branches;

	/**
	 * The function coverage.
	 */
	public ?FunctionCoverage $functions;

	/**
	 * The line coverage.
	 */
	public ?LineCoverage $lines;

	/**
	 * The path to the source file.
	 */
	public string $path;

	/**
	 * Creates a new source file.
	 * @param string $path The path to the source file.
	 * @param BranchCoverage|null $branches The branch coverage.
	 * @param FunctionCoverage|null $functions The function coverage.
	 * @param LineCoverage|null $lines The line coverage.
	 */
	public function __construct(string $path, ?BranchCoverage $branches = null, ?FunctionCoverage $functions = null, ?LineCoverage $lines = null) {
		$this->branches = $branches;
		$this->functions = $functions;
		$this->lines = $lines;
		$this->path = $path;
	}

	/**
	 * Creates a new instance with default coverage values.
	 * @param string $path The path to the source file.
	 * @return SourceFile The newly created source file.
	 */
	public static function withCoverage(string $path): self {
		return new self($path, branches: new BranchCoverage, functions: new FunctionCoverage, lines: new LineCoverage);
	}

	/**
	 * Returns a string representation of this object.
	 * @return string The string representation of this object.
	 */
	public function __toString(): string {
		$output = [Token::SourceFile->value . ":$this->path"];
		if ($this->functions) $output[] = (string) $this->functions;
		if ($this->branches) $output[] = (string) $this->branches;
		if ($this->lines) $output[] = (string) $this->lines;
		$output[] = Token::EndOfRecord->value;
		return implode("\n", $output);
	}
}
