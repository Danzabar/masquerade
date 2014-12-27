<?php

use Masquerade\Collection\Collection;

/**
 * The test case for the Collection class
 *
 * @package Masquerade
 * @subpackage Tests\Collection
 * @author Dan Cox
 */
class CollectionTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * Instance of the collection class
	 *
	 * @var Object
	 */
	protected $collection;

	/**
	 * Set up the test
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->collection = new Collection;
	}

	/**
	 * Test that the default method is an instance of the collection bag
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_methodIsInstanceOfBag()
	{
		$this->assertInstanceOf('Masquerade\Collection\CollectionBag', $this->collection->getMethod());
	}

	/**
	 * Test setting a new method
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_getSetMethod()
	{
		$this->collection->setMethod(Array());

		$this->assertEquals(Array(), $this->collection->getMethod());
	}




} // END class CollectionTest extends \PHPUnit_Framework_TestCase
