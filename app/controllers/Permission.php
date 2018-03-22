<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/6
 * Time: 11:46
 */
class PermissionController extends BaseController
{
    /**
     * @desc 权限管理
     * @method get
     */
    public function indexAction()
    {
        $list = PermissionModel::paginate(10);
        $this->setReturn(view('permission.index',compact('list')));
    }

    /**
     * @desc 生成和更新权限
     * @method get
     */
    public function setPermissionsAction()
    {
        PermissionModel::batchCreate();
        $this->redirect('index');
    }
    /**
     * @param $id
     * @desc 删除权限
     * @method get
     */
    public function deleteAction($id)
    {
        UserModel::destroy($id);
        $this->redirect('index');
    }

}
