<?php
use Illuminate\Container\Container;


/**
 * @param null $make
 * @param array $parameters
 * @return mixed
 */
function app($make = null, $parameters = [])
{
    if (!$make){
        return Container::getInstance();
    }
    return Container::getInstance()->make($make,$parameters);
}

/**
 * @param $view
 * @param array $data
 * 视图方法 具体扩展
 * @see Blade
 * @see https://github.com/illuminate/view
 */
function view($view,$data = [])
{
    return  app(Blade::class)->display($view,$data)->render();
}

/**
 * @param string $var
 * @return mixed|\Illuminate\Http\Request
 */
function request($var = null,$default = null)
{
    if (is_null($var)) {
        return app('request');
    }

    if (is_array($var)) {
        return app('request')->only($var);
    }

    $value = app('request')->__get($var);

    return is_null($value) ? value($default) : $value;
}

/**
 * @param string $var
 * @param string $default
 * @return mixed | Session
 */
function session($var = '',$default = '')
{
    if (!$var){
        return app(Session::class);
    }

    return app(Session::class)->get($var,$default);
}

function ajaxReturn($status,$message = '',$data = [],$json_option = JSON_UNESCAPED_UNICODE)
{
    $data = ['status'=>$status,'message'=>$message,'data'=>$data ?? []];
    header('Content-Type:application/json; charset=utf-8');
    exit(json_encode($data,$json_option));
}

function is_json($json)
{
    return is_array(json_decode($json,true));
}

function url($uri,$data = [])
{
   return '/'.$uri;
}

/**
 * @param $uri
 * @param array $data
 * 跳转方法
 */
function redirect($uri, array $data = [])
{
    if ($data){
        header("Location:".$_SERVER['REQUEST_SCHEME'].'://'.request()->getHost().'/'.$uri.'?'.http_build_query($data));
    }else{
        header("Location:".$_SERVER['REQUEST_SCHEME'].'://'.request()->getHost().'/'.$uri);
    }
    die;
}

function menu()
{
    return Menu::getMenuList();
}

function authList()
{
    return Menu::authList();
}

/**
 * @param $uri
 * @return bool
 * 检查权限
 */
function checkAuth($uri)
{
   if (Menu::checkAdmin()){
       return true;
   }

   return Auth::can($uri);

}

