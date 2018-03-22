<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/6
 * Time: 11:46
 */
class UserController extends BaseController
{
    /**
     * @desc 后台用户管理
     * @method get
     */
    public function indexAction()
    {
        $list = UserModel::where('id','>',1)->paginate(10);
         $this->setReturn(view('user.index',compact('list')));
    }


    /**
     * @desc 添加后台用户页面
     * @method get
     */
    public function createAction()
    {
        $roleList = RoleModel::select('name','id')->get();
        $this->setReturn(view('user.create',compact('roleList')));
    }

    /**
     * @desc 添加后台用户
     * @method post
     */
    public function storeAction()
    {
        $all =  Request::all();
        $all['password'] = app(\Hash\Hash::class)->make($all['password']);
        UserModel::create($all);
        $this->redirect('/user/index');
    }

    /**
     * @param $id
     * @return mixed
     * @desc 编辑用户页面
     * @method get
     */
    public function editAction($id)
    {
        $user = UserModel::find($id);
        $roleList = RoleModel::select('name','id')->get();
        $this->setReturn(view('user.edit',compact('user','roleList')));
    }

    /**
     * @param $id
     * @return mixed
     * @desc 更新用户
     * @method post
     */
    public function updateAction($id)
    {
        $all =  Request::all();
        $all['password'] = app(\Hash\Hash::class)->make($all['password'] ?? 123456);
        $user = UserModel::find($id);
        $user->fill($all)->save();
        $user->giveRole($all['role_id']);
        $this->redirect('/user/index');
    }

    /**
     * @param $id
     * @desc 删除用户
     * @method get
     */
    public function deleteAction($id)
    {
        UserModel::destroy($id);
        $this->redirect('/user/index');
    }
}