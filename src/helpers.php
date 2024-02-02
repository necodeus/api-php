<?php

use Enums\ControllerResponseType;

function uuidv4() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function performance(): Libraries\Performance
{
    return new Libraries\Performance();
}

function log_to_file(string $message, Enums\LogLevel $level = Enums\LogLevel::INFO): void
{
    $log = sprintf("[%s] %s\n", $level, $message);

    file_put_contents(
        $_ENV['LOG_FILE'],
        $log,
        FILE_APPEND
    );
}

/**
 * @throws Exception
 */
function response(ControllerResponseType $type): Libraries\JsonResponse | Libraries\FileResponse
{
    switch ($type) {
        case ControllerResponseType::JSON: {
            $obj = new Libraries\JsonResponse();

            return $obj->header('Content-Type', 'application/json');
        }
        case ControllerResponseType::FILE: {
            return new Libraries\FileResponse();
        }
    }

    throw new Exception('Invalid response type');
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
