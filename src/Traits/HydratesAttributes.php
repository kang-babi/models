<?php

namespace KangBabi\Traits;

trait HydratesAttributes
{
  public function hydrate(array $attributes)
  {
    foreach ($attributes as $key => $value) {
      $this->setAttribute($key, $value);
    }
  }

  public function newInstance()
  {
    $model = new static();
    $model->setTable($this->getTable());
    $model->attributes = array_fill_keys($this->fillable, null);

    return $model;
  }

  public function fill(array|object $attributes, $fromBuilder = false)
  {
    foreach ($attributes as $key => $value) {
      if ($fromBuilder || $this->isFillable($key)) {
        $this->setAttribute($key, $value, $fromBuilder);
      }
    }
  }
}
