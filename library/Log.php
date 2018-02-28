<?php
class Log
{
    public function getLogger()
    {
       return new \Monolog\Logger('yaf');
    }

    /**
     * @return \Monolog\Logger
     */
    public function handler()
    {
        $handler = $this->getLogger()->pushHandler(((new \Monolog\Handler\StreamHandler(APPLICATION_PATH.'/storage/logs/yaf/'.date('Y-m-d').'.log'))->setFormatter(new \Monolog\Formatter\LineFormatter(null, null, true, true))));

        return $handler;
    }

    public static function __callStatic($name, $arguments)
    {
        return (new static())->handler()->$name(...$arguments);
    }
}
