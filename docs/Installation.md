Installation
============

You can use composer to install this package by adding this to your composer json:

	"danzabar/masquerade":"1.*"

## Getting started

You will want to create an instance of this at the start of your application and (if you are using one) put it in your dependendency injection class or somewhere accessible.

	$masks = new Masquerade;

Once you have a new instance you can add masks to the standard collection object:

	// Text values
	$masks->add('test', 'value');

	// Closure values
	$masks->add('test', function() {
		return 'value';
	});

	// Class masks
	$masks->add('test', new TestClass);

When you have set masks you can pass strings to its `searchAndReplace` method to replace the masked content:

	$str = 'this is a [test]';

	echo $masks->searchAndReplace($str);
