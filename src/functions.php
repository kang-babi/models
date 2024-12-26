<?php

define('BASE_PATH', dirname(__DIR__));

function config(string $key): array
{
  $config = require 'config.php';

  if (array_key_exists($key, $config)) {
    return $config[$key];
  }

  return [];
}
