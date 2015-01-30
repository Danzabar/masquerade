<?php

use Masquerade\Exceptions\UnexpectedMaskValue;


/**
 * Test case for the exception unexpectedmaskvalue
 *
 * @package Masquerade
 * @subpackage Tests\Exceptions
 * @author Dan Cox
 */
class UnexpectedMaskValueTest extends \PHPUnit_Framework_TestCase
{
	
	/**
	 * Test firing the exception
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_fire()
	{
		try {
			
			throw new UnexpectedMaskValue(Array(), 'foo');

		} catch (\Exception $e) {

			$this->assertEquals(Array(), $e->getValue());
			$this->assertEquals('foo', $e->getMask());
		}
	}

} // END class UnexpectedMaskValueTest extends \PHPUnit_Framework_TestCase
