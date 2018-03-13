@extends('admin.index.index')
@section('title','修改密码')
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
                                <span class="caption-subject font-dark sbold uppercase">修改密码</span>
                                <a href="{{url('admin/index')}}" class="small">【返回】</a>
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <form class="form-horizontal" role="form" method="post"
                                  action="{{url("admin/postReset")}}" id="form" enctype="multipart/form-data">
                                {{csrf_field()}}

                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        <button class="close" data-close="alert"></button>
                                        <span>{{session('error')}}</span>
                                    </div>
                                @endif

                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">旧密码: </label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control"  name="oldPassword">
                                            @if(session('oldPassword'))
                                                <span class="help-block">{{session('oldPassword')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">新密码: </label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control"  name="newPassword">
                                            @if(session('newPassword'))
                                                <span class="help-block">{{session('newPassword')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">确认密码: </label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control"  name="conPassword">
                                            @if(session('conPassword'))
                                                <span class="help-block">{{session('conPassword')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" id="btn" class="btn yellow"/>
                                            <button type="reset" class="btn default" onclick="window.history.go(-1);">取消</button>
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