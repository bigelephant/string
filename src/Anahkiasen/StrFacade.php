<?php namespace Anahkiasen;

use Illuminate\Support\Facades\Facade;

class StrFacade extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'str'; }
}