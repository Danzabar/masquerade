<?php namespace Masquerade\Data;


/**
 * The replacement class deals with replacing matched masks with actual content
 *
 * @package Masquerade
 * @subpackage Data
 * @author Dan Cox
 */
class Replacement
{
	/**
	 * An Array of matches and values/params
	 *
	 * @var Array
	 */
	protected $matches;

	/**
	 * The raw string
	 *
	 * @var string
	 */
	protected $str;

	/**
	 * Loads matches
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct(Array $matches = Array(), $str)
	{
		$this->matches = $matches;
		$this->str = $str;
	}

	/**
	 * Loops through the matches and replaces their value with the mask string
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function replace()
	{
		foreach($this->matches as $match)
		{
			$value = $this->extractValue($match);
			$this->insertValue($value, $match['raw']);
		}
	}

	/**
	 * Performs str_replace with value and match on the str
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function insertValue($value, $match)
	{
		$this->str = str_replace($match, $value, $this->str);
	}

	/**
	 * Checks the type of value and formats it, as we could be getting closures passed
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function extractValue(Array $match)
	{
		switch(gettype($match['value']))
		{
			case 'string':
				return $match['value'];
				break;
			case 'object':
				// Run the closure
				break;
		}
	}

	/**
	 * Returns the string
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function getStr()
	{
		return $this->str;
	}

} // END class Replacement
