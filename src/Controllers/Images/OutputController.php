<?php 

namespace Controllers\Images;

use Services\Filesystem;

class OutputController
{
    public function load(string $id)
    {
        $file = Filesystem::load('../uploads', $id);

        if ($file->exists() === false) {
            return response()->status(404);
        }

        return response($file->getContents())->status(200);
    }
}
