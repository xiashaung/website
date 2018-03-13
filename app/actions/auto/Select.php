<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/13
 * Time: 10:00
 */
class Select
{

    protected $table;

    protected $name;

    const start_time = ['start_time','add_time','add_datetime','created_at'];

    const update_time =  ['update_time','edit_time','edit_datetime','modify_time','updated_at'];

    protected $except = ['id','is_delete','is_deleted','delete_time'];

    public function __construct($name,$except = [])
    {
        $this->name = $name;
        $this->except = array_merge($this->except,$except);
        $this->setTable();
        $this->getColumns();
    }

    protected function setTable()
    {
        $databaseName = Yaf_Registry::get('config')->get('mysql.database');
        $this->table = DB::select("SELECT * FROM  INFORMATION_SCHEMA.COLUMNS WHERE table_name=? and table_schema=? ",[$this->name,$databaseName]);
    }

    public function getStartTime()
    {

        foreach ($this->table as $v){
            if (in_array($v->COLUMN_NAME,self::start_time)){
                return $v->COLUMN_NAME;
            }
        }

        return '';
    }

    public function getUpdateTime()
    {
         $arr = [];
        foreach ($this->table as $v){
            if (in_array($v->COLUMN_NAME,self::update_time)){
                return $v->COLUMN_NAME;
            }
        }

        return '';
    }

    public function getColumns()
    {
        $arr = [];
        foreach ($this->table as $v){
            if (!in_array($v->COLUMN_NAME,$this->except)){
                $arr[$v->COLUMN_NAME] = $v->COLUMN_COMMENT;
            }
        }
        return $arr;
    }

    public function formatName()
    {
        $name = explode('_',$this->name);
        $str = '';
        foreach ($name as $v){
            $str .= ucfirst($v);
        }
        return $str;
    }
}