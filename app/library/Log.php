<?php

/**
 * Class Log
 * 日志类
 * @see \Monolog\Logger
 * @method static log($level, $message, array $context = array())
 * @method static info($message, array $context = array())
 * @method static debug($message, array $context = array())
 * @method static notice($message, array $context = array())
 * @method static warn($message, array $context = array())
 * @method static warning($message, array $context = array())
 * @method static err($message, array $context = array())
 * @method static error($message, array $context = array())
 * @method static crit($message, array $context = array())
 * @method static critical($message, array $context = array())
 * @method static alert($message, array $context = array())
 * @method static emerg($message, array $context = array())
 * @method static emergency($message, array $context = array())
 */
class Log
{
    protected static $profer;

    protected static $name;
    /**
     * @param string $name
     * @return \Monolog\Logger
     */
    private static function getLogger($name)
    {
       return new \Monolog\Logger($name);
    }

    /**
     * @return \Monolog\Logger
     */
    public static function handler($name = 'yaf')
    {
        self::$name = $name;

        FileManager::make(self::logPath(),true);

        $handler = self::getLogger($name)->pushHandler(((new \Monolog\Handler\StreamHandler(self::logPath().date('Y-m-d').'.log'))->setFormatter(new \Monolog\Formatter\LineFormatter(null, null, true, true))));

        return $handler;
    }

    public static function logPath()
    {
        return APPLICATION_PATH.'/storage/logs/'.self::$name.'/';
    }

    public static function __callStatic($name, $arguments)
    {
        return self::handler('yaf')->$name(...$arguments);
    }

    public function __call($name, $arguments)
    {
        return self::$name(...$arguments);
    }
}
