<?php

namespace Services;

class File
{
    private $path;
    private $filename;

    public function __construct(string $path, string $filename)
    {
        $this->path = $path;
        $this->filename = $filename;
    }

    public function exists(): bool
    {
        $path = $this->path . '/' . $this->filename;

        return file_exists($path);
    }

    public function getContents(): string
    {
        $path = $this->path . '/' . $this->filename;

        return file_get_contents($path);
    }

    public function save(string $contents): void
    {
        $path = $this->path . '/' . $this->filename;

        file_put_contents($path, $contents);
    }
}
