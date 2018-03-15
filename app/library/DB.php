<?php
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
           self::$connection = new \PDO("mysql:host=$config[host];dbname=$config[database]",$config['username'],$config['password'],[PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8',PDO::ATTR_PERSISTENT => true]);
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
        $start = microtime(true);

        $statement = static::instance()->prepare($sql);

        self::bindValues($statement,self::prepareBindings($binding));

        $statement->execute();

        Yaf_Registry::get('event')->dispatch(new \Events\Query($sql,$binding,self::getTime($start)));

        return $statement->fetchAll(PDO::FETCH_OBJ);
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

    public static function prepareBindings(array $bindings)
    {

        foreach ($bindings as $key => $value) {
            if ($value instanceof DateTimeInterface) {
                $bindings[$key] = $value->format('Y-m-d H:i:s');
            } elseif (is_bool($value)) {
                $bindings[$key] = (int) $value;
            }
        }

        return $bindings;
    }



    /**
     * Bind values to their parameters in the given statement.
     *
     * @param  \PDOStatement $statement
     * @param  array  $bindings
     * @return   void
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

   protected static function getTime($start)
   {
       return round((microtime(true) - $start) * 1000, 2);
   }
}