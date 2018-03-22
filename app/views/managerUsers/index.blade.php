@extends('index.index')
@section('title','用户管理')
@section('index')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="javascript:;">yaf-后台测试</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>用户管理</span>
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
                                <span class="caption-subject bold uppercase">用户管理</span>
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
                            <a href="{{url('managerUsers/create')}}" class="btn blue" style="margin-left: 40px;">
                                <i></i>添加用户</a>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>管理员姓名</th>
                                    <th>邮箱</th>
                                    <th>密码</th>
                                    <th></th>
                                    <th>创建时间</th>
                                    <th>更新时间</th>
                                    <th>状态 1正常 0 冻结</th>
                                    <th>最后登录ip</th>
                                    <th>角色id</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $k => $v)
                                    <tr>
                                        <td>{{$v->id}}</td>
                                        <td>{{$v->name}}</td>
                                      <td>{{$v->email}}</td>
                                      <td>{{$v->password}}</td>
                                      <td>{{$v->remember_token}}</td>
                                      <td>{{$v->created_at}}</td>
                                      <td>{{$v->updated_at}}</td>
                                      <td>{{$v->status}}</td>
                                      <td>{{$v->last_login_ip}}</td>
                                      <td>{{$v->role_id}}</td>
                                      
                                        <td class="text-center">
                                            <a href="{{url('managerUsers/edit/id/'.$v->id)}}" class="btn   btn-sm yellow">
                                                <i  ></i>编辑</a>
                                            <a href="{{url('managerUsers/delete/id/'.$v->id)}}" class="btn   btn-sm red">
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
        <div style="float: right">
                        {{$list->links('index.page',['elements'=>$list])}}
                    </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection
