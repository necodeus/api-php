<?php

namespace Tests;

require_once __DIR__ . '/../../public/bootstrap-tests.php';

use PHPUnit\Framework\TestCase;
use Services\ElevenLabsApiService;

final class ElevenLabsApiServiceTest extends TestCase
{
    public function testIfGetHistoryReturnsArray(): void
    {
        $result = ElevenLabsApiService::getHistory();

        $this->assertIsArray($result);
    }
}
