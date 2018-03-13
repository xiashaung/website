<?php
/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/6
 * Time: 14:28
 */

namespace Permission\Traits;


trait Permission
{

    private static $methods = [
        'get',
        'post',
        'patch',
        'put',
        'delete',
    ];


    private $yaf_controller = ['Yaf_Exception_LoadFailed_Controller', 'Yaf_Controller_Abstract','ErrorController'];


    /**
     * @return array
     * 获取权限列表
     */
    public function getPermission()
    {
        $i = 0;
        $arr = [];
        foreach ($this->getControllers() as $k => $v) {
            if (!in_array($v, $this->yaf_controller)) {
                $controller = lcfirst(str_replace('Controller', '', $v));//把控制器首字母转换为小写
                $refl = new \ReflectionClass($v);//实例化反射类
                // 获取类里所有的方法
                foreach (get_class_methods($v) as $key => $val) {
                    if (strpos($val, 'Action') !== false) {
                        $arr[$i]['url'] = $controller . '/' . str_replace('Action', '', $val);
                        //通过反射获得注释
                        $doc = $refl->getMethod($val)->getDocComment();
                        $arr[$i]['method'] = strtoupper($this->getMethod($doc));//获取访问方法
                        $arr[$i]['desc'] = $this->getDesc($doc);//获取权限描述
                        $i++;
                    }
                }
            }
        }
        return $arr;
    }

    /**
     * 通过正则匹配获取当前方法允许的获取方法
     * @param $doc
     * @return mixed|string
     */
    private function getMethod($doc)
    {
        foreach (self::$methods as $v){
            if (preg_match('/\* @method .*/',$doc,$match)){
                if (strpos(strtolower($match[0]),$v)!==false){
                    return $v;
                }
            }
        }
        return 'get';
    }

    /**
     * @param $doc
     * @return string
     * 通过正则匹配获取方法描述
     */
    private function getDesc($doc)
    {
        if (preg_match('/\* @desc .*/',$doc,$match)){

            return trim(str_replace('* @desc','',$match[0]));
        }
        return '';
    }

    /**
     * @return array
     * 获取所有的控制器
     */
    private static function getControllers()
    {
        $arr = [];
        $handler = opendir(\Yaf_Registry::get('config')->get('application.directory').'/controllers');
        while (($file = readdir($handler)) !==false){
            if (strpos($file,'.php')){
                $arr[] = str_replace('.php','',$file).'Controller';
            }
        }
        closedir($handler);
        return $arr;
    }
}