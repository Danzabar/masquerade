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
	 * Every collection method class should have a magic getter
	 *
	 */
	public function __get($name);

	/**
	 * A Setter to set values
	 *
	 */
	public function __set($name, $value);

	/**
	 * A magic isset to check if they have the values
	 *
	 */
	public function __isset($name);

}
