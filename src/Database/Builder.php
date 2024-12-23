<?php

namespace KangBabi\Database;

use KangBabi\Traits\PreparesStatement;

class Builder
{
  use PreparesStatement;
  protected $connection;
  protected $model;

  public function __construct($model = null)
  {
    if ($model) {
      $this->setModel($model);
    }

    $this->connection = $model?->getConnection() ?: Connection::getConnection();
  }

  public function setModel($model)
  {
    $this->model = $model;
  }

  public function where($column, $operator = null, $value = null, $boolean = 'and')
  {
    if (func_num_args() === 2) {
      $value = $operator;
      $operator = '=';
    }

    $this->wheres[] = compact('column', 'operator', 'value', 'boolean');

    return $this;
  }

  public function orWhere($column, $operator = null, $value = null)
  {
    return $this->where($column, $operator, $value, 'or');
  }

  public function limit($limit)
  {
    $this->limit = $limit;

    return $this;
  }

  public function groupBy($groupBy)
  {
    if (is_array($groupBy)) {
      $groupBy = implode(', ', $groupBy);
    }

    $this->groupBy = $groupBy;

    return $this;
  }

  public function orderBy($column, $direction = 'asc')
  {
    $this->orderBy = compact('column', 'direction');

    return $this;
  }

  public function get($columns = ['*'])
  {
    $this->prepareSelect($columns);

    if (!empty($this->wheres)) {
      $this->prepareWheres();
    }

    $this->prepareBindings();

    $results = $this->execute();

    return $this->hydrate($results);
  }

  public function hydrate($records)
  {
    return array_map(function ($record) {
      $model = $this->model->newInstance();

      $model->fill($record);

      return $model;
    }, $records);
  }
}
