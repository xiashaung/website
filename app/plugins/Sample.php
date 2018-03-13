<?php
/**
 * @name SamplePlugin
 * @desc Yaf定义了如下的6个Hook,插件之间的执行顺序是先进先Call
 * @see http://www.php.net/manual/en/class.yaf-plugin-abstract.php
 * @author xiashuang
 */
class SamplePlugin extends Yaf_Plugin_Abstract {


	public function routerStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
	}

	public function routerShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
        //注册request对象
        Yaf_Registry::set('request',$request);
	}

	public function dispatchLoopStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {

        //获取uri
        $uri = lcfirst($request->getControllerName()).'/'.$request->getActionName();

        $permission = \Permission\Model\Eloquent\Permission::where('url',$uri)->first();

        if ($permission){
            if (!in_array($request->getMethod(),explode(',',$permission->method))){
                if ($request->isXmlHttpRequest()){
                    ajaxReturn(0,"method not allowed",[]);
                }else{
                    throw new \Exception("method not allowed");
                }
            }
        }

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

	public function preDispatch(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {

	}

	public function postDispatch(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {

	}

	public function dispatchLoopShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {

        $body = $response->getBody('content');
        $message = $response->getBody('message');
        $status = $response->getBody('status');
        if ($request->isXmlHttpRequest()){
            ajaxReturn($status,$message,json_decode($body,true));
        }
        if (is_string($body)){
            exit($body);
        }
	}
}
