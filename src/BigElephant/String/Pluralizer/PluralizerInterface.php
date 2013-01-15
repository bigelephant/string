<?php namespace BigElephant\String\Pluralizer;

interface PluralizerInterface {

	/**
	 * Get the singular form of the given word.
	 *
	 * @param  string $value
	 * @return string
	 */
	public function singular($value);

	 /**
	 * Get the plural form of the given word.
	 *
	 * @param  string $value
	 * @param  int    $count
	 * @return string
	 */
	public function plural($value, $count = 2);
}