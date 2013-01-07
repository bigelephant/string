<?php
use Anahkiasen\Str;
use Anahkiasen\Pluralizer;

class StartTests extends PHPUnit_Framework_TestCase
{
  protected $str;
  protected $config;

  public function setUp()
  {
    $this->str = new Str(new Pluralizer);
  }
}