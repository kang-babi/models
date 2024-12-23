<?php

namespace KangBabi\Models;

use KangBabi\Database\Builder;
use KangBabi\Database\Connection;

class Model
{
  protected $connection;
  protected $table;
  protected $fillable = [];
  protected $primaryKey = 'id';
  protected $attributes = [];

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

  public function __construct()
  {
    $this->connection = Connection::getConnection();
  }

  public function getConnection()
  {
    return $this->connection;
  }

  public function newInstance()
  {
    $model = new static();
    $model->setTable($this->getTable());

    return $model;
  }

  public static function query()
  {
    return (new static())->newQuery();
  }

  public function newQuery()
  {
    return new Builder($this);
  }

  public static function all($columns = ['*'])
  {
    return static::query()
      ->get(is_array($columns) ? $columns : func_get_args());
  }

  public static function __callStatic($method, $args)
  {
    return (new static())->query()->$method(...$args);
  }

  public function fill(array|object $attributes)
  {
    foreach ($attributes as $key => $value) {
      if ($this->isFillable($key)) {
        $this->setAttribute($key, $value);
      }
    }
  }

  public function isFillable($key)
  {
    return in_array($key, $this->getFillable());
  }

  public function setAttribute($key, $value)
  {
    $this->attributes[$key] = $value;
  }

  public function getAttribute($key)
  {
    return $this->attributes[$key];
  }
}
