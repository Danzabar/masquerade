<?php

use Masquerade\Exceptions\InvalidClassMethodCalled;

/**
 * Test case for the invalid class method called
 *
 * @package Masquerade
 * @subpackage Tests\Exceptions
 * @author Dan Cox
 */
class InvalidClassMethodCalledTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Fire the exception
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_fireException()
	{
		try {

			throw new InvalidClassMethodCalled('test', 'foo');

		} catch (\Exception $e) {

			$this->assertEquals('test', $e->getMethod());
			$this->assertEquals('foo', $e->getMask());
		}
	}


} // END class InvalidClassMethodCalledTest extends \PHPUnit_Framework_TestCase
