<?php

namespace Controllers\CommonApi;

use Controllers\BaseController;

use Enums\ImageTypeEnum;
use Repositories\CommonRepository;

class ImageController extends BaseController
{
    private CommonRepository $common;

    public function __construct()
    {
        parent::__construct();

        $this->common = new CommonRepository();
    }

    public function upload(): bool
    {
        $filePath = $_FILES['post_profile_image'] ?? null;

        if (!$filePath) {
            @header('Content-Type: application/json');

            print json_encode([
                'status' => 'error',
                'message' => 'No file provided',
            ]);

            return false;
        }

        try {
            $image = $this->common->uploadImage($filePath['tmp_name'], ImageTypeEnum::PostMainImage);
        } catch (\Exception $e) {
            @header('Content-Type: application/json');

            print json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);

            return false;
        }

        @header('Content-Type: application/json');

        print json_encode([
            'status' => 'ok',
            'image' => $image,
        ]);

        return true;
    }
}