<?php 

use Debuggers\Performance;

function performance(): Performance
{
    return new Performance();
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
