<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/8
 * Time: 16:32
 */
class Arr
{
     public static function conbile($arr1,$arr2)
     {
         $arr = [];
         foreach ($arr1 as $v){
             if (!in_array($v,$arr2)){
                 $arr[] = $v;
             }
         }

         foreach ($arr2 as $v){
             if (!in_array($v,$arr1)){
                 $arr[] = $v;
             }
         }
         return $arr;
     }
}