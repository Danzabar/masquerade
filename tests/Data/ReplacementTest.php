<?php

use Masquerade\Data\Replacement;

/**
 * Test case for the replacement class
 *
 * @package Masquerade
 * @subpackage Tests\Data
 * @author Dan Cox
 */
class ReplacementTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * Simple match mock
	 *
	 * @var Array
	 */
	protected $matches_simple;

	/**
	 * A match with a closure
	 *
	 * @var Array
	 */
	protected $matches_closure;

	/**
	 * Set up test env
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->matches_simple = ['foo' => Array('value' => 'bar', 'raw' => '[foo]')];
	}

	/**
	 * Test replacing a basic string
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_basicStringReplacement()
	{
		$str = 'There will be [foo]';

		$replacement = new Replacement($this->matches_simple, $str);
		$replacement->replace();

		$this->assertEquals('There will be bar', $replacement->getStr());
	}

} // END class ReplacementTest extends \PHPUnit_Framework_TestCase
