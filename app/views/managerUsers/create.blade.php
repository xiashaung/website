@extends('index.index')
@section('title','添加用户')
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
                                <span class="caption-subject font-dark sbold uppercase">添加用户</span>
                                <a href="{{url('managerUsers/index')}}"  class="small">【返回】</a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal" action="{{url('managerUsers/store')}}" method="post" >
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">管理员姓名 : </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">邮箱 : </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="email">
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">密码 : </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="password">
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> : </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="remember_token">
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">创建时间 : </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="created_at">
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">更新时间 : </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="updated_at">
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">状态 1正常 0 冻结 : </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="status">
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">最后登录ip : </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="last_login_ip">
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">角色id : </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="role_id">
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
