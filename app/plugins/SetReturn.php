<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/15
 * Time: 10:13
 */
class SetReturnPlugin    extends Yaf_Plugin_Abstract
{
    public function dispatchLoopShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
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