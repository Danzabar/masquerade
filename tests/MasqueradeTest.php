<?php

use Masquerade\Masquerade;

/**
 * The test case for the main masquerade class
 *
 * @package Masquerade
 * @subpackage Tests
 * @author Dan Cox
 */
class MasqueradeTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * Instance of the masquerade class
	 *
	 * @var Object
	 */
	protected $masquerade;

	/**
	 * Set up test env
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->masquerade = new Masquerade;
	}

	/**
	 * Test that the collection is an instance of collection
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_instanceOfCollection()
	{
		$this->assertInstanceOf('Masquerade\Collection\Collection', $this->masquerade->collection());
	}

	/**
	 * Test that the method of the collection defaults to collection bag
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_instanceOfCollectionBag()
	{
		$this->assertInstanceOf('Masquerade\Collection\CollectionBag', $this->masquerade->collection()->getMethod());
	}

} // END class MasqueradeTest extends \PHPUnit_Framework_TestCase
