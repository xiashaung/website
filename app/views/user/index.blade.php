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
                        <a href="javascript:;">权限管理</a>
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
                             <a href="{{url('user/create')}}" class="btn blue" style="margin-left: 40px;">
                                <i></i>添加用户</a>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> 编号</th>
                                    <th> 用户名 </th>
                                    <th> 邮箱 </th>
                                    <th> 最后登录IP </th>
                                    <th> 角色 </th>
                                    <th> 状态 </th>
                                    <th> 操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($list as $k => $v)
                                   <tr>
                                       <td>{{$v->id}}</td>
                                       <td>{{$v->name}}</td>
                                       <td>{{$v->email}}</td>
                                       <td>{{$v->last_login_ip}}</td>
                                       <td>{{$v->role->name}}</td>
                                       <td>
                                           @if($v->status==1)
                                               <span style="color: green">正常</span>
                                           @else
                                               <span style="color: red;">禁用</span>
                                           @endif
                                       </td>
                                       <td class="text-center">
                                           <a href="{{url('user/edit/id/'.$v->id)}}" class="btn   btn-sm yellow">
                                               <i  ></i>编辑</a>
                                           <a href="{{url('user/delete/id/'.$v->id)}}" class="btn   btn-sm red">
                                               <i  ></i>删除</a>
                                       </td>
                                   </tr>
                               @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="float: right">
                        {{$list->links('index.page',['elements'=>$list])}}
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection
