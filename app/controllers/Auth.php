<?php
/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/1
 * Time: 11:09
 */
class AuthController extends BaseController
{
    use \Login\Login;

    /**
     * @desc 登录页面 登录方法
     * @method get
     * @return bool
     */
    public function loginAction()
    {
        $this->setReturn(view('auth.login'));
    }

    /**
     * @desc 登录验证
     * @method post
     */
    public function postLoginAction()
    {
        //登录验证
       $this->validate(Request::all(),$this->LoginRule(),$this->LoginMessage());

        $this->doLogin(Request::all());

        $this->setReturn(1,'登录成功',[]);
    }

    public function loginOutAction()
    {
        $this->loginOut();
    }

    protected function LoginRule()
    {
        return [
            'name'=>'require',
            'password'=>'require',
        ];
    }

    protected function LoginMessage()
    {
        return [
            'name.require'=>'请填写用户名',
            'password.require'=>'请填写密码',
        ];
    }


}