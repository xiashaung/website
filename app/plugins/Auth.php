<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/15
 * Time: 10:05
 */
class AuthPlugin     extends  Yaf_Plugin_Abstract
{
    /**
     * @param Yaf_Request_Abstract $request
     * @param Yaf_Response_Abstract $response
     * 路由结束之后触发
     * 检测用户权限
     */
    public function routerShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        //获取uri
        $uri = lcfirst($request->getControllerName()).'/'.$request->getActionName();

        //检查相应的请求方法
        Auth::checkRequestMethod($request);

        if (!in_array($uri,['auth/login','auth/postlogin'])){
            if (!Auth::check()) {
                redirect('auth/login');
            }else{
                if (!checkAuth($uri)) {
                    if ($request->isXmlHttpRequest()) {
                        ajaxReturn(0, "权限不足,请联系管理员!");
                    } else {
                        throw new \Exception("权限不足,请联系管理员!");
                    }
                }
            }

        }
    }
}