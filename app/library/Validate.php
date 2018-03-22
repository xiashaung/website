<?php
/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/1
 * Time: 11:42
 *
 */

/**
 * Class Validate
 */
trait Validate
{
    public function validate($data = [],$rules = [],$messages = [])
    {
        $error =  app(Validator::class)->validate($data,$rules,$messages);

        if ($error){
           ajaxReturn(0,'验证未通过',$error);
        }

        return true;
    }


}