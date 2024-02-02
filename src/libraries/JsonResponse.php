<?php

namespace Libraries;

class JsonResponse
{
    public function status(int $code): self
    {
        http_response_code($code);

        return $this;
    }

    public function headers(array $headers): self
    {
        foreach ($headers as $key => $value) {
            @header("{$key}: {$value}");
        }

        return $this;
    }

    public function header(string $key, string $value): self
    {
        @header("{$key}: {$value}");

        return $this;
    }

    public function data($data): ?string
    {
        try {
            return json_encode($data);
        } catch (\Throwable $e) {
            $message = $e->getMessage();

            log_to_file($message, \Enums\LogLevel::EXCEPTION);
        }

        return null;
    }
}
