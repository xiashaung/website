<?php

/**
 * @param $class
 * @return mixed
 * 工厂类
 */
function app($class)
{
    return (new App)->make($class);
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
    echo app(Blade::class)->display($view,$data)->render();
}