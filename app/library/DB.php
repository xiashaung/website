<?php

/**
 * Class DB
 * @method static  selectOne($query, $bindings = [], $useReadPdo = true)
 * @method static  select($query, $bindings = [], $useReadPdo = true)
 * @method static  cursor($query, $bindings = [], $useReadPdo = true)
 * @method static  insert($query, $bindings = [])
 * @method static  update($query, $bindings = [])
 * @method static  delete($query, $bindings = [])
 * @method static  statement($query, $bindings = [])
 * @method static  transaction(Closure $callback, $attempts = 1)
 * @method static  beginTransaction()
 * @method static  commit()
 * @method static  rollBack($toLevel = null)
 */
class DB
{
    /**
     * @return \Illuminate\Database\Connection
     */
    protected static function getConnection()
    {
        return  Yaf_Registry::get('capsule')->getConnection();
    }

    /**
     * @param $table
     * @return \Illuminate\Database\Query\Builder
     */
    public static function table($table)
    {
        return self::getConnection()->table($table);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::getConnection()->$name(...$arguments);
    }


}