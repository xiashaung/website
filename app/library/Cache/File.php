<?php

namespace Cache;


class File
{
    private static $instance;

    /**
     * @return File
     */
    public static function getInstance()
    {
        if (!self::$instance){
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function set($key,$value,$timeout = 0)
    {
       $this->put($key,$value,$timeout);
    }

    public function del($key)
    {
       \FileManager::delete($this->cacheFile($key));
    }

    /**
     * @param $key
     * @param $value
     */
    public function put($key,$value,$timeout = 0)
    {
        $this->setCacheFile($this->cacheFile($key),$timeout);
        \FileManager::write($this->cacheFile($key),serialize($value));

    }

    /**
     * @param $key
     * @return bool|mixed
     */
    public function get($key)
    {
        return unserialize(\FileManager::get($this->cacheFile($key)));
    }

    private function cachePath()
    {
        \FileManager::make(APPLICATION_PATH.'/storage/cache/file',true);
        return APPLICATION_PATH.'/storage/cache/file/';
    }

    private function cacheFile($key)
    {
        return $this->cachePath().md5($key);
    }

    private function setCacheFile($file,$timeout = 0)
    {
        return touch($file,time(),time()+$timeout);
    }

    public function clear()
    {
        $cachePath = $this->cachePath();
        $files = scandir($cachePath);
        foreach ($files as $v){
            if ((!in_array($v,['..','.']))&&fileatime($cachePath.$v)<time()){
                unlink($cachePath.$v);
            };
        }
    }




}