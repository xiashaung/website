@extends('index.index')
@section('title','编辑角色')
@section('index')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">添加角色</span>
                                <a href="{{url('role/index')}}"  class="small">【返回】</a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal" action="{{url('role/update/id/').$role->id}}" method="post" >
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">角色名</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name" value="{{$role->name}}" placeholder="用户名">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">模块</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="guard_name" value="admin">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">权限管理</label>
                                        <div class="col-md-9">
                                            <div class="tree">
                                                <ul>
                                                    <li class="tree_item1">
                                                        <!--<i class="fa fa-minus-square-o"></i>-->
                                                        <label class="checkbox-inline all">
                                                            <input type="checkbox" id="inlineCheckbox1" name="pre"
                                                                   value="option1">所有权限
                                                        </label>
                                                        <ul>
                                                            @foreach(authList() as $k => $v)
                                                                <li class="tree_item2">
                                                                    <label class="checkbox-inline all">
                                                                        <input type="checkbox"
                                                                               id="inlineCheckbox2"> {{$k}}
                                                                    </label>
                                                                    <ul>
                                                                        @foreach($v as $key => $val)
                                                                            <li class="tree_item3">
                                                                                <label class="checkbox-inline">
                                                                                    <input type="checkbox"
                                                                                           value="{{$val->id}}"
                                                                                           id="inlineCheckbox3"
                                                                                           name="permissions[]" @if(in_array($val->id,$permissionIds)) checked @endif> {{$val->desc}}
                                                                                </label>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" value=" 提交"  class="btn yellow">
                                            <button type="button" class="btn default">取消</button>
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