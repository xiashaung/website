<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/8
 * Time: 17:12
 */
class Auth
{
    use \Permission\Traits\Permission;


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
     * @param Yaf_Request_Abstract $request
     * @return bool
     */
     public static function checkRequestMethod(Yaf_Request_Abstract $request)
     {
         $controller = ucfirst($request->getControllerName()).'Controller';

         $reflection = new ReflectionClass($controller);

         if ($reflection->hasMethod($request->getActionName().'Action')){
             $doc = $reflection->getMethod($request->getActionName().'Action')->getDocComment();

             $method = self::getMethod($doc);

             if (!$method || in_array(strtolower($request->getMethod()),explode(',',$method))){
                 return true;
             }
             if ($request->isXmlHttpRequest()){
                 ajaxReturn(0,"request method not allowed",[]);
             }else{
                 throw new \Exception("request method not allowed");
             }
         }

     }
}