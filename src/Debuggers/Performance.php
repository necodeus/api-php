<?php 

namespace Debuggers;

class Performance
{
    private array $times = [];

    private static ?Performance $instance = null;

    public static function init()
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
