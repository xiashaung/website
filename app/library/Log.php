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
    private function getLogger()
    {
       return new \Monolog\Logger('yaf');
    }

    /**
     * @return \Monolog\Logger
     */
    private function handler()
    {
        FileManager::make($this->logPath(),true);

        $handler = $this->getLogger()->pushHandler(((new \Monolog\Handler\StreamHandler($this->logPath().date('Y-m-d').'.log'))->setFormatter(new \Monolog\Formatter\LineFormatter(null, null, true, true))));

        return $handler;
    }

    public function logPath()
    {
        return APPLICATION_PATH.'/storage/logs/yaf/';
    }

    public static function __callStatic($name, $arguments)
    {
        return (new static())->handler()->$name(...$arguments);
    }

    public function __call($name, $arguments)
    {
        $this->handler()->$name(...$arguments);
    }
}
