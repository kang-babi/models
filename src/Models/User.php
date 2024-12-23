<?php

namespace KangBabi\Models;

class User extends Model
{
  protected $table = 'users';
  protected $fillable = ['name', 'email', 'password', 'employee_id', 'unit_id'];
  protected $hidden = ['password'];
}
