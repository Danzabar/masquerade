<?php namespace Masquerade\Data;

use Masquerade\Interfaces\MatchInterface,
	Masquerade\Collection\Collection,
	Masquerade\Data\Replacement;

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
	 * Instance of the replacement class
	 *
	 * @var Object
	 */
	protected $replacement;

	/**
	 * Set up class vars
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct()
	{
		$this->formatted = Array();
	}

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
		preg_match_all('/\[[^\]]*\]/', $this->str, $this->matches);		

		// Format matches
		if(!empty($this->matches))
		{
			$this->matches = $this->matches[0];
			$this->format();
		}

		return $this;
	}

	/**
	 * Perform a search and replace matches
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function searchAndReplace()
	{
		$this->search();

		$this->replacement = new Replacement($this->formatted, $this->str);

		$this->replacement->replace();
		
		return $this->replacement->getStr();
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

			// Classes can have a dot seperator Class.method
			$mask = $potential[0];
			if(strpos($potential[0], '.') !== false) {
				$parts = explode('.', $potential[0]);
				$mask = $parts[0];
			}

			// The first value will be the mask name
			if($this->collection->getMethod()->has($mask))
			{
				$this->formatted[$mask] = Array();

				// Add the raw match so we can replace this
				$this->formatted[$mask]['raw'] = $match;
				$this->formatted[$mask]['params'] = Array();
				
				// Remove the name from the array
				unset($potential[0]);

				$this->processValues($mask, $potential);
			
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

	/**
	 * Returns the matches array
	 *
	 * @return Array
	 * @author Dan Cox
	 */
	public function getRawMatches()
	{
		// Reorder array incase any have been removed.
		$this->matches = array_values($this->matches);

		return $this->matches;
	}

} // END class Matcher
