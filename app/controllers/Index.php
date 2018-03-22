<?php
/**
 * @name IndexController
 * @author xiashuang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class IndexController extends BaseController
{
    use \Permission\Traits\Permission;
	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yaf/index/index/index/name/xiashuang 的时候, 你就会发现不同
     */

    /**
     * @method get
     * @desc 首页_测试测试
     * @return void
     */
	public function indexAction()
    {
        $this->setReturn(view('index/index'));
	}

}
