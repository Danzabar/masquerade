<?php namespace Masquerade\Interfaces;

use Masquerade\Collection\Collection;

/**
 * This interface allows people to rip out the match class
 * and implement their own without losing any functionality
 *
 */
Interface MatchInterface
{
	/**
	 * Loads a string and the collection class into the
	 * matcher
	 *
	 */
	public function load($str, Collection $collection);

	/** 
	 * Searches through the string and picks out any matches
	 *
	 */
	public function search();	

	/**
	 * Returns the matches gathered in the search function
	 *
	 */
	public function getMatches();

}
