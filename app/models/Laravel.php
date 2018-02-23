<?php

class LaravelModel   extends \Illuminate\Database\Eloquent\Model
{
    public $table = 'manager_users';

     public static function getUsers()
     {
         return self::where('id',1)->first();
     }
}