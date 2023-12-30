<?php

use Libraries\Performance;
use Libraries\Text;
use Libraries\FileLogger;

function uuidv4() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function performance(): Performance
{
    return new Performance();
}

function logger(): FileLogger
{
    return new FileLogger();
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
