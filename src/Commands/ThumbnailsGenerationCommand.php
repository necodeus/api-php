<?php

namespace Commands;

use Libraries\Color;
use Libraries\Database;

set_time_limit(10000);

class ThumbnailsGenerationCommand extends \BaseCommand
{
    protected $name = 'thumbnails:generate';

    protected $description = '';

    protected Database $db;

    protected $dimensions = [
        'POST_MAIN_IMAGE' => [
            [1200, 430],
            [900, 430],
            [800, 430],
        ],
        'PROFILE_PICTURE' => [
            [25, 25],
            [35, 35],
            [50, 50],
        ],
    ];

    public function __construct()
    {
        $this->db = new Database(
            $_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_PORT'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD'],
            $_ENV['DATABASE_NAME'],
        );
    }

    public function handle($arguments)
    {
        $query = "SELECT
            id,
            `type`,
            local_path,
            remote_path,
            resolution_x,
            resolution_y,
            `size`,
            mime_type,
            uploaded_at
        FROM c_images
        ";

        $images = $this->db->fetchAll($query);

        foreach ($images as $image) {
            foreach ($this->dimensions[$image['type']] as $dimension) {
                Color::print("Generating thumbnails for image {$image['id']} with dimension {$dimension[0]}x{$dimension[1]}...\n", 'lightgreen');

                $remotePath = "https://images.necodeo.com/{$image['id']}";
                $localPath = "." . $image['local_path'];

                if (!\file_exists($localPath)) {
                    $this->downloadImage($remotePath, $localPath);
                }

                if (!\imagecreatefromjpeg($localPath)) {
                    continue;
                }

                $this->generateThumbnail($localPath, $dimension);
            }
        }
    }

    protected function downloadImage(string $remotePath, string $localPath): bool
    {
        $ch = \curl_init($remotePath);

        $fp = \fopen($localPath, 'wb');

        \curl_setopt($ch, CURLOPT_FILE, $fp);
        \curl_setopt($ch, CURLOPT_HEADER, 0);

        \curl_exec($ch);

        \curl_close($ch);
        \fclose($fp);

        return true;
    }

    protected function generateThumbnail(string $localPath = null, $dimension = null): bool
    {
        if (!$localPath) {
            return false;
        }

        if (!$dimension) {
            return false;
        }

        $image = \imagecreatefromjpeg($localPath);
        $width = \imagesx($image);
        $height = \imagesy($image);

        $thumbWidth = $dimension[0];
        $thumbHeight = $dimension[1];

        $originalAspect = $width / $height;
        $thumbAspect = $thumbWidth / $thumbHeight;

        if ($originalAspect >= $thumbAspect) {
            $newHeight = $thumbHeight;
            $newWidth = \floor($width / ($height / $thumbHeight));
        } else {
            $newWidth = $thumbWidth;
            $newHeight = \floor($height / ($width / $thumbWidth));
        }

        $thumb = \imagecreatetruecolor($thumbWidth, $thumbHeight);

        \imagecopyresampled(
            $thumb,
            $image,
            \floor(0 - ($newWidth - $thumbWidth) / 2),
            \floor(0 - ($newHeight - $thumbHeight) / 2),
            0,
            0,
            $newWidth,
            $newHeight,
            $width,
            $height,
        );

        \imagejpeg($thumb, $localPath . '_' . $dimension[0] . 'x' . $dimension[1], 100);

        return true;
    }
}
