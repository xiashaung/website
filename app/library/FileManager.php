<?php


class FileManager
{

    /**
     * @param $filepath
     * @return bool
     * 检查文件是否存在
     */
     public static function exists($filepath)
     {
         return file_exists($filepath);
     }


    /**
     * @param $filepath string 文件路径
     * @param bool $dir 是否为文件夹
     * @param int $mode 文件权限模式
     * @return bool
     * 检查文件(夹)是否存在 不存在就创建文件(夹)
     */
     public static function make($filepath,$dir = false,$mode = 0755)
     {
         if (!static::exists($filepath)){
             if ($dir){
                mkdir($filepath,$mode,$dir);
             }else{
                 touch($filepath);
             }
         }
       return true;
     }

    /**
     * @param $fileName
     * @param $value
     */
     public static function write($fileName,$value)
     {
         self::make($fileName);

         file_put_contents($fileName,$value);
     }

    /**
     * @param $fileName
     * @param bool $isDir
     * @return bool
     */
     public static function delete($fileName,$isDir = false)
     {
        if ($isDir){
            return rmdir($fileName);
        }else{
            return unlink($fileName);
        }
     }

     public static function get($fileName)
     {
         if (!self::exists($fileName)){
             return false;
         }
         $content = file_get_contents($fileName);
         if (!$content){
             return false;
         }

         return $content;
     }

}