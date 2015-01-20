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

		// Add a closure
		$this->collection->add('zim', function($value = '') {
			
			if($value == '')
			{
				return 'no value';
			}

			return "$value value set";
		});
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

		$this->assertEquals(Array('foo' => Array('value' => 'bar', 'raw' => '[foo]')), $matches); 
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
			Array('foo' => Array('value' => 'bar', 'params' => Array('test' => 'value', 'verbose' => TRUE), 'raw' => '[foo, test="value", verbose]')),
			$matches
		);
	}

	/**
	 * Test the search and replace, uses both matcher and replacement classes
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_basicSearchAndReplace()
	{
		$str = '[foo] is here';

		$str = $this->matcher
				 	->load($str, $this->collection)
			 		->searchAndReplace();

		$this->assertEquals('bar is here', $str);
	}

	/**
	 * Test a search and replace with a closure
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_closureSearchAndReplace()
	{
		$str = '[zim, value="hello"]';

		$str = $this->matcher
					->load($str, $this->collection)
					->searchAndReplace();

		$this->assertEquals('hello value set', $str);
	}

} // END class MatcherTest extends \PHPUnit_Framework_TestCase
