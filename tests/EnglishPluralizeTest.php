<?php

use BigElephant\String\Pluralizer\English;
use Mockery as m;

class EnglishPluralizeTest extends PHPUnit_Framework_TestCase
{
	public function testStringsCanBeSingularOrPlural()
	{
		$this->pluralizer = new English;

		$this->assertEquals('user', $this->pluralizer->singular('users'));
		$this->assertEquals('users', $this->pluralizer->plural('user'));
		$this->assertEquals('User', $this->pluralizer->singular('Users'));
		$this->assertEquals('Users', $this->pluralizer->plural('User'));
		$this->assertEquals('user', $this->pluralizer->plural('user', 1));
		$this->assertEquals('users', $this->pluralizer->plural('user', 2));
		$this->assertEquals('chassis', $this->pluralizer->plural('chassis', 2));
		$this->assertEquals('traffic', $this->pluralizer->plural('traffic', 2));
	}
}