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
	 * An array containing a misformed match
	 *
	 * @var Array
	 */
	protected $misformed_mask;

	/**
	 * Set up test env
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->matches_simple = ['foo' => Array('value' => 'bar', 'raw' => '[foo]')];

		// A misformed mask
		$this->misformed_mask = ['foo' => Array('value' => Array(), 'raw' => '[foo]')];
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

	/**
	 * Test throwing exception when an invalid mask value is used
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_throwExceptionOnInvalidMaskValue()
	{
		$this->setExpectedException('Masquerade\Exceptions\UnexpectedMaskValue');
		$str = 'There will not be [foo]';

		$replacement = new Replacement($this->misformed_mask, $str);
		$replacement->replace();
	}

} // END class ReplacementTest extends \PHPUnit_Framework_TestCase
