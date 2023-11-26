<?php

namespace Controllers\CommonApi;

use Controllers\BaseController;

use Repositories\Common\CommonImagesRepo;
use Enums\ImageTypeEnum;

class ImageController extends BaseController
{
    private CommonImagesRepo $images;

    public function __construct()
    {
        parent::__construct();

        $this->images = new CommonImagesRepo();
    }

    public function upload(): void
    {
        $filePath = $_FILES['post_profile_image'] ?? null;

        if (!$filePath) {
            header('Content-Type: application/json');
            print json_encode([
                'status' => 'error',
                'message' => 'No file provided',
            ]);
            return;
        }

        try {
            $image = $this->images->upload($filePath['tmp_name'], ImageTypeEnum::PostMainImage);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            print json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
            return;
        }

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'image' => $image,
        ]);
    }
}