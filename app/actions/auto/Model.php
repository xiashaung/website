<?php

/**
 * Class ModelAction
 * 自动生成模型
 */
class ModelAction    extends Yaf_Action_Abstract
{
    protected $name;

    protected $desc;

    protected $table;
    public function execute()
     {
         $this->name = request('name');
         $this->desc = request('desc');
         $this->setTable();
         $this->fillable();
         $this->model();
     }

     protected function setTable()
     {
         $databaseName = Yaf_Registry::get('config')->get('mysql.database');
         $this->table = DB::select("SELECT * FROM  INFORMATION_SCHEMA.COLUMNS WHERE table_name=? and table_schema=? ",[$this->name,$databaseName]);
     }

    public function fillable()
    {
        $arr = [];
        $str = '';
        foreach ($this->table as $v){
            if (!in_array($v->COLUMN_NAME,['id'])){
                $str .=  "'".$v->COLUMN_NAME."',//".$v->COLUMN_COMMENT."\n        ";

            }
        }
        return $str;
    }

    public function getStartTime()
    {

        foreach ($this->table as $v){
            if (in_array($v->COLUMN_NAME,Select::start_time)){
               return "const CREATED_AT = '".$v->COLUMN_NAME."';";
            }
        }

        return '';
    }

    public function getUpdateTime()
    {

        foreach ($this->table as $v){
            if (in_array($v->COLUMN_NAME,Select::update_time)){
                return "const UPDATED_AT = '".$v->COLUMN_NAME."';";
            }
        }

        return '';
    }

    public function getTimestamps()
    {
        if ($this->getStartTime()&&$this->getUpdateTime()){
             return 'true';
        }

        return 'false';
    }

    public function formatName()
    {
        $name = explode('_',$this->name);
         $str = '';
        foreach ($name as $v){
           $str .= ucfirst($v);
        }
        $str .= 'Model';
        return $str;
    }

    public function model()
    {
       $name = '$table';
       $timestamps = '$timestamps';
       $fillable = '$fillable';
        $str = "<?php

use Illuminate\\Database\\Eloquent\\Model;

class ".$this->formatName()." extends Model
{
    protected  $name = '".$this->name."';

    public $timestamps = ".$this->getTimestamps().";

    protected  $fillable = [
        ".$this->fillable()."
    ];
    
    ".$this->getStartTime()."
    
    ".$this->getUpdateTime()."
    
    public function scopeSearch(\$query,\$request)
    {
        //此处写搜索的逻辑查询
    }
    
    

    
} ";
    FileManager::write(APPLICATION_PATH.'/app/models/'.rtrim($this->formatName(),'Model').'.php',$str);
        die;

    }


}