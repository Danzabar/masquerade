Extending Collections
=====================

You can replace the Collection bag that Masquerade uses with your own. This could be to add a database layer, lets look at how we do this..

	Class MyCollection implements Masquerade\Interfaces\CollectionInterface
	{
		// The interface expects, get, add, has, all functions...

		public function get($key)
		{
			// Get the specified mask	
		}

		public function add($key, $value)
		{
			// Add the mask
		}

		public function has($key)
		{
			// check if the mask exists
		}

		public function all()
		{
			// return all the masks
		}
	}

So now we (hopefully) have our own Collection class `MyCollection` we need to inject this into the Masquerade constructor to begin using it:

	$masks = new Masquerade(new MyCollection);

So now all our collection calls will run through the `MyCollection` class, Although I dont think its wise to put queries in there, since it will be querying the database everytime it sees a set of square brackets in your strings. A better approach would be to add a `getAll` method and use the `CollectionBag` trait like this:

	Class MyCollection implements CollectionInterface
	{
		use	Masquerade\Traits\BagTrait;

		// The bag trait adds our get,add,has,all and adds an array called $values;
		public function getAll()
		{
			// Get your masks
			$this->add($key, $value);
		}
	}

This, ofcourse would depend on how many masks there are. Optimally, you should use Class masks.
