<?php
/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/6
 * Time: 11:45
 */

namespace Permission\Model\Eloquent;


use Illuminate\Database\Eloquent\Model;

class Permission  extends   Model
{
    use \Permission\Traits\Permission;

    protected $table = 'manager_permission';

    protected $fillable = [
        'url',
        'method',
        'desc'
    ];

    protected $hiddden = ['_token','_method'];

    public function batchCreate()
    {
        $permissions = $this->getPermission();

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