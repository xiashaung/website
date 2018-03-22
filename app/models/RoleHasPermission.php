<?php

class RoleHasPermissionModel extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'manager_role_has_permission';

    protected $primaryKey = 'id';

    protected  $fillable = [
        'permission_id',
        'role_id',
    ];

    public  $timestamps = false;

}