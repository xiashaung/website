<?php

use Illuminate\Database\Eloquent\Model;

class ManagerUsersModel extends Model
{
    protected  $table = 'manager_users';

    public $timestamps = true;

    protected  $fillable = [
        'name',//管理员姓名
        'email',//邮箱
        'password',//密码
        'remember_token',//
        'created_at',//创建时间
        'updated_at',//更新时间
        'status',//状态 1正常 0 冻结
        'last_login_ip',//最后登录ip
        'role_id',//角色id
        
    ];
    
    const CREATED_AT = 'created_at';
    
    const UPDATED_AT = 'updated_at';
    
    public function scopeSearch($query,$request)
    {
        //此处写搜索的逻辑查询
    }
    
    

    
} 