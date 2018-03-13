<?php
/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/6
 * Time: 11:44
 */

namespace Permission\Model\Eloquent;


use Illuminate\Database\Eloquent\Model;

class Role   extends Model
{
    protected $table = 'manager_permission';

    protected $fillable = [
        'name',
        'guard_name',
        'add_time',
        'add_user_id',
        'modify_time',
        'real_path',
        'method',
        'modify_user_id',
        'desc'
    ];

    protected $timestamps = false;

    protected $hiddden = ['_token','_method'];

}