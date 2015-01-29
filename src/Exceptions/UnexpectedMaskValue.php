<?php namespace Masquerade\Exceptions;

/**
 * Exception class for when a masks value cannot be used
 *
 * @package Masquerade
 * @subpackage Exceptions
 * @author Dan Cox
 */
class UnexpectedMaskValue extends \Exception
{
	/**
	 * The value
	 *
	 * @var Mixed
	 */
	protected $value;

	/**
	 * The mask
	 *
	 * @var string
	 */
	protected $mask;

	/**
	 * Fire exception
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($value, $mask, $code = 0, \Exception $previous = NULL)
	{
		$this->value = $value;
		$this->mask = $mask;

		parent::__construct("The mask ($mask) value is an invalid format and cannot be used.", $code, $previous);
	}

	/**
	 * Returns the value
	 *
	 * @return Mixed
	 * @author Dan Cox
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Returns the Mask
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function getMask()
	{
		return $this->mask;
	}

} // END class UnexpectedMaskValue extends \Exception
