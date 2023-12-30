<?php

namespace Libraries;

class Text
{
    protected $data;

    public function __construct($data)
    {
        if (is_array($data)) {
            header('Content-Type: application/json');
            $this->data = json_encode($data);
        } else {
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($data);

            header("Content-Type: {$mimeType}");
            $this->data = $data;
        }
    }

    public function status(int $code)
    {
        http_response_code($code);
    }

    public function __destruct()
    {
        echo $this->data;
    }
}
