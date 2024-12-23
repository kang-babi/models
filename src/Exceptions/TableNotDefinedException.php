<?php

namespace KangBabi\Exceptions;

use Exception;

class TableNotDefinedException extends Exception
{
  public function __construct($class)
  {
    parent::__construct("Table not defined in class [{$class}]");
  }
}
