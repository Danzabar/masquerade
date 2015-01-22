<?php namespace Masquerade\Traits;

/**
 * The Bag trait adds magic getters and setters onto a collection method class,
 * In an easier fashion than writing them for each.
 *
 */
Trait BagTrait
{

	/**
	 * An array of mapped mask values
	 *
	 * @var Array
	 */
	protected $values;

	/**
	 * Returns a single mask value
	 *
	 * @return Mixed
	 * @author Dan Cox
	 */
	public function get($key)
	{
		return $this->values[$key];
	}

	/**
	 * Adds a mask
	 *
	 * @return $this
	 * @author Dan Cox
	 */
	public function add($key, $value)
	{
		$this->values[$key] = $value;

		return $this;
	}

	/**
	 * Checks if a key exists in the collection
	 *
	 * @return Boolean
	 * @author Dan Cox
	 */
	public function has($key)
	{
		return array_key_exists($key, $this->values);
	}

	/**
	 * Returns everything
	 *
	 * @return Array
	 * @author Dan Cox
	 */
	public function all()
	{
		return $this->values;
	}

}
