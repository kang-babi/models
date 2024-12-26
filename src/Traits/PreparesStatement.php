<?php

namespace KangBabi\Traits;

use KangBabi\Database\Connection;
use KangBabi\Exceptions\AttributeDoesNotExistException;

trait PreparesStatement
{
  protected $limit;
  protected $groupBy;
  protected $orderBy;
  protected $query;
  protected $wheres = [];
  protected $bindings = [];

  public function prepareSelect($columns)
  {
    $columns = implode(', ', $columns);
    $this->query = "SELECT {$columns} FROM {$this->model->getTable()}";
  }

  public function prepareWheres()
  {
    $this->query .= ' WHERE ';

    foreach ($this->wheres as $key => $where) {
      if ($this->model->isAttribute($where['column'])) {
        $this->query .= "{$where['column']} {$where['operator']} ?";

        if ($key < count($this->wheres) - 1) {
          $this->query .= " {$where['boolean']} ";
        }
      } else {
        throw new AttributeDoesNotExistException($this->model::class, $where['column']);
      }
    }
  }

  public function prepareBindings()
  {
    foreach ($this->wheres as $where) {
      $this->bindings[] = $where['value'];
    }

    if ($this->limit) {
      $this->query .= " LIMIT {$this->limit}";
    }

    if ($this->groupBy) {
      $this->query .= " GROUP BY {$this->groupBy}";
    }

    if ($this->orderBy) {
      $this->query .= " ORDER BY ? ?";
      $this->bindings += [$this->orderBy['column'], $this->orderBy['direction']];
    }
  }

  public function execute()
  {
    $statement = Connection::resolveConnection($this->connection)->prepare($this->query);
    $statement->execute($this->bindings);

    return $statement->fetchAll();
  }
}
