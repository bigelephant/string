<?php

use BigElephant\String\String;
use Mockery as m;

class StringTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->pluralizer = m::mock('BigElephant\String\Pluralizer\PluralizerInterface');
		$this->str = new String($this->pluralizer);
	}

	public function tearDown()
	{
		m::close();
	}

	public function testStringLengthIsCorrect()
	{
		$this->assertEquals(6, $this->str->length('Taylor'));
		$this->assertEquals(5, $this->str->length('ラドクリフ'));
	}

	public function testStringCanBeConvertedToLowercase()
	{
		$this->assertEquals('taylor', $this->str->lower('TAYLOR'));
		$this->assertEquals('άχιστη', $this->str->lower('ΆΧΙΣΤΗ'));
	}

	public function testStringCanBeConvertedToUppercase()
	{
		$this->assertEquals('TAYLOR', $this->str->upper('taylor'));
		$this->assertEquals('ΆΧΙΣΤΗ', $this->str->upper('άχιστη'));
	}

	public function testStringCanBeConvertedToUpperWords()
	{
		$this->assertEquals('Taylor', $this->str->upperWords('taylor'));
		$this->assertEquals('Άχιστη', $this->str->upperWords('άχιστη'));
	}

	public function testStringCanBeLimitedByCharacters()
	{
		$this->assertEquals('Tay...', $this->str->limit('Taylor', 3));
		$this->assertEquals('Taylor', $this->str->limit('Taylor', 6));
		$this->assertEquals('Tay___', $this->str->limit('Taylor', 3, '___'));
	}

	public function testStringCanBeLimitedByWords()
	{
		$this->assertEquals('Taylor...', $this->str->limitWords('Taylor Otwell', 1));
		$this->assertEquals('Taylor___', $this->str->limitWords('Taylor Otwell', 1, '___'));
		$this->assertEquals('Taylor Otwell', $this->str->limitWords('Taylor Otwell', 3));
	}

	// TODO: test word wrap

	/*
	move to own test file
	public function testStringsCanBeSingularOrPlural()
	{
	$this->assertEquals('user', $this->str->singular('users'));
	$this->assertEquals('users', $this->str->plural('user'));
	$this->assertEquals('User', $this->str->singular('Users'));
	$this->assertEquals('Users', $this->str->plural('User'));
	$this->assertEquals('user', $this->str->plural('user', 1));
	$this->assertEquals('users', $this->str->plural('user', 2));
	$this->assertEquals('chassis', $this->str->plural('chassis', 2));
	$this->assertEquals('traffic', $this->str->plural('traffic', 2));
	}*/

	public function testStringsCanBeSlugged()
	{
		$this->assertEquals('my-new-post', $this->str->slug('My nEw post!!!'));
		$this->assertEquals('my_new_post', $this->str->slug('My nEw post!!!', '_'));
	}

	// TODO: camelCase

	// TODO: snake_case

	public function testRandomStringsCanBeGenerated()
	{
		$this->assertEquals(40, strlen($this->str->random(40)));
	}
}