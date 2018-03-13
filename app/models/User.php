<?php



use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'manager_users';

    public $timestamps = false;

    protected $fillable = [
        'name',//用户名
        'email',//邮箱地址
        'password',//密码
        'updated_at',//更新时间
        'created_at',//登录时间
        'last_login_ip',//最后登录的ip地址
        'status',//用户状态 1 启用 2 冻结 默认启用
        'remark',//备注
        'role_id',//角色id
    ];

    protected $hidden = [
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 用户和角色关联模型
     */
    public function  role()
    {
        return $this->hasOne('RoleModel','id','role_id');
    }

    public function   giveRole($role_id)
    {
        //一个用户只允许拥有一个角色
        ModelHasRoleModel::where('model_id',$this->id)->delete();
        //给用户分配一个角色
        ModelHasRoleModel::create(['model_id'=>$this->id,'role_id'=>$role_id]);

    }
}