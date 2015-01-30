<?php namespace Masquerade\Exceptions;

/**
 * Exception class for invalid class methods
 *
 * @package Masquerade
 * @subpackage Exceptions
 * @author Dan Cox
 */
class InvalidClassMethodCalled extends \Exception
{

	/**
	 * Method attempted
	 *
	 * @var String
	 */
	protected $method;

	/**
	 * The Mask
	 *
	 * @var String
	 */
	protected $mask;

	/**
	 * Fire exception
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($method, $mask,  $code = 0, \Exception $previous = NULL)
	{
		$this->method = $method;
		$this->mask = $mask;

		parent::__construct("The mask $mask called the invalid method $method", $code, $previous);
	}

	/**
	 * Returns the method
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * Returns the mask
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function getMask()
	{
		return $this->mask;
	}

} // END class InvalidClassMethodCalled extends \Exception
