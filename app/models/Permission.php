<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/7
 * Time: 17:08
 */
class PermissionModel extends \Illuminate\Database\Eloquent\Model
{
    use \Permission\Traits\Permission;

    protected $table = 'manager_permission';

    protected $fillable = [
        'url',
        'method',
        'desc'
    ];

    protected $hiddden = ['_token','_method'];

    public static function batchCreate()
    {
        $permissions = (new static())->getPermission();

        foreach ($permissions as $k => $v){
            $find = self::where('url',$v['url'])->first();
            if (!$find){
                self::create($v);
            }else{
                $find->desc = $v['desc'];
                $find->method = $v['method'];
                $find->save();
            }
        }
    }
}