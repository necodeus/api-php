<?php

declare(strict_types=1);

namespace Tests;

require_once __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../src/Controllers/BaseController.php';
require __DIR__ . '/../src/Controllers/CommonApi/ImageController.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use PHPUnit\Framework\TestCase;

final class ImageControllerTest extends TestCase
{
    public function testIfUploadReturnsTrue(): void
    {
        $image = new \Controllers\CommonApi\ImageController();

        $_FILES['post_profile_image'] = [
            'tmp_name' => 'test',
        ];

        $result = $image->upload();

        $this->assertTrue($result);
    }
}
