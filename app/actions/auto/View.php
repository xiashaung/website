<?php
require 'Select.php';
/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/13
 * Time: 09:56
 */
class ViewAction extends BaseAction
{
    protected $name;

    protected $desc;

    /**
     * @var Select
     */
    protected $select;

    public function execute()
    {
        if (request('op')){
            $this->handle();
        }else{
            $this->setReturn(view('auto.view'));
        }
    }

    public function handle()
    {
        $this->name = request('name');
        $this->desc = request('desc');
        $except = explode(',',request('except')) ?? [];

        if (!$this->name){
            throw new Exception('请输入表名');
        }

        if (!$this->desc){
            throw new Exception('请输入描述');
        }

        $this->select = new Select($this->name,$except);

        $this->index()->create()->edit();
    }

    public function  getApplicationName()
    {
        return  Yaf_Registry::get('config')->get('application.name');
    }

    protected function getheader()
    {
        $str = '';
        foreach ($this->select->getColumns() as $key => $v){
            $str .= "<th>$v</th>\n                                    ";
        }

        return $str;
    }

    public function getCloumns()
    {
        $str = '';
        foreach ($this->select->getColumns() as $key => $v){
            $str .= "<td>{{\$v->".$key."}}</td>\n                                      ";
        }
        return $str;
    }

    public function getUcName()
    {
        return lcfirst($this->select->formatName());
    }

