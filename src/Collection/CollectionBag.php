<?php namespace Masquerade\Collection;

use Masquerade\Interfaces\CollectionInterface,
	Masquerade\Traits;

/**
 * Used by the Collection class to store and retreive values for namespaces
 *
 * @package Masquerade
 * @subpackage Collection
 * @author Dan Cox
 */
class CollectionBag implements CollectionInterface
{
	use Traits\BagTrait;

	/**
	 * An associative array of values
	 *
	 * @var Array
	 */
	protected $values;

	
} // END class CollectionBag
