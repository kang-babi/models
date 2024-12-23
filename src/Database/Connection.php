<?php

namespace KangBabi\Database;

class Connection
{
  protected static $connection;
  protected static $connectionName;

  public function __construct()
  {
    $config = require BASE_PATH . '/src/config.php';
    $credentials = $config['database'];

    self::$connectionName = $credentials['driver'];

    self::$connection = new \PDO(
      $credentials['driver'] . ':host=' . $credentials['host'] . ';dbname=' . $credentials['dbname'] . ';charset=' . $credentials['charset'],
      $credentials['username'],
      $credentials['password'],
      [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
      ]
    );
  }

  public static function getConnection()
  {
    if (!self::$connection) {
      new self();
    }

    return self::$connection;
  }

  public static function getConnectionName()
  {
    if (!self::$connection) {
      new self();
    }

    return self::$connectionName;
  }

  public function __toString()
  {
    return 'Connected to database';
  }
}
