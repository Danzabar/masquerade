<?php namespace Masquerade\Data;

use Masquerade\Exceptions,
	Masquerade\Data\ClassExtraction;

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
	 * Instance of the serialize object
	 *
	 * @var Object
	 */
	protected $serializer;

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
				// Extract Closures
				if(get_class($match['value']) == 'Closure') {
					return $this->closureExtract($match);
				}
				// Extract Classes
				return $this->classExtract($match);
				break;
		}

		throw new Exceptions\UnexpectedMaskValue($match['value'], $match['raw']);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function closureExtract(Array $match)
	{
		return call_user_func_array($match['value'], $match['params']);	
	}

	/**
	 * Extracts value from class
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function classExtract(Array $match)
	{
		$extract = new ClassExtraction(get_class($match['value']), $match);

		return $extract->extract();		
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
