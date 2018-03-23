<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/23
 * Time: 10:13
 */
class BaseAction    extends  Yaf_Action_Abstract
{
     public function execute()
     {
         // TODO: Implement execute() method.
     }

    public function setReturn($status = 1, $message = '' ,$data = [])
    {
        if (is_array($data)){
            $data = json_encode($data);
        }

        if (is_string($status)){
            $data = $status;
        }
        $this->getController()->getResponse()->setBody($data,'content');
        $this->getController()->getResponse()->setBody($message,'message');
        $this->getController()->getResponse()->setBody($status,'status');
    }
}