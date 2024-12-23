<?php

namespace KangBabi\Exceptions;

use Exception;

class MethodNotFoundException extends Exception
{
  public function __construct($class, $method)
  {
    parent::__construct("[{$class}]::[{$method}] does not exist.");
  }
}
