<?php namespace Masquerade;

use Masquerade\Collection\Collection;

/**
 * The control class, can be used to setup configuration.
 *
 * @package Masquerade
 * @author Dan Cox
 */
class Masquerade
{
	
	/**
	 * An instance of the collection class
	 *
	 * @var Object
	 */
	protected $collection;

	/**
	 * Set up the class vars
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($colMethod = NULL)
	{
		$this->collection = new Collection($colMethod);
	}

	/**
	 * Returns the collection instance
	 *
	 * @return Collection
	 * @author Dan Cox
	 */
	public function collection()
	{
		return $this->collection;
	}

	
} // END class Masquerade
