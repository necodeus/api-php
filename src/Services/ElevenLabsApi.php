<?php 

namespace Services;

class ElevenLabsApi
{
    /**
     * Convert text to speech
     * 
     * POST https://api.elevenlabs.io/v1/text-to-speech/kIZ5Hw3uqBbzuhBs855A
     */
    public static function textToSpeech(string $text, string $modelId = 'eleven_multilingual_v2', $voiceId = 'kIZ5Hw3uqBbzuhBs855A'): void
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', "https://api.elevenlabs.io/v1/text-to-speech/{$voiceId}/stream", [
            'headers' => [
                'accept' => 'audio/mpeg',
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'text' => $text,
                'model_id' => $modelId,
                'voice_settings' => [
                    'similarity_boost' => 0.87,
                    'stability' => 0.87,
                    'style' => 0.06,
                    'use_speaker_boost' => true,
                ],
            ],
        ]);

        header('Content-Type: audio/mpeg');
        print $response->getBody()->getContents();
    }

    /**
     * Get the list of available models
     * 
     * GET https://api.elevenlabs.io/v1/models
     */
    public static function getModels(): void
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.elevenlabs.io/v1/models', [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }
}
