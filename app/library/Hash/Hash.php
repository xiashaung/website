<?php
namespace Hash;
/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/2
 * Time: 15:56
 */

class Hash
{
    /**
     * @param $string
     * @param int $model
     * @param array $salt
     * @return bool|string
     */
    public function make($string,$model = PASSWORD_BCRYPT,$salt = ['cost'=>10])
    {
        return password_hash($string,$model,$salt);
    }


    /**
     * @param $string
     * @param $hash
     * @return bool
     */
    public function verify($string,$hash)
    {
        return password_verify($string,$hash);
    }

    /**
     * @param $hash
     * @param int $model
     * @param array $salt
     * @return string
     */
    public function refresh($hash,$model = PASSWORD_BCRYPT,$salt = ['cost'=>10])
    {
         return password_needs_rehash($hash,$model,$salt);
    }
}