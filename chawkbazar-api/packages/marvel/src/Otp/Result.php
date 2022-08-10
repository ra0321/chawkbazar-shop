<?php


namespace Marvel\Otp;

use InvalidArgumentException;

class Result
{

	/**
	 * @var bool
	 */
	private $valid;

	/**
	 * @var array
	 */
	private $errors;

	/**
	 * @var string
	 */
	private $id;

	/**
	 * Result constructor.
	 * @param mixed $value => string $id | array $errors
	 */
	public function __construct($value)
	{
		if (is_string($value)) {
			$this->id = $value;
			$this->valid = true;
		} else if (is_array($value)) {
			$this->errors = $value;
			$this->valid = false;
		} else {
			throw new InvalidArgumentException('Invalid argument: Only string or array allowed.');
		}
	}

	/**
	 * @return bool
	 */
	public function isValid(): bool
	{
		return $this->valid;
	}

	/**
	 * @return array
	 */
	public function getErrors(): array
	{
		return $this->errors;
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}
}
