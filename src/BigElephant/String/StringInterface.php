<?php namespace BigElephant\String;

interface StringInterface {

	/**
	 * Get the length of a string.
	 *
	 * @param  string $string
	 * @return int
	 */
	public function length($string);

	/**
	 * Convert a string to lowercase.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function lower($string);

	/**
	 * Convert a string to uppercase.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function upper($string);

	/**
	 * Convert first letter of each word to uppercase.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function upperWords($string);

	/**
	 * Limit the number of characters in a string.
	 *
	 * @param  string $string
	 * @param  int    $limit
	 * @param  string $elipses
	 * @return string
	 */
	public function limit($string, $limit, $elipses = '...');

	/**
	 * Limit the number of chracters in a string including the elipses.
	 *
	 * @param  string $string
	 * @param  int    $limit
	 * @param  string $elipses
	 * @return string
	 */
	public function limitExact($string, $limit, $elipses = '...');

	/**
	 * Limit the number of words in a string.
	 *
	 * @param  string $string
	 * @param  int    $words
	 * @param  string $elipses
	 * @return string
	 */
	public function limitWords($string, $words, $elipses = '...');

	/**
	 * Adds a space to a string after a given amount of contiguous, non-whitespace characters.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function wordWrap($string, $length);

	/**
	 * Get the singular form of the given word.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function singular($string);

	/**
	 * Get the plural form of the given word.
	 *
	 * @param  string $string
	 * @param  int    $count
	 * @return string
	 */
	public function plural($string, $count = 2);

	/**
	 * Generate a URL friendly "slug" from a given string.
	 *
	 * @param  string $string
	 * @param  string $separator
	 * @return string
	 */
	public function slug($string, $separator = '-');

	/**
	 * Convert a string to 7-bit ASCII.
	 *
	 * This is helpful for converting UTF-8 strings for usage in URLs, etc.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function ascii($string);

	/**
	 * Convert a string to camel-case
	 *
	 * @param  string  $string
	 * @param  boolean $upperFirst
	 * @return string
	 */
	public function camelCase($string, $upperFirst = true);

	/**
	 * Convert a string to snake case
	 * 
	 * @param  string $string
	 * @return string
	 */
	public function snakeCase($string, $delimiter = '_');

	/**
	 * Return the "URI" style segments in a given string.
	 *
	 * @param  string $string
	 * @return array
	 */
	public function segments($string);

	/**
	 * Generate a random alpha or alpha-numeric string.
	 *
	 * @param  int    $length
	 * @param  string $type
	 * @return string
	 */
	public function random($length, $type = 'alnum');

	 /**
	 * Determine if a given string matches a given pattern.
	 *
	 * @param  string $string
	 * @param  string $pattern
	 * @return bool
	 */
	public function matches($string, $pattern);

	/**
	* Converts URLs to anchors.
	*
	* @param  string $string
	* @return string
	*/
	public function hrefToAnchor($string);

	/**
	 * Determine if a given string ends with a given needle.
	 *
	 * @param string $haystack
	 * @param string $needle
	 * @return bool
	 */
	public function endsWith($haystack, $needle);

	/**
	 * Determine if a string starts with a given needle.
	 *
	 * @param  string  $haystack
	 * @param  string  $needle
	 * @return bool
	 */
	public function startsWith($haystack, $needle);

	/**
	 * Determine if a given string contains a given sub-string.
	 *
	 * @param  string        $haystack
	 * @param  string|array  $needle
	 * @return bool
	 */
	public function contains($haystack, $needle);

	/**
	 * Cap a string with a single instance of a given value.
	 *
	 * @param  string  $value
	 * @param  string  $cap
	 * @return string
	 */
	public function finish($value, $cap);
}