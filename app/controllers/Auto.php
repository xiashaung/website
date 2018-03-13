<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/12
 * Time: 10:51
 */
class AutoController extends Yaf_Controller_Abstract
{

    /**
     * @var array
     * 自定义实现方法
     */
    public $actions = [
        'model'=>'actions/auto/Model.php',
        'controller'=>'actions/auto/Controller.php',
        'view'=>'actions/auto/View.php',
    ];
}