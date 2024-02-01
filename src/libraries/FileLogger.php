<?php

namespace Libraries;

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
