<?php
use \Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
/**
 * Class RegisterPlugin
 * 注册相应的类
 */
class RegisterPlugin extends Yaf_Plugin_Abstract
{
    public function routerStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        //注册request对象
        Yaf_Registry::set('request',$request);

    }
}