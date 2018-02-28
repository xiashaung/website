<?php
namespace Library\Db;
class DB
{
    /**
     * @var \PDO
     */
     private static  $connection;

    protected static function connection()
    {
       if (!self::$connection){
           $config = self::getMysqlConfig();
           self::$connection = new \PDO("mysql:host=$config[host];dbname=$config[database]",$config['username'],$config['password']);
       }

       return self::$connection;
    }

    /**
     * @return \PDO
     */
    public static function instance()
    {
        return self::connection();
    }

    public static function getMysqlConfig()
    {
        return MYSQL_CONFIG;
    }

    public static function select($sql)
    {
        return static::instance()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
    }
}