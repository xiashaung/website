<?php
/**
 * @name ErrorController
 * @desc 错误控制器, 在发生未捕获的异常时刻被调用
 * @see http://www.php.net/manual/en/yaf-dispatcher.catchexception.php
 * @author xiashuang
 */
class ErrorController extends Yaf_Controller_Abstract {

    /**
     * @method get
     * @desc 显示异常
     * @param $exception
     */
	public function errorAction($exception)
    {
        Log::info($exception);

        throw $exception;
	}
}
