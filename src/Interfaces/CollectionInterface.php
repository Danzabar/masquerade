<?php namespace Masquerade\Interfaces;

/**
 * The collection interface allows the extension of the Collection module
 * While adhering to its standards
 *
 *
 */
Interface CollectionInterface
{
	/**
	 * The get function that will return a single mask value
	 *
	 */
	public function get($key);

	/**
	 * Adds a mask into the Collection
	 *
	 */
	public function add($key, $value);

	/**
	 * Checks if the collection has this key
	 *
	 */
	public function has($key);

	/**
	 * Returns everything the collection has
	 *
	 */
	public function all();

}
