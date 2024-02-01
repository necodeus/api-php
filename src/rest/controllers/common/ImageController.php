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

    public function upload(): void
    {
        try {
            $filePath = $_FILES['post_profile_image'] ?? null;

            if (!$filePath) {
                response([
                    'status' => 'error',
                    'message' => 'No file provided',
                ])->status(400);
                return;
            }

            $image = $this->common->uploadImage($filePath['tmp_name'], ImageTypeEnum::PostMainImage);

            // This shit shouldn't print anything.
            // Controllers should return object|array (I guess).
            response([
                'status' => 'ok',
                'image' => $image,
            ])->status(500);
        } catch (\Exception $e) {
            response([
                'status' => 'error',
                'message' => $e->getMessage(),
            ])->status(500);
        }
    }
}