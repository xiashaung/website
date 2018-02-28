<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/2/28
 * Time: 09:51
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

    public function setFileViewFinder()
    {
        $this->fileViewFinder = new \Illuminate\View\FileViewFinder($this->getFileSystem(), $this->getPath());
    }

    public function setBladeCompiler()
    {
        $this->bladeCompiler = new \Illuminate\View\Compilers\BladeCompiler($this->getFileSystem(), $this->getCachePath());
    }

    protected function getFileSystem()
    {
        return new \Illuminate\Filesystem\Filesystem();
    }

    protected function getPath()
    {
        return [APPLICATION_PATH . '/app/views'];
    }

    protected function getCachePath()
    {
        return APPLICATION_PATH . '/app/views/cache';
    }

    public function display($view, $data = [], $mergeData = [])
    {
        $view = str_replace('.blade.php',' ',$view);
        return $this->getFactory()->make($view,$data,$mergeData)->render();
    }
    public function render($view, $data = [],$mergeData = [])
    {
        $view = str_replace('.blade.php',' ',$view);
        return $this->getFactory()->make($view,$data,$mergeData)->render();
    }

    public function assign($name, $value = null){}

    public function setScriptPath($tpl_dir)
    {
       $this->scriptPath = $tpl_dir;
    }

    public function getScriptPath()
    {
        return $this->scriptPath;
    }

    public function getFactory()
    {
        return new \Illuminate\View\Factory($this->getEngineResolver(),$this->fileViewFinder,$this->getDispatcher());
    }

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


}