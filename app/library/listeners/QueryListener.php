<?php
namespace Listeners;
use Events\Query;
use \Illuminate\Database\Events\QueryExecuted;
/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/3/15
 * Time: 14:08
 */
class QueryListener
{
    /**
     * Handle the event.
     *
     * @param  QueryExecuted | Query  $event
     * @return void
     */
    public function handle($event)
    {
        $event->sql  = vsprintf(str_replace("?", "'%s'", $event->sql), $event->bindings);
        \Log::handler('sql_log')->info(json_encode($event));
    }
}