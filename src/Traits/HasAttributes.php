<?php

namespace KangBabi\Traits;

trait HasAttributes
{
  public function __get($key)
  {
    return $this->attributes[$key];
  }

  public function __set($key, $value)
  {
    $this->attributes[$key] = $value;
  }

  public function getTable()
  {
    return $this->table;
  }

  public function setTable($table)
  {
    $this->table = $table;
  }

  public function getFillable()
  {
    return $this->fillable;
  }

  public function setAttribute($key, $value, $isInternal = false)
  {
    if ($isInternal || $this->isFillable($key)) {
      $this->attributes[$key] = $value;
    }
  }

  public function getAttribute($key)
  {
    return $this->attributes[$key];
  }

  public function getAttributes()
  {
    return $this->attributes;
  }

  public function isFillable($key)
  {
    return in_array($key, $this->getFillable());
  }

  public function isAttribute($key)
  {
    return in_array($key, $this->getAttributes());
  }
}
