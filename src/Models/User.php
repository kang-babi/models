<?php

namespace KangBabi\Models;

class User extends Model
{
  protected $table = 'users';
  protected $fillable = ['name', 'email', 'employee_id', 'unit_id'];
  protected $hidden = ['password'];
}
