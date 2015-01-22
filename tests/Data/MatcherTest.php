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
	 * Test matching in various positions with various keys etc
	 *
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_aBunchOfMatchCases()
	{
		$this->collection->add('test1', 'value');
		$this->collection->add('test2', 'val');
		$this->collection->add('s./28', 'weird');

		$str1 = '[test1]';
		$str2 = '[test1][test2]';
		$str3 = '[test1] [test2]';
		$str4 = 'Text first [test1]';
		$str5 = '[test1] then text, then [test2]';
		$str6 = '[s./28]';
		$str7 = 'Text first [s./28]';
		$str8 = 'Test then value str [test1, value="value"]';

		// Lets get matching!
		$matches1 = $this->matcher->load($str1, $this->collection)->search()->getRawMatches();
		$matches2 = $this->matcher->load($str2, $this->collection)->search()->getRawMatches();
		$matches3 = $this->matcher->load($str3, $this->collection)->search()->getRawMatches();
		$matches4 = $this->matcher->load($str4, $this->collection)->search()->getRawMatches();
		$matches5 = $this->matcher->load($str5, $this->collection)->search()->getRawMatches();
		$matches6 = $this->matcher->load($str6, $this->collection)->search()->getRawMatches();
		$matches7 = $this->matcher->load($str7, $this->collection)->search()->getRawMatches();
		$matches8 = $this->matcher->load($str8, $this->collection)->search()->getRawMatches();

		$this->assertEquals(Array('[test1]'), $matches1);
		$this->assertEquals(Array('[test1]', '[test2]'), $matches2);
		$this->assertEquals(Array('[test1]', '[test2]'), $matches3);
		$this->assertEquals(Array('[test1]'), $matches4);	
		$this->assertEquals(Array('[test1]', '[test2]'), $matches5);
		$this->assertEquals(Array('[s./28]'), $matches6);
		$this->assertEquals(Array('[s./28]'), $matches7);
		$this->assertEquals(Array('[test1, value="value"]'), $matches8);
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
