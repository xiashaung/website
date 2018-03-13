<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
/**
 * @name Bootstrap
 * @author xiashuang
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf_Bootstrap_Abstract
{
    use Validate;
    public function _initConfig()
    {
        //把配置保存起来
        $arrConfig = Yaf_Application::app()->getConfig();
        Yaf_Registry::set('config', $arrConfig);
    }

    public function __initSession()
    {
        session()->start();
    }

    public function _initPlugin(Yaf_Dispatcher $dispatcher)
    {
        //注册一个插件
        $objSamplePlugin = new SamplePlugin();
        $dispatcher->registerPlugin($objSamplePlugin);
    }

    public function _initRoute(Yaf_Dispatcher $dispatcher)
    {
        //在这里注册自己的路由协议,默认使用简单路由
        $router = Yaf_Dispatcher::getInstance()->getRouter();
        $route = require_once(APPLICATION_PATH . '/conf/route.php');
        foreach ($route as $k => $v) {
            $router->addRoute($k, $v);
        }
    }

    public function _initView(Yaf_Dispatcher $dispatcher)
    {
        $dispatcher->disableView();
        $dispatcher->flushInstantly(false);
        //注册分页视图
        \Illuminate\Pagination\Paginator::viewFactoryResolver(function(){
            return app(Blade::class)->getFactory();
        });
        //注册分页基础url
        \Illuminate\Pagination\Paginator::currentPathResolver(function () {
            return request()->getBaseUrl();
        });

        //自动获取分页的名字
        \Illuminate\Pagination\Paginator::currentPageResolver(function ($pageName = 'page') {
            $page = request()->input($pageName);

            if (filter_var($page, FILTER_VALIDATE_INT) !== false && (int) $page >= 1) {
                return (int) $page;
            }

            return 1;
        });
        //在这里注册自己的view控制器，例如smarty,firekylin
    }

    /**
     * @param Yaf_Dispatcher $dispatcher
     * 结合laravel的ORM 方便用于数据库查询
     */
    public function _initDatabase(Yaf_Dispatcher $dispatcher)
    {
        define('MYSQL_CONFIG',require (APPLICATION_PATH.'/conf/database.php'));
        $capsule = new Capsule;
        $capsule->addConnection(MYSQL_CONFIG);
        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    /**
     * 初始化whoops
     */
    public function _initWhoops()
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }
}
