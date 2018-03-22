<?php


class RoleModel extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'manager_role';

    protected $guard_name = 'admin';

    public $fillable = [
        'name',
        'guard_name',
    ];

    /**
     * @param $permissions
     * 给角色发放权限
     */
    public function givePermission($permissions)
    {

        //获取用户所有权限
        $pers = $this->getPers();
        $pers = Arr::conbile($permissions,$pers);
        foreach ($pers as $v){
            if (RoleHasPermissionModel::where('permission_id',$v)->where('role_id',$this->id)->first()){

                RoleHasPermissionModel::where('permission_id',$v)->where('role_id',$this->id)->delete();

            }else{
                RoleHasPermissionModel::create(['permission_id'=>$v,'role_id'=>$this->id]);
            }
        }
    }

    /**
     * @return array
     * 获取已有的权限列表
     */
    public function getPers()
    {
        //获取用户所有权限
        $pers = RoleHasPermissionModel::where('role_id',$this->id)->select('permission_id')->get();

        if (!$pers){
            $pers = [];
        }else{
            $pers = array_column($pers->toArray(),'permission_id');
        }
        return $pers;

    }

}