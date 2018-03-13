<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/6
 * Time: 11:47
 */
class RoleController extends BaseController
{
    /**
     * @desc 角色管理
     * @method get
     */
    public function indexAction()
    {
        $list = RoleModel::paginate(10);
        $this->setReturn(view('role.index',compact('list')));
    }


    /**
     * @desc 添加角色页面
     * @method get
     */
    public function createAction()
    {
        $this->setReturn(view('role.create'));
    }

    /**
     * @desc 添加角色
     * @method post
     */
    public function storeAction()
    {
        $role = RoleModel::create(Request::all());
        $role->givePermission(Request::input('permissions'));
        $this->redirect('/role/index');
    }

    /**
     * @param $id
     * @return mixed
     * @desc 编辑角色页面
     * @method get
     */
    public function editAction($id)
    {
        $role = RoleModel::find($id);
        $permissionIds = $role->getPers();
        $this->setReturn(view('role.edit',compact('role','permissionIds')));
    }

    /**
     * @param $id
     * @return mixed
     * @desc 更新角色
     * @method post
     */
    public function updateAction($id)
    {
        $all =  Request::all();
        $role = RoleModel::find($id);
        $role->fill($all)->save();
        $role->givePermission($all['permissions']);
        $this->redirect('/role/index');
    }

    /**
     * @param $id
     * @desc 删除角色
     * @method get
     */
    public function deleteAction($id)
    {
        UserModel::destroy($id);
        $this->redirect('/role/index');
    }
}