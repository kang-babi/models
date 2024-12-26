<?php

namespace KangBabi\Database;

class Connection
{
  protected static $connections = [];
  protected static $connectionName;

  public function __construct()
  {
    $credentials = config('database');

    self::$connectionName = $credentials['driver'];

    self::$connections[self::$connectionName] = new \PDO(
      $credentials['driver'] . ':host=' . $credentials['host'] . ';dbname=' . $credentials['dbname'] . ';charset=' . $credentials['charset'],
      $credentials['username'],
      $credentials['password'],
      [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
      ]
    );
  }

  public static function getConnection($connection = null)
  {
    if (!self::$connections[self::$connectionName]) {
      new self();
    }

    if (array_key_exists($connection, self::$connections)) {
      return self::$connections[self::$connectionName];
    }

    return self::$connections[self::$connectionName];
  }

  public static function getConnectionName()
  {
    if (!self::$connectionName) {
      new self();
    }

    return self::$connectionName;
  }

  public static function resolveConnection($connection = null)
  {
    return self::$connections[$connection] ?: self::getConnection($connection);
  }
}