    /**
     * 生成主页
     */
    protected function index()
    {
       $str = "@extends('index.index')
@section('title','".$this->desc."管理')
@section('index')
    <div class=\"page-content-wrapper\">
        <!-- BEGIN CONTENT BODY -->
        <div class=\"page-content\">
            <!-- BEGIN PAGE BAR -->
            <div class=\"page-bar\">
                <ul class=\"page-breadcrumb\">
                    <li>
                        <a href=\"javascript:;\">".$this->getApplicationName()."</a>
                        <i class=\"fa fa-circle\"></i>
                    </li>
                    <li>
                        <span>".$this->desc."管理</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

            <!-- END DASHBOARD STATS 1-->
            <div class=\"row margin-top-20\">
                <div class=\"col-md-12\">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class=\"portlet light bordered\">
                        <div class=\"portlet-title\">
                            <div class=\"caption font-dark nocap\">
                                <span class=\"caption-subject bold uppercase\">".$this->desc."管理</span>
                            </div>
                               <form>
                                <div class=\"form-group\">
                                    <div class=\"col-md-3 margin-bottom-20\" style=\"padding-left: 0\">
                                        <div class=\"input-group select2-bootstrap-append\">
                                            <input type=\"text\" class=\"form-control\" placeholder=\"Search for...\">
                                <span class=\"input-group-btn\">
                                    <button class=\"btn btn-default\" type=\"submit\" data-select2-open=\"multi-append\">
                                        <span class=\"fa fa-search\"></span>
                                    </button>
                                </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <a href=\"{{url('".$this->getUcName()."/create')}}\" class=\"btn blue\" style=\"margin-left: 40px;\">
                                <i></i>添加".$this->desc."</a>
                            <div class=\"tools\"> </div>
                        </div>
                        <div class=\"portlet-body\">
                            <table class=\"table table-striped table-bordered table-hover\" id=\"sample_1\">
                                <thead>
                                <tr>
                                    <th>编号</th>
                                    ".$this->getheader()."
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\$list as \$k => \$v)
                                    <tr>
                                        <td>{{\$v->id}}</td>
                                        ".$this->getCloumns()."
                                        <td class=\"text-center\">
                                            <a href=\"{{url('".$this->getUcName()."/edit/id/'.\$v->id)}}\" class=\"btn   btn-sm yellow\">
                                                <i  ></i>编辑</a>
                                            <a href=\"{{url('".$this->getUcName()."/delete/id/'.\$v->id)}}\" class=\"btn   btn-sm red\">
                                                <i  ></i>删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <div style=\"float: right\">
                        {{\$list->links('index.page',['elements'=>\$list])}}
                    </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection
";
        $this->write($str,'index');
        return $this;
    }

    public function getCreateInput()
    {
        $str = '';
        foreach ($this->select->getColumns() as $key => $v){
            $str .= "<div class=\"\">
                                    <div class=\"form-group\">
                                        <label class=\"col-md-3 control-label\">$v : </label>
                                        <div class=\"col-md-9\">
                                            <input type=\"text\" class=\"form-control\" name=\"$key\">
                                        </div>
                                    </div>
                                </div>\n                                    
                                ";
        }

        return $str;
    }

    public function getEditInput()
    {
        $str = '';
        foreach ($this->select->getColumns() as $key => $v){
            $str .= "<div class=\"\">
                                    <div class=\"form-group\">
                                        <label class=\"col-md-3 control-label\">$v : </label>
                                        <div class=\"col-md-9\">
                                            <input type=\"text\" class=\"form-control\" name=\"$key\" value=\"{{\$info->$key}}\">
                                        </div>
                                    </div>
                                </div>\n                                    
                                ";
        }

        return $str;
    }

    /**
     * 生成添加页面
     */
    protected function create()
    {
        $str = "@extends('index.index')
@section('title','添加".$this->desc."')
@section('index')
    <div class=\"page-content-wrapper\">
        <!-- BEGIN CONTENT BODY -->
        <div class=\"page-content\">
            <div class=\"row\">
                <div class=\"col-md-offset-3 col-md-6\">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class=\"portlet light bordered\">
                        <div class=\"portlet-title\">
                            <div class=\"caption\">
                                <i class=\"icon-settings font-dark\"></i>
                                <span class=\"caption-subject font-dark sbold uppercase\">添加".$this->desc."</span>
                                <a href=\"{{url('".$this->getUcName()."/index')}}\"  class=\"small\">【返回】</a>
                            </div>
                        </div>
                        <div class=\"portlet-body form\">
                            <form class=\"form-horizontal\" action=\"{{url('".$this->getUcName()."/store')}}\" method=\"post\" >
                                ".$this->getCreateInput()."
                                <div class=\"form-group\">
                                    <div class=\"row\">
                                        <div class=\"col-md-offset-3 col-md-9\">
                                            <input type=\"submit\" value=\" 提交\"  class=\"btn yellow\">
                                            <button type=\"button\" class=\"btn default\">取消</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->

                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection

@section('script')

@endsection
";
        $this->write($str,'create');
        return $this;
    }

    /**
     * 生成编辑页面
     */
    protected function edit()
    {
        $str = "@extends('index.index')
@section('title','编辑".$this->desc."')
@section('index')
    <div class=\"page-content-wrapper\">
        <!-- BEGIN CONTENT BODY -->
        <div class=\"page-content\">
            <div class=\"row\">
                <div class=\"col-md-offset-3 col-md-6\">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class=\"portlet light bordered\">
                        <div class=\"portlet-title\">
                            <div class=\"caption\">
                                <i class=\"icon-settings font-dark\"></i>
                                <span class=\"caption-subject font-dark sbold uppercase\">编辑".$this->desc."</span>
                                <a href=\"{{url('".$this->getUcName()."/index')}}\"  class=\"small\">【返回】</a>
                            </div>
                        </div>
                        <div class=\"portlet-body form\">
                            <form class=\"form-horizontal\" action=\"{{url('".$this->getUcName()."/store')}}\" method=\"post\" >
                                ".$this->getEditInput()."
                                <div class=\"form-group\">
                                    <div class=\"row\">
                                        <div class=\"col-md-offset-3 col-md-9\">
                                            <input type=\"submit\" value=\" 提交\"  class=\"btn yellow\">
                                            <button type=\"button\" class=\"btn default\">取消</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->

                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection

@section('script')

@endsection
";
        $this->write($str,'edit');
        return $this;
    }

    protected function write($str,$name)
    {
        $dir = APPLICATION_PATH.'/app/views/'.$this->getUcName();
        $name = '/'.$name.'.blade.php';
        FileManager::make($dir,true);
        FileManager::make($dir.$name);
        file_put_contents($dir.$name,$str);
    }
    
    
}