<?php

/**
 * Class Blade
 * yaf laravel blade 模板类
 */
class Blade   implements Yaf_View_Interface
{
    protected $fileViewFinder;

    protected $bladeCompiler;

    protected $engineResolver;

    protected $scriptPath;

    public function __construct()
    {
        $this->setFileViewFinder();
        $this->setBladeCompiler();
    }

    /**
     * 设置视图文件路径
     */
    public function setFileViewFinder()
    {
        $this->fileViewFinder = new \Illuminate\View\FileViewFinder($this->getFileSystem(), $this->getPath());
    }

    /**
     * 设置缓存文件路径
     */
    public function setBladeCompiler()
    {
        $this->bladeCompiler = new \Illuminate\View\Compilers\BladeCompiler($this->getFileSystem(), $this->getCachePath());
    }

    /**
     * @return \Illuminate\Filesystem\Filesystem
     * 获取文件系统
     */
    protected function getFileSystem()
    {
        return new \Illuminate\Filesystem\Filesystem();
    }

    /**
     * @return array
     * 获取视图文件路径
     */
    protected function getPath()
    {
        return [APPLICATION_PATH . '/app/views'];
    }

    /**
     * @return string
     * 缓存文件路径
     */
    protected function getCachePath()
    {
        return APPLICATION_PATH . '/app/views/cache';
    }

    /**
     * @param string $view
     * @param array $data
     * @return \Illuminate\Contracts\View\View
     */
    public function display($view, $data = [])
    {
        return $this->getFactory()->make($this->replaceView($view),$data);
    }

    /**
     * @param string $view
     * @param array $data
     * @return \Illuminate\Contracts\View\View
     */
    public function render($view, $data = [])
    {
        return $this->getFactory()->make($this->replaceView($view),$data);
    }

    /**
     * @param string $name
     * @param null $value
     * 无需实现
     */
    public function assign($name, $value = null){}

    public function setScriptPath($tpl_dir)
    {
       $this->scriptPath = $tpl_dir;
    }

    public function getScriptPath()
    {
        return $this->scriptPath;
    }

    /**
     * @return \Illuminate\View\Factory
     * 获取视图工厂类
     */
    public function getFactory()
    {
        return new \Illuminate\View\Factory($this->getEngineResolver(),$this->fileViewFinder,$this->getDispatcher());
    }

    /**
     * @return \Illuminate\View\Engines\EngineResolver
     * 获取视图引擎
     */
    public function getEngineResolver()
    {
        $resolver =  new \Illuminate\View\Engines\EngineResolver();

        foreach (['file', 'php', 'blade'] as $engine) {
            $this->{'register'.ucfirst($engine).'Engine'}($resolver);
        }

        return $resolver;
    }

    /**
     * Register the file engine implementation.
     *
     * @param  \Illuminate\View\Engines\EngineResolver  $resolver
     * @return void
     */
    public function registerFileEngine($resolver)
    {
        $resolver->register('file', function () {
            return new \Illuminate\View\Engines\FileEngine();
        });
    }

    /**
     * Register the PHP engine implementation.
     *
     * @param  \Illuminate\View\Engines\EngineResolver  $resolver
     * @return void
     */
    public function registerPhpEngine($resolver)
    {
        $resolver->register('php', function () {
            return new \Illuminate\View\Engines\PhpEngine();
        });
    }

    public function getDispatcher()
    {
        return new \Illuminate\Events\Dispatcher();
    }

    /**
     * Register the Blade engine implementation.
     *
     * @param  \Illuminate\View\Engines\EngineResolver  $resolver
     * @return void
     */
    public function registerBladeEngine($resolver)
    {
        $resolver->register('blade', function () {
            return new \Illuminate\View\Engines\CompilerEngine($this->bladeCompiler);
        });
    }

    public function replaceView($view = '')
    {
        return str_replace('.blade.php',' ',$view);
    }
}
