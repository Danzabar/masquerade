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

	
} // END class CollectionBag
