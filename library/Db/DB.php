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

    public static function select($sql,array $binding = [])
    {
        $instance = static::instance();
        $statement = $instance->prepare($sql);
        self::bindValues($statement,$binding);
        $statement->execute();
        return $statement->fetchAll();
    }


    public static function beginTransaction()
    {
        static::instance()->beginTransaction();
    }


    public static function rollBack()
    {
        static::instance()->rollBack();
    }


    public static function commit()
    {
        static::instance()->commit();
    }


    /**
     * Bind values to their parameters in the given statement.
     *
     * @param  \PDOStatement $statement
     * @param  array  $bindings
     * @return void
     */
    protected static function bindValues($statement, $bindings)
    {
        foreach ($bindings as $key => $value) {
            $statement->bindValue(
                is_string($key) ? $key : $key + 1, $value,
                is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR
            );
        }
    }
}