<?php 

namespace Debuggers;

class Performance
{
    protected array $times = [];

    protected static ?Performance $instance = null;

    protected static function init()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
    }

    public static function measure()
    {
        self::init();

        self::$instance->times[] = microtime(true);
    }

    public static function result(): float
    {
        self::init();

        $times = self::$instance->times;
        $last = array_pop($times);
        $first = array_shift($times);

        return $last - $first;
    }
}
