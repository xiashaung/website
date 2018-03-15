<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/components.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/login.min.css" rel="stylesheet" type="text/css"/>
</head>

<body class=" login">
<div class="menu-toggler sidebar-toggler"></div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="javascript:;">
        <img src="/login.png" alt="" width="90"/> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" id="form">
        <h3 class="form-title font-green">登 录</h3>


        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">用户名</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" placeholder="用户名"
                   name="name"/>
            <div v-if="name" class="alert alert-danger">
                <span style="color: red;">@{{ name }}</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">密码</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" placeholder="密码"
                   name="password"/>
            <div v-if="password" class="alert alert-danger">
                <span style="color: red;">@{{ password }}</span>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick="login()" class="btn green uppercase">登录</button>
            <label class="rememberme check">
                <input type="checkbox" name="remember" value="1"/>记住密码</label>
        </div>
    </form>
    <!-- END LOGIN FORM -->
</div>
{{--<div class="copyright"> 2017 © Metronic. Admin Dashboard Template. </div>--}}
<script src="/js/excanvas.min.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/jquery.validate.min.js"></script>
<script src="/js/login.min.js"></script>
<script src="/js/vue.min.js"></script>
<script src="/app/js/app.js"></script>
<!-- BEGIN CORE PLUGINS -->
</body>
<script>
    var formData = $('#form').serializeArray();
    var Validatedata = Object();
    //初始化value data
    for (var i = 0; i < formData.length; i++) {
        Validatedata[formData[i]['name']] = false;
    }
    //初始化vue实例
    var vm = new Vue({
        el: '#form',
        data: Validatedata
    });
    var _data = [];
    for (var value in vm._data) {
        _data[value] = vm._data[value];
    }
    function login() {
        $.ajax({
            url: '/auth/postLogin',
            type: 'post',
            data: $('#form').serialize(),
            success: function (data) {
                if (!data.status) {
                    for (var x in vm._data) {
                        if (data.data[x]) {
                            vm[x] = data.data[x];
                        } else {
                            vm[x] = false;
                        }
                    }
                } else {
                    for (var x in vm._data) {
                        vm[x] = false;
                    }

                    window.location.href = '/index/index';
                }


            }
        });


    }
</script>
</html>