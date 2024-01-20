<?php

namespace Controllers\Images;

use Libraries\File;

class OutputController
{
    public function load(string $id): void
    {
        $file = new File('../uploads', $id);

        if ($file->exists() === false) {
            http_response_code(404);
            print 404;
            return;
        }

        response($file->getContents())->status(200);
    }

    public function loadThumbnail(string $id, string $dimension): void
    {
        $file = new File('../uploads', $id . '_' . $dimension);

        if ($file->exists() === false) {
            http_response_code(404);
            print 404;
            return;
        }

        response($file->getContents())->status(200);
    }
}
