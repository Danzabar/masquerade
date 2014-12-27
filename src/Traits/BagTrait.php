<?php namespace Masquerade\Traits;

/**
 * The Bag trait adds magic getters and setters onto a collection method class,
 * In an easier fashion than writing them for each.
 *
 */
Trait BagTrait
{
	
	/**
	 * Gets a value based on its name
	 *
	 * @return Mixed
	 * @author Dan Cox
	 */
	public function __get($name)
	{
		if(array_key_exists($name, $this->values))
		{
			return $this->values[$name];
		}

		return NULL;
	}

	/**
	 * Sets a value
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __set($name, $value)
	{	
		$this->values[$name] = $value;

		return $this;
	}

	/**
	 * Magic isset method
	 *
	 * @return Boolean
	 * @author Dan Cox
	 */
	public function __isset($name)
	{
		return array_key_exists($name, $this->values);
	}

}
