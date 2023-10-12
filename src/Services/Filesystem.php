<?php 

namespace Services;

use Services\File;

class Filesystem
{
    public static function load(string $path, string $filename)
    {
        $file = new File($path, $filename);

        return $file;
    }
}
