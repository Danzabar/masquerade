<?php

use Masquerade\Data\Matcher,
	Masquerade\Collection\Collection;

/**
 * Test case for the Matcher class
 *
 * @package Masquerade
 * @subpackage Tests\Data
 * @author Dan Cox
 */
class MatcherTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * A collection instance
	 *
	 * @var Object
	 */
	protected $collection;

	/**
	 * Instance of matcher
	 *
	 * @var Object
	 */
	protected $matcher;

	/**
	 * Set up test env
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->collection = new Collection;
		$this->matcher = new Matcher;

		// Add a basic mask
		$this->collection->add('foo', 'bar');
	}

	/**
	 * Test loading a basic mask into the collection and rreturning value mapping
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_loadBasicMask()
	{
		$str = '[foo] will be bar';
		
		$this->matcher
			 ->load($str, $this->collection)
			 ->search();

		$matches = $this->matcher->getMatches();

		$this->assertEquals(Array('foo' => Array('value' => 'bar')), $matches); 
	}

	/**
	 * This test will look at return params from within the mask
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_advancedMask()
	{
		$str = '[foo, test="value", verbose] will be bar';

		$this->matcher
			 ->load($str, $this->collection)
			 ->search();

		$matches = $this->matcher->getMatches();

		$this->assertEquals(
			Array('foo' => Array('value' => 'bar', 'params' => Array('test' => 'value', 'verbose' => TRUE))),
			$matches
		);
	}

} // END class MatcherTest extends \PHPUnit_Framework_TestCase
