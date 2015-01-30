Collections
===========

A collection is an object that gets values mapped by key, the values can be straight strings or closures.

## Basic Collections

You can extend the collections interface and inject your own collection class into Masquerade, however this document assumes you are using the standard BagCollection method that comes with Masquerade and is initiated by default.

### Adding a mask value

To add a value to the collection you can use the `Masquerade` classes `add` method:

	// Create a new Masquerade instance with standard settings
	$masks = new Masquerade;

	// Add a basic string
	$masks->add('foo', 'bar');

	// Add a closure
	$masks->add('value', function(){
		
		// The closure must return something.
		return 'this is the value';
	});

	// Add a class
	$masks->add('test', new TestClass);

### Class Replacement

Classes work a bit differently, you can use them in two ways, heres the two ways you can call a method of a class:

	[class.method, params]

Or,

	[class, method="method", params]

!Currently you cannot use class properties!.

### Using the replace

Now we have a mask loaded into the collection we can use the `searchAndReplace` method to search through a string and replace any masks it finds there, the function will return the altered string.

	$masks->searchAndReplace("foo [foo]"); // Will return "foo bar";

	$masks->searchAndReplace("[value]"); // Will return "this is the value";

### Adding parameters

For closure and Class masks we can add parameters into the masks that will be used as params for the closure, consider the following:
	

	// We add a closure mask that can take 2 params.
	$masks->add('closure', function($value, $verbose = FALSE) {
		
		$str = "";

		if($verbose)
		{
			$str .= "Verbose active - ";
		}

		$str .= $value;
	});

	// Now in our string we can include these params
	$str = 'Our test - [closure, value="val", verbose]';

	$masks->searchAndReplace($str); // Will return "Our test - Verbose active - val";
