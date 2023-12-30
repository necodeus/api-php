<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    public function testFileExists(): void
    {
        $file = new \Services\File('tests', 'ExampleTest.php');

        $result = $file->exists();

        $this->assertTrue($result);
    }
}
