<?php

namespace Tests;

require_once __DIR__ . '/../../public/bootstrap-tests.php';

use PHPUnit\Framework\TestCase;

use Libraries\File;

final class FileTest extends TestCase
{
    public function testIfFileExists(): void
    {
        $file = new File('tests/libraries', 'FileTest.php');

        $result = $file->exists();

        $this->assertTrue($result);
    }
}
