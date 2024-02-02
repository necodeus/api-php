<?php 

namespace Libraries;

class FileResponse
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

    protected function guessMimeType(string $data): ?string
    {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->buffer($data);

        return $mimeType;
    }

    public function data($data): ?string
    {
        try {
            $mimeType = $this->guessMimeType($data);

            $this->header('Content-Type', $mimeType);

            return $data;
        } catch (\Throwable $e) {
            $message = $e->getMessage();

            log_to_file($message, \Enums\LogLevel::EXCEPTION);
        }

        return null;
    }
}