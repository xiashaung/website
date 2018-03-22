<?php

class ManagerUsersController extends BaseController
{
    /**
     * @desc 用户管理
     * @method get
     */
    public function indexAction()
    {
        $list = ManagerUsersModel::paginate(10);
        $this->setReturn(view('managerUsers.index',compact('list')));
    }


    /**
     * @desc 添加用户页面
     * @method get
     */
    public function createAction()
    {
        $this->setReturn(view('managerUsers.create'));
    }

    /**
     * @desc 添加用户
     * @method post
     */
    public function storeAction()
    {
        ManagerUsersModel::create(Request::all());
        $this->redirect('/managerUsers/index');
    }

    /**
     * @param $id
     * @return mixed
     * @desc 编辑用户页面
     * @method get
     */
    public function editAction($id)
    {
        $info = ManagerUsersModel::find($id);
        $this->setReturn(view('managerUsers.edit',compact('info')));
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
        $info = ManagerUsersModel::find($id);
        $info->fill($all)->save();
        $this->redirect('/managerUsers/index');
    }

    /**
     * @param $id
     * @desc 删除用户
     * @method get
     */
    public function deleteAction($id)
    {
        ManagerUsersModel::destroy($id);
        $this->redirect('/managerUsers/index');
    }
}