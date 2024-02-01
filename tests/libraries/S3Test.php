<?php

namespace Tests;

require_once __DIR__ . '/../../public/bootstrap-tests.php';

use PHPUnit\Framework\TestCase;
use Libraries\S3;

final class S3Test extends TestCase
{
    public function testIfUploadStatusCodeIs200(): void
    {
        $s3 = new S3();

        $result = $s3->upload('hello', 'key', 'body');

        $statusCode = $result->get('@metadata')['statusCode'];

        $this->assertEquals(200, $statusCode);
    }
}
