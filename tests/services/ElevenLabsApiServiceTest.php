<?php

namespace Tests;

require_once __DIR__ . '/../../public/bootstrap-tests.php';

use PHPUnit\Framework\TestCase;

use Services\ElevenLabsApiService;

final class ElevenLabsApiServiceTest extends TestCase
{
    public function testIfTextToSpeechEndpointOk(): void
    {
        if (empty($_ENV['ELEVENLABS_API_TOKEN'])) {
            $this->markTestSkipped('ELEVENLABS_API_TOKEN not set');
        }

        $result = ElevenLabsApiService::textToSpeech('hello world');

        $this->assertNotNull($result['path']);
        $this->assertFileExists($result['path']);
        $this->assertEquals('audio/mpeg', $result['contentType']);
    }

    public function testIfGetHistoryReturnsNull(): void
    {
        if (empty($_ENV['ELEVENLABS_API_TOKEN'])) {
            $this->markTestSkipped('ELEVENLABS_API_TOKEN not set');
        }

        $result = ElevenLabsApiService::getHistory();

        $this->assertNotNull($result);
    }
}
