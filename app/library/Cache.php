<?php
use Cache\Redis;

/**
 *
 * @method static del(array $keys)
 * @method static dump($key)
 * @method static exists($key)
 * @method static expire($key, $seconds)
 * @method static expireat($key, $timestamp)
 * @method static keys($pattern)
 * @method static move($key, $db)
 * @method static object($subcommand, $key)
 * @method static persist($key)
 * @method static pexpire($key, $milliseconds)
 * @method static pexpireat($key, $timestamp)
 * @method static pttl($key)
 * @method static randomkey()
 * @method static rename($key, $target)
 * @method static renamenx($key, $target)
 * @method static scan($cursor, array $options = null)
 * @method static sort($key, array $options = null)
 * @method static ttl($key)
 * @method static type($key)
 * @method static append($key, $value)
 * @method static bitcount($key, $start = null, $end = null)
 * @method static bitop($operation, $destkey, $key)
 * @method static decr($key)
 * @method static decrby($key, $decrement)
 * @method static get($key)
 * @method static getbit($key, $offset)
 * @method static getrange($key, $start, $end)
 * @method static getset($key, $value)
 * @method static incr($key)
 * @method static incrby($key, $increment)
 * @method static incrbyfloat($key, $increment)
 * @method static mget(array $keys)
 * @method static mset(array $dictionary)
 * @method static msetnx(array $dictionary)
 * @method static psetex($key, $milliseconds, $value)
 * @method static set($key, $value, $timeout = 0)
 * @method static setbit($key, $offset, $value)
 * @method static setex($key, $seconds, $value)
 * @method static setnx($key, $value)
 * @method static setrange($key, $offset, $value)
 * @method static strlen($key)
 * @method static hdel($key, array $fields)
 * @method static hexists($key, $field)
 * @method static hget($key, $field)
 * @method static hgetall($key)
 * @method static hincrby($key, $field, $increment)
 * @method static hincrbyfloat($key, $field, $increment)
 * @method static hkeys($key)
 * @method static hlen($key)
 * @method static hmget($key, array $fields)
 * @method static hmset($key, array $dictionary)
 * @method static hscan($key, $cursor, array $options = null)
 * @method static hset($key, $field, $value)
 * @method static hsetnx($key, $field, $value)
 * @method static hvals($key)
 * @method static hstrlen($key, $field)
 * @method static blpop(array $keys, $timeout)
 * @method static brpop(array $keys, $timeout)
 * @method static brpoplpush($source, $destination, $timeout)
 * @method static lindex($key, $index)
 * @method static linsert($key, $whence, $pivot, $value)
 * @method static llen($key)
 * @method static lpop($key)
 * @method static lpush($key, array $values)
 * @method static lpushx($key, $value)
 * @method static lrange($key, $start, $stop)
 * @method static lrem($key, $count, $value)
 * @method static lset($key, $index, $value)
 * @method static ltrim($key, $start, $stop)
 * @method static rpop($key)
 * @method static rpoplpush($source, $destination)
 * @method static rpush($key, array $values)
 * @method static rpushx($key, $value)
 * @method static sadd($key, array $members)
 * @method static scard($key)
 * @method static sdiff(array $keys)
 * @method static sdiffstore($destination, array $keys)
 * @method static sinter(array $keys)
 * @method static sinterstore($destination, array $keys)
 * @method static sismember($key, $member)
 * @method static smembers($key)
 * @method static smove($source, $destination, $member)
 * @method static spop($key, $count = null)
 * @method static srandmember($key, $count = null)
 * @method static srem($key, $member)
 * @method static sscan($key, $cursor, array $options = null)
 * @method static sunion(array $keys)
 * @method static sunionstore($destination, array $keys)
 * @method static zadd($key, array $membersAndScoresDictionary)
 * @method static zcard($key)
 * @method static zcount($key, $min, $max)
 * @method static zincrby($key, $increment, $member)
 * @method static zinterstore($destination, array $keys, array $options = null)
 * @method static zrange($key, $start, $stop, array $options = null)
 * @method static zrangebyscore($key, $min, $max, array $options = null)
 * @method static zrank($key, $member)
 * @method static zrem($key, $member)
 * @method static zremrangebyrank($key, $start, $stop)
 * @method static zremrangebyscore($key, $min, $max)
 * @method static zrevrange($key, $start, $stop, array $options = null)
 * @method static zrevrangebyscore($key, $min, $max, array $options = null)
 * @method static zrevrank($key, $member)
 * @method static zunionstore($destination, array $keys, array $options = null)
 * @method static zscore($key, $member)
 * @method static zscan($key, $cursor, array $options = null)
 * @method static zrangebylex($key, $start, $stop, array $options = null)
 * @method static zrevrangebylex($key, $start, $stop, array $options = null)
 * @method static zremrangebylex($key, $min, $max)
 * @method static zlexcount($key, $min, $max)
 * @method static pfadd($key, array $elements)
 * @method static pfmerge($destinationKey, array $sourceKeys)
 * @method static pfcount(array $keys)
 * @method static pubsub($subcommand, $argument)
 * @method static publish($channel, $message)
 * @method static discard()
 * @method static exec()
 * @method static multi()
 * @method static unwatch()
 * @method static watch($key)
 * @method static eval($script, $numkeys, $keyOrArg1 = null, $keyOrArgN = null)
 * @method static evalsha($script, $numkeys, $keyOrArg1 = null, $keyOrArgN = null)
 * @method static script($subcommand, $argument = null)
 * @method static auth($password)
 * @method static echo ($message)
 * @method static ping($message = null)
 * @method static select($database)
 * @method static bgrewriteaof()
 * @method static bgsave()
 * @method static client($subcommand, $argument = null)
 * @method static config($subcommand, $argument = null)
 * @method static dbsize()
 * @method static flushall()
 * @method static flushdb()
 * @method static info($section = null)
 * @method static lastsave()
 * @method static save()
 * @method static slaveof($host, $port)
 * @method static slowlog($subcommand, $argument = null)
 * @method static time()
 * @method static command()
 * @method static geoadd($key, $longitude, $latitude, $member)
 * @method static geohash($key, array $members)
 * @method static geopos($key, array $members)
 * @method static geodist($key, $member1, $member2, $unit = null)
 * @method static georadius($key, $longitude, $latitude, $radius, $unit, array $options = null)
 * @method static georadiusbymember($key, $member, $radius, $unit, array $options = null)
 *
 */
