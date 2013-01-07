<?php
use Anahkiasen\Str;
use Anahkiasen\Pluralizer;

class StrTest extends PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    $this->str = new Str(new Pluralizer);
  }

  /**
   * Test the Str::length method.
   *
   * @group laravel
   */
  public function testStringLengthIsCorrect()
  {
    $this->assertEquals(6, $this->str->length('Taylor'));
    $this->assertEquals(5, $this->str->length('ラドクリフ'));
  }

  /**
   * Test the Str::lower method.
   *
   * @group laravel
   */
  public function testStringCanBeConvertedToLowercase()
  {
    $this->assertEquals('taylor', $this->str->lower('TAYLOR'));
    $this->assertEquals('άχιστη', $this->str->lower('ΆΧΙΣΤΗ'));
  }

  /**
   * Test the Str::upper method.
   *
   * @group laravel
   */
  public function testStringCanBeConvertedToUppercase()
  {
    $this->assertEquals('TAYLOR', $this->str->upper('taylor'));
    $this->assertEquals('ΆΧΙΣΤΗ', $this->str->upper('άχιστη'));
  }

  /**
   * Test the Str::title method.
   *
   * @group laravel
   */
  public function testStringCanBeConvertedToTitleCase()
  {
    $this->assertEquals('Taylor', $this->str->title('taylor'));
    $this->assertEquals('Άχιστη', $this->str->title('άχιστη'));
  }

  /**
   * Test the Str::limit method.
   *
   * @group laravel
   */
  public function testStringCanBeLimitedByCharacters()
  {
    $this->assertEquals('Tay...', $this->str->limit('Taylor', 3));
    $this->assertEquals('Taylor', $this->str->limit('Taylor', 6));
    $this->assertEquals('Tay___', $this->str->limit('Taylor', 3, '___'));
  }

  /**
   * Test the Str::words method.
   *
   * @group laravel
   */
  public function testStringCanBeLimitedByWords()
  {
    $this->assertEquals('Taylor...', $this->str->words('Taylor Otwell', 1));
    $this->assertEquals('Taylor___', $this->str->words('Taylor Otwell', 1, '___'));
    $this->assertEquals('Taylor Otwell', $this->str->words('Taylor Otwell', 3));
  }

  /**
   * Test the Str::plural and $this->str->singular methods.
   *
   * @group laravel
   */
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
  }

  /**
   * Test the Str::slug method.
   *
   * @group laravel
   */
  public function testStringsCanBeSlugged()
  {
    $this->assertEquals('my-new-post', $this->str->slug('My nEw post!!!'));
    $this->assertEquals('my_new_post', $this->str->slug('My nEw post!!!', '_'));
  }

  /**
   * Test the Str::classify method.
   *
   * @group laravel
   */
  public function testStringsCanBeClassified()
  {
    $this->assertEquals('Something_Else', $this->str->classify('something.else'));
    $this->assertEquals('Something_Else', $this->str->classify('something_else'));
  }

  /**
   * Test the Str::random method.
   *
   * @group laravel
   */
  public function testRandomStringsCanBeGenerated()
  {
    $this->assertEquals(40, strlen($this->str->random(40)));
  }
}