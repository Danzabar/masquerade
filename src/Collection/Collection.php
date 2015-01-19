<?php namespace Masquerade\Collection;

use Masquerade\Collection\CollectionBag;

/**
 * The collection class stores mask values that are added directly or are specifically designated values.
 *
 * @package Masquerade
 * @subpackage Collection
 * @author Dan Cox
 */
class Collection
{

	/**
	 * The collection method class
	 *
	 * @var Object
	 */
	protected $method;

	/**
	 * Sets up the class dependencies
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($colMethod = NULL)
	{
		$this->method = (!is_null($colMethod) ? $colMethod : new CollectionBag);
	}

	/**
	 * Adds a new collection entry
	 *
	 * @return Collection
	 * @author Dan Cox
	 */
	public function add($key, $value)
	{
		$this->method->add($key, $value);

		return $this;
	}

	/**
	 * Gets the value of method
	 *
	 * @return Object
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * Sets the value of method
	 *
	 * @param Object $method The collection method class
	 *
	 * @return Collection
	 */
	public function setMethod($method)
	{
		$this->method = $method;

		return $this;
	}

} // END class Collection