class Cache
{

    public static $drive = 'redis';

    /**
     * @param $key string|int 缓存的key
     * @param int $second 缓存的时间 以秒为单位
     * @param \Closure $closure 缓存不存在时 缓存此闭包返回的值
     * @return mixed
     */
    public static function remember($key, \Closure $closure, $second = 0)
    {
        $drive = self::getDrive();

        $value = $drive->get($key);

        if (!is_null($value)) {
            return $value;
        }

        if ($second) {
            $drive->set($key, $value = $closure(), $second);
        } else {
            $drive->set($key, $value = $closure());
        }
        return $value;
    }

    /**
     * 以redis的管道模式实现
     * 只支持redis
     * @param $bool  \Closure|string|null|boolean  判断的值
     * @param \Closure $closure 闭包函数
     * @return mixed
     */
    public static function pipeline($bool, \Closure $closure)
    {
        $redis = Redis::getInstance();
        //开启redis管道
        $redis->pipeline();

        $exec = $closure($redis);

        if ($bool) {
            $redis->exec();
        } else {
            $redis->discard();
        }

        return $exec;

    }

    /**
     * @return \Cache\File|\Redis
     */
    private static function getDrive()
    {
        switch (strtolower(self::$drive)) {
            case 'redis':
                return Redis::getInstance();
                break;
            case 'file':
                return \Cache\File::getInstance();
                break;
        }
    }

    public static function __callStatic($name, $arguments)
    {
        return self::getDrive()->$name(...$arguments);
    }


}
