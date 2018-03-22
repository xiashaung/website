<?php
namespace Events;
/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/15
 * Time: 14:43
 */
class Query
{

    public $sql;


    public $bindings;


    public $time;


    /**
     * Create a new event instance.
     *
     * @param  string  $sql
     * @param  array  $bindings
     * @param  float|null  $time
     * @return void
     */
    public function __construct($sql, $bindings, $time)
    {
        $this->sql = $sql;
        $this->time = $time;
        $this->bindings = $bindings;
    }
}