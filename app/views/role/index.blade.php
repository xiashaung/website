@extends('index.index')
@section('title','角色管理')
@section('index')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="javascript:;">权限管理</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>角色管理</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

            <!-- END DASHBOARD STATS 1-->
            <div class="row margin-top-20">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark nocap">
                                <span class="caption-subject bold uppercase">角色管理</span>
                            </div>
                               <form>
                                <div class="form-group">
                                    <div class="col-md-3 margin-bottom-20" style="padding-left: 0">
                                        <div class="input-group select2-bootstrap-append">
                                            <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" data-select2-open="multi-append">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('role/create')}}" class="btn blue" style="margin-left: 40px;">
                                <i></i>添加角色</a>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>角色名</th>
                                    <th>模块</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $k => $v)
                                    <tr>
                                        <td>{{$v->id}}</td>
                                        <td>{{$v->name}}</td>
                                        <td>{{$v->guard_name}}</td>
                                        <td>{{$v->created_at}}</td>
                                        <td class="text-center">
                                            <a href="{{url('role/edit/id/'.$v->id)}}" class="btn   btn-sm yellow">
                                                <i  ></i>编辑</a>
                                            <a href="{{url('role/delete/id/'.$v->id)}}" class="btn   btn-sm red">
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
        <!-- END CONTENT BODY -->
    </div>
@endsection
