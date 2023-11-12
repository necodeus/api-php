<?php

use Debuggers\Performance;
use Responses\Text;

function performance(): Performance
{
    return new Performance();
}

function logger(): FileLogger
{
    return new FileLogger();
}

class FileLogger
{
    public function info(string $message): void
    {
        $this->log('INFO', $message);
    }

    public function error(string $message): void
    {
        $this->log('ERROR', $message);
    }

    public function log(string $level, string $message): void
    {
        $log = sprintf("[%s] %s\n", $level, $message);

        file_put_contents(
            $_ENV['LOG_FILE'],
            $log,
            FILE_APPEND
        );
    }
}

function response($data = ""): Text
{
    return new Text($data);
}

function snake_to_pascalcase(string $array): string
{
    return str_replace('_', '', ucwords($array, '_'));
}

function snake_to_camelcase(string $name): string
{
    return lcfirst(str_replace('_', '', ucwords($name, '_')));
}

function array_keys_camelcase(array $array): array
{
    $result = [];

    foreach ($array as $key => $value) {
        $newKey = snake_to_camelcase($key);
        $result[$newKey] = $value;
    }

    return $result;
}
