<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/8
 * Time: 15:26
 */
class ModelHasRoleModel  extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'manager_model_has_role';

     protected $primaryKey = 'id';

    protected  $fillable = [
        'model_id',
        'role_id',
    ];

    public  $timestamps = false;
}