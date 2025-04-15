<?php

use KangBabi\Database\Builder;
use KangBabi\Database\Connection;
use KangBabi\Models\Model;
use KangBabi\Models\User;

require 'src/functions.php';

require BASE_PATH . '/vendor/autoload.php';

$user = User::all();

dd($user);
