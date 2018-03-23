<?php


class Menu
{
    private static $ohter = [
        '其他'=>
            [
                'upload'
            ],
        '首页'=>
            [
                'index'
            ]
    ];
    /**
     * @return bool
     * 检查当前用户是否有超管权限
     */
    public static function checkAdmin()
    {
        if (in_array(Auth::id(),[1, 3])){
            return true;
        }
        return false;
    }
    /**
     * @return array
     * 主页菜单显示列表信息
     */
    public static function  MenuList()
    {
        return [
            [
                'title' => '权限管理',
                'url' => 'javascript:;',
                'icon'=> 'icon-home',
                'menu' => [
                    [
                        'title'=>'用户管理',
                        'url'=>'user/index',
                        'icon'=> 'icon-user',
                    ],
                    [
                        'title'=>'权限管理',
                        'url'=>'permission/index',
                        'icon'=> 'icon-user-unfollow',
                    ],
                    [
                        'title'=>'角色管理',
                        'url'=>'role/index',
                        'icon'=> 'icon-user-follow',
                    ],
                ],
            ],
            [
                'title' => '自动生成工具',
                'url' => 'javascript:;',
                'icon'=> 'icon-home',
                'menu' => [
                    [
                        'title'=>'模型',
                        'url'=>'auto/model',
                        'icon'=> 'icon-user',
                    ],
                    [
                        'title'=>'CURD',
                        'url'=>'auto/view',
                        'icon'=> 'icon-user-unfollow',
                    ],
                    [
                        'title'=>'控制器',
                        'url'=>'auto/controller',
                        'icon'=> 'icon-user-follow',
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array
     * 检查用户权限 过滤
     */
    public static function getMenuList()
    {

        $list = static::MenuList();
        if (static::checkAdmin()){
            return $list;
        }
        foreach ($list as $k => $v){
            foreach ($v['menu'] as $key => $val){
                if (!checkAuth($val['url'])){
                    unset($list[$k]['menu'][$key]);
                }
            }
            if (empty($list[$k]['menu'])){
                unset($list[$k]);
            }
        }
        return $list;
    }

    public static function authList()
    {
        //可展示的全部权限
        $permissionList = PermissionModel::select('url','desc','id')->get();
        $list = [];
        foreach ($permissionList as $k => $v){
            $tmp = explode('/',$v->url);
            $lists = self::getAuthTypeList();
            foreach ( $lists as $key => $val){
                if (isset($tmp[0]) && in_array($tmp[0],$val)){
                    if (isset($list[$key])){
                        $list[$key][] = $v;
                    }else{
                        $list[$key][] = $v;
                    }
                }
            }
        }
        return $list;
    }

    /**
     * @return array
     */
    public static function getAuthTypeList(): array
    {
        $list = self::MenuList();
        $arr = [];
        foreach ($list as $k => $v) {
            foreach ($v['menu'] as $key => $value) {
                $temp = explode('/', $value['url']);
                $arr[$v['title']][$key] = $temp[0];
            }
            if (isset(static::$ohter[$v['title']])) {
                $arr[$v['title']] = array_merge($arr[$v['title']], static::$ohter[$v['title']]);
                unset(static::$ohter[$v['title']]);
            }
        }
        return array_merge($arr, static::$ohter);
    }

}
