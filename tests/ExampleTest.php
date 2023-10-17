<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use Services\File;

final class ExampleTest extends TestCase
{
    public function testFileExists(): void
    {
        $f = new File('tests', 'ExampleTest.php');

        $this->assertEquals(true, $f->exists());
    }
}
