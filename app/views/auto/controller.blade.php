@extends('index.index')
@section('title','生成控制器')
@section('index')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            {{--<div class="caption">--}}
                            {{--<i class="icon-settings font-dark"></i>--}}
                            {{--<span class="caption-subject font-dark sbold uppercase">生成模型</span>--}}
                            {{--<a href="{{url('role/index')}}"  class="small">【返回】</a>--}}
                            {{--</div>--}}
                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal" action="{{url('auto/controller?op=handle')}}" method="post" >
                                <div class="">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">表名: </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name" placeholder="用户名">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">描述: </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="desc">
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
