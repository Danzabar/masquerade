<?php namespace Masquerade;

use Masquerade\Collection\Collection,
	Masquerade\Data\Matcher;

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
	 * An instance of a MatchInterface enabled class
	 *
	 * @var Object
	 */
	protected $matcher;

	/**
	 * Set up the class vars
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($colMethod = NULL, $matcher = NULL)
	{
		$this->collection = new Collection($colMethod);
		$this->matcher = (!is_null($matcher) ? $matcher : new Matcher);
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

	/**
	 * Adds a value of mixed inheritance to the mask system
	 *
	 * @return Masquerade
	 * @author Dan Cox
	 */
	public function add($key, $value)
	{
		$this->collection->add($key, $value);
	}

	/**
	 * Uses the matcher and Replacement classes to search for matches and systematically replace them.
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function searchAndReplace($str)
	{
		$this->matcher->load($str, $this->collection);

		return $this->matcher->searchAndReplace();
	}

	
} // END class Masquerade
