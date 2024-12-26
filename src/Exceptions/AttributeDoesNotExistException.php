<?php

namespace KangBabi\Exceptions;

use Exception;

class AttributeDoesNotExistException extends Exception
{
  public function __construct($model, $attribute)
  {
    parent::__construct("[{$model}] has no [{$attribute}].");
  }
}
