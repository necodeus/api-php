<?php

namespace Controllers\Images;

use Enums\ControllerResponseType;
use Libraries\File;

class OutputController
{
    public function load(string $id): string
    {
        // If the request is made from the local environment, the image is fetched from the production server
        if ($_SERVER['HTTP_HOST'] === 'images.localhost') {
            $data = file_get_contents('https://images.necodeo.com/' . $id);

            if ($data === false) {
                return response(ControllerResponseType::FILE)
                    ->status(404)
                    ->data('File not found');
            }

            $file = new File('../uploads', $id);
            $file->save($data);
        }

        $file = new File('../uploads', $id);

        // If the file does not exist, a 404 response is returned
        if (!$file->exists()) {
            return response(ControllerResponseType::FILE)
                ->status(404)
                ->data('File not found');
        }

        $contents = $file->getContents();

        return response(ControllerResponseType::FILE)
            ->status(200)
            ->data($contents);
    }

    public function loadThumbnail(string $id, string $dimension): string
    {
        $dimensionId = $id . '_' . $dimension;

        if ($_SERVER['HTTP_HOST'] === 'images.localhost') {
            $data = file_get_contents('https://images.necodeo.com/' . $dimensionId);

            if ($data === false) {
                return response(ControllerResponseType::FILE)
                    ->status(404)
                    ->data('File not found');
            }

            $file = new File('../uploads', $dimensionId);
            $file->save($data);
        }

        $file = new File('../uploads', $dimensionId);

        if ($file->exists() === false) {
            return response(ControllerResponseType::FILE)
                ->status(404)
                ->data('File not found');
        }

        $contents = $file->getContents();

        return response(ControllerResponseType::FILE)
            ->status(200)
            ->data($contents);
    }
}
