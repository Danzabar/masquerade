<?php

/**
 * A class that passes a value to the matcher
 *
 */
class TestMaskClass
{

	public function bar()
	{
		return 'foo';
	}

	public function foo($extra)
	{
		return 'foo'.$extra;	
	}
} 
