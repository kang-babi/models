<?php

use KangBabi\Database\Builder;
use KangBabi\Database\Connection;
use KangBabi\Models\User;

define('BASE_PATH', __DIR__);

require BASE_PATH . '/vendor/autoload.php';

dd(User::all(), Connection::getConnectionName());
