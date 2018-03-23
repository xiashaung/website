<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/12
 * Time: 15:34
 */
class ControllerAction extends BaseAction
{
    protected $desc;

    protected $name;

    protected $formatName;

    public function execute()
    {

        if (request('op')){
            $this->handle();
        }else{
            $this->setReturn(view('auto.controller'));
        }
    }

    public function handle()
    {
        $this->name = request('name');
        $this->desc = request('desc');
        $this->formatName()->Controller();
    }

    public function formatName()
    {
        $name = explode('_',$this->name);
        $str = '';
        foreach ($name as $v){
            $str .= ucfirst($v);
        }
        $str .= 'Model';
        $this->formatName = $str;

        return $this;
    }

    public function controllerName()
    {
        $name = explode('_',$this->name);
        $str = '';
        foreach ($name as $v){
            $str .= ucfirst($v);
        }
        $str .= 'Controller';
        return $str;
    }

    public function viewName()
    {
        $name = explode('_',$this->name);
        $str = '';
        foreach ($name as $v){
            $str .= ucfirst($v);
        }
        return lcfirst($str);
    }

    public function Controller()
    {
        $str = "<?php

class ".$this->controllerName()." extends BaseController
{
    /**
     * @desc ".$this->desc."管理
     * @method get
     */
    public function indexAction()
    {
        \$list = ".$this->formatName."::paginate(10);
        \$this->setReturn(view('".$this->viewName().".index',compact('list')));
    }


    /**
     * @desc 添加".$this->desc."页面
     * @method get
     */
    public function createAction()
    {
        \$this->setReturn(view('".$this->viewName().".create'));
    }

    /**
     * @desc 添加".$this->desc."
     * @method post
     */
    public function storeAction()
    {
        ".$this->formatName."::create(Request::all());
        \$this->redirect('/".$this->viewName()."/index');
    }

    /**
     * @param \$id
     * @return mixed
     * @desc 编辑".$this->desc."页面
     * @method get
     */
    public function editAction(\$id)
    {
        \$info = ".$this->formatName."::find(\$id);
        \$this->setReturn(view('".$this->viewName().".edit',compact('info')));
    }

    /**
     * @param \$id
     * @return mixed
     * @desc 更新".$this->desc."
     * @method post
     */
    public function updateAction(\$id)
    {
        \$all =  Request::all();
        \$info = ".$this->formatName."::find(\$id);
        \$info->fill(\$all)->save();
        \$this->redirect('/".$this->viewName()."/index');
    }

    /**
     * @param \$id
     * @desc 删除".$this->desc."
     * @method get
     */
    public function deleteAction(\$id)
    {
        ".$this->formatName."::destroy(\$id);
        \$this->redirect('/".$this->viewName()."/index');
    }
}";
        FileManager::write(APPLICATION_PATH.'/app/controllers/'.rtrim($this->controllerName(),'Controller').'.php',$str);
        echo '生成成功';die;
    }

    public function check()
    {
        if (file_exists(APPLICATION_PATH.'/app/controllers/'.rtrim($this->controllerName(),'Controller').'.php')){
            echo '文件已存在';die;
        }
        return $this;
    }
}