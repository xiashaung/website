<?php

namespace Login;

use Hash\Hash;

trait Login
{
    protected $user;
    /**
     * @param $request
     * 登录主方法
     */
    public function doLogin($request)
    {
       try{
           $this->attment($request);
       }catch (\Exception $e){
          ajaxReturn(0,$e->getMessage(),['error'=>$e->getMessage()]);
       }
    }

    public function loginOut()
    {
        session()->set('auth',Null);
        redirect('auth/login');
    }

    /**
     * 数据库验证
     */
    public function validateModel($name,$password)
    {
        $this->user = \UserModel::where('name',$name)->where('status',1)->first();
        if (!$this->user){
            throw new \Exception('用户不存在或已禁用!');
        }
        if (!app(Hash::class)->verify($password,$this->user->password)){
            throw new \Exception('密码错误!');
        }
        //登录成功
        //更新用户信息
        $this->user->last_login_ip = request()->getClientIp();
        $this->user->save();
    }

    public function setCsrfToken()
    {

    }

    public function setSeesion()
    {
       $session = session();
//        dd($session->get('auth'));
        $session->set('auth',$this->user);
    }

    public function attment(array $arr,$remember = 0)
    {
        $name = $arr['name'];

        $pasword = $arr['password'];

        $this->validateModel($name,$pasword);

        $this->setSeesion();

    }

}
