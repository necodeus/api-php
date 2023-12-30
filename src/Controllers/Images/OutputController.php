<?php

namespace Controllers\Images;

use Services\Filesystem;
use Libraries\File;

class OutputController
{
    public function load(string $id)
    {
        $file = new File('../uploads', $id);

        if ($file->exists() === false) {
            return response()->status(404);
        }

        return response($file->getContents())->status(200);
    }
}
