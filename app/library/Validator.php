<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/1
 * Time: 15:20
 */
class Validator  extends Validate\Validate
{

    public function validate(array $data, array $rules, array $messages = [])
    {
        $validate = self::make($rules,$messages);
        return $validate->check($data);
    }
}