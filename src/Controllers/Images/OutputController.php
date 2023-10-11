<?php 

namespace Controllers\Images;

class OutputController
{
    public function load(string $id): void
    {
        if (!file_exists("../uploads/{$id}")) {
            header("HTTP/1.1 404 Not Found");
            return;
        }

        header("Content-type: image/jpeg");
        print file_get_contents("../uploads/{$id}");
    }
}
