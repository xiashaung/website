@extends('index.index')
@section('title','编辑用户')
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
                                <span class="caption-subject font-dark sbold uppercase">编辑用户</span>
                                <a href="{{url('user/index')}}"  class="small">【返回】</a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal" action="{{url('user/update/id/').$user->id}}" method="post" >
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">用户名</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name" placeholder="用户名" value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">邮箱</label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" name="email" placeholder="邮箱" value="{{$user->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">密码</label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control" name="password" placeholder="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">用户角色</label>
                                        <div class="col-md-9">
                                            <select name="role_id">
                                                @foreach($roleList as $k => $v)
                                                    <option value="{{$v->id}}" @if($v->id==$user->role->id) selected @endif>{{$v->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">用户状态</label>
                                        <div class="col-md-9">
                                            <select name="status" class="form-control">
                                                <option value="1" @if(($user->status)==1) selected @endif>启用</option>
                                                <option value="2" @if(($user->status)==2) selected @endif>禁用</option>
                                            </select>
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
