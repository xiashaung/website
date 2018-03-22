<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/2/28
 * Time: 14:24
 */
class BaseController  extends Yaf_Controller_Abstract
{
    use Validate;

    public function setReturn($status = 1, $message = '' ,$data = [])
    {
        if (is_array($data)){
            $data = json_encode($data);
        }

        if (is_string($status)){
            $data = $status;
        }
        $this->getResponse()->setBody($data,'content');
        $this->getResponse()->setBody($message,'message');
        $this->getResponse()->setBody($status,'status');
    }

}

