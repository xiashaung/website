<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/8
 * Time: 17:12
 */
class Auth
{
     public static function id()
     {
         if (!isset(session()->get('auth')->id)){
             return 0;
         };
         return session()->get('auth')->id;
     }

     public static function user()
     {
         return session()->get('auth');
     }

     public static function get($cloumn)
     {
         return session()->get('auth')->{$cloumn};
     }

     public static function name()
    {
        return self::get('name');
    }

     public static function can($uri)
     {
         $permissionId = PermissionModel::where('url',$uri)->value('id');

         if (!$permissionId){
             return false;
         }
         //查询当前用户是否具有权限
         $permission = RoleHasPermissionModel::where('role_id',self::get('role_id'))->where('permission_id',$permissionId)->first();

         if (!$permission){
             return false;
         }

         return true;
     }

    /**
     * @return bool
     */
     public static function check()
     {
         if (static::user()){
             return true;
         }else{
             return false;
         }
     }

    /**
     * @param $method
     * 验证当前方法是否允许get或post请求
     */
     public static function checkRequestMethod($class,$method)
     {

     }
}