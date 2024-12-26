<?php

namespace KangBabi\Models;

use KangBabi\Database\Builder;
use KangBabi\Database\Connection;
use KangBabi\Traits\HasAttributes;
use KangBabi\Traits\HydratesAttributes;

class Model
{
  use HasAttributes, HydratesAttributes;

  protected $connection;
  protected $table;
  protected $fillable = [];
  protected $primaryKey = 'id';
  protected $attributes = [];

  public function __construct()
  {
    $this->connection = Connection::getConnectionName();
  }

  public static function __callStatic($method, $args)
  {
    return (new static())->query()->$method(...$args);
  }

  public function getConnection()
  {
    return $this->connection;
  }

  public static function query()
  {
    return (new static())->newQuery();
  }

  public function newQuery()
  {
    return new Builder($this);
  }

  public static function all(...$columns)
  {
    return static::query()
      ->get(is_array($columns) ? $columns : func_get_args());
  }

  public static function first(...$columns)
  {
    return static::query()
      ->limit(1)
      ->get(is_array($columns) ? $columns : func_get_args());
  }
}
