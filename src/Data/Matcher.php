<?php namespace Masquerade\Data;

use Masquerade\Interfaces\MatchInterface,
	Masquerade\Collection\Collection;

/**
 * The matcher class matches and formats mask names in strings
 *
 * @package Masquerade
 * @subpackage Data
 * @author Dan Cox
 */
class Matcher implements MatchInterface
{
	/**
	 * The initial string
	 *
	 * @var string
	 */
	protected $str;

	/**
	 * An array of matches
	 *
	 * @var Array
	 */
	protected $matches;

	/**
	 * An Array of matches that have been formatted
	 *
	 * @var Array
	 */
	protected $formatted;

	/**
	 * The collection object
	 *
	 * @var Collection
	 */
	protected $collection;

	/**
	 * Loads string and collection object
	 *
	 * @return Matcher
	 * @author Dan Cox
	 */
	public function load($str, Collection $collection)
	{
		$this->str = $str;
		$this->collection = $collection;

		return $this;
	}

	/**
	 * Searchs the string for possible matches
	 *
	 * @return Matcher
	 * @author Dan Cox
	 */
	public function search()
	{
		preg_match('/[[A-Za-z0-9 ,"=]+?]/', $this->str, $this->matches);		

		// Format matches
		if(!empty($this->matches))
		{
			$this->format();
		}
	}

	/**
	 * Formats the matches into a an array with mapped params and *
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function format()
	{
		foreach($this->matches as $key => $match)
		{
			$potential = str_replace(['[', ']'], '', $match);

			// Seperate by comma
			$potential = explode(',', $potential);

			// The first value will be the mask name
			if($this->collection->getMethod()->has($potential[0]))
			{
				$name = $potential[0];

				$this->formatted[$name] = Array();
				
				// Remove the name from the array
				unset($potential[0]);

				$this->processValues($name, $potential);
			
			} else {
				// This isnt a mask
				unset($this->matches[$key]);	
			}
		}	
	}

	/**
	 * Processes a mask values
	 *
	 * @return Void
	 * @author Dan Cox
	 */
	public function processValues($name, $arr)
	{
		$this->formatted[$name] = Array();

		foreach($arr as $key => $value)
		{
			if(strstr($value, '=') !== false)
			{
				// Extract it's value
				$values = explode('=', $value);
				$val = str_replace(['\'', '"'], '', $values[1]);

				$this->formatted[$name]['params'][trim($values[0])] = $val;

			} else {
				// This gets added as a flag
				$this->formatted[$name]['params'][trim($value)] = TRUE;
			}
		}

		$this->formatted[$name]['value'] = $this->collection->getMethod()->get($name);
	}

	/**
	 * Returns the set of matches
	 *
	 * @return Array
	 * @author Dan Cox
	 */
	public function getMatches()
	{
		return $this->formatted;
	}

} // END class Matcher
