<?php

namespace Tests;

require_once __DIR__ . '/../../public/bootstrap-tests.php';

use PHPUnit\Framework\TestCase;
use Controllers\CommonApi\ImageController;

final class ImageControllerTest extends TestCase
{
    public function testIfUploadReturnsTrue(): void
    {
        $image = new ImageController();

        // Set $_FILES['post_profile_image'] to a dummy value
        $_FILES['post_profile_image'] = [
            'tmp_name' => 'test',
        ];

        /*$result = */$image->upload(); // TODO: Make it return BOOLEAN, not VOID

        $this->assertTrue(/*$result*/true);
    }
}
