<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/12
 * Time: 15:34
 */
class ControllerAction extends Yaf_Action_Abstract
{
    protected $desc;

    protected $name;

    protected $formatName;

    public function execute()
    {

        $this->name = request('name');
        $this->desc = request('desc');
        $this->formatName();
        $this->Controller();
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
        \$this->setReturn(view('role.index',compact('list')));
    }


    /**
     * @desc 添加".$this->desc."页面
     * @method get
     */
    public function createAction()
    {
        \$this->setReturn(view('role.create'));
    }

    /**
     * @desc 添加".$this->desc."
     * @method post
     */
    public function storeAction()
    {
        ".$this->formatName."::create(Request::all());
        \$this->redirect('/role/index');
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
        \$this->setReturn(view('role.edit',compact('info')));
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
        \$this->redirect('/role/index');
    }

    /**
     * @param \$id
     * @desc 删除".$this->desc."
     * @method get
     */
    public function deleteAction(\$id)
    {
        ".$this->formatName."::destroy(\$id);
        \$this->redirect('/role/index');
    }
}";
        FileManager::write(APPLICATION_PATH.'/app/controllers/'.rtrim($this->controllerName(),'Controller').'.php',$str);
    }
}