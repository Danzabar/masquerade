<?php namespace Masquerade\Data;

use Masquerade\Exceptions\InvalidClassMethodCalled;

/**
 * Class that extracts mask values from other classes
 *
 * @package Masquerade
 * @subpackage Data
 * @author Dan Cox
 */
class ClassExtraction
{
	/**
	 * Reflection instance
	 *
	 * @var Object
	 */
	protected $reflection;

	/**
	 * The Match array
	 *
	 * @var Array
	 */
	protected $match;

	/**
	 * Loads vars and mask details
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($className, Array $match)
	{
		$this->reflection = new \ReflectionClass($className);
		$this->match = $match;
	}

	/**
	 * Returns the mask value based on mask and params;
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function extract()
	{
		$method = NULL;

		$name = explode(',', $this->match['raw']);

		// Get the method
		if(strpos($name[0], '.')) 
		{
			$parts = explode('.', $name[0]);
			$method = str_replace(array('[', ']'), '', $parts[1]);

		} elseif(isset($this->match['params']['method'])) 
		{
			$method = $this->match['params']['method'];
			unset($this->match['params']['method']);	
		}

		if(!is_null($method)) 
		{
			return $this->fireMethod($method);
		}

		throw new InvalidClassMethodCalled($method, $this->match['raw']);
	}

	/**
	 * Fires the chosen method of the class
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function fireMethod($methodName)
	{
		if($this->reflection->hasMethod($methodName))
		{
			$method = $this->reflection->getMethod($methodName);
			$instance = $this->reflection->newInstance();
			return $method->invokeArgs($instance, $this->match['params']);
		}
		
		throw new InvalidClassMethodCalled($methodName, $this->match['raw']);		
	}
	

} // END class ClassExtraction
