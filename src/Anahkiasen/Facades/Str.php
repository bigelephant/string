<?php namespace Anahkiasen\Facades;

use Illuminate\Support\Facades\Facade;

class Str extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'str'; }
}