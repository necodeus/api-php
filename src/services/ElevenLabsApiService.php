<?php

namespace Services;

use GuzzleHttp\Client;

class ElevenLabsApi
{
    /******************************
     * T E X T   T O   S P E E C H
     ******************************/

    /**
     * Converts text into speech using a voice of your choice and returns audio
     *
     * POST https://api.elevenlabs.io/v1/text-to-speech/kIZ5Hw3uqBbzuhBs855A
     */
    public static function textToSpeech(string $text, array $settings = []): void
    {
        $client = new Client();

        $voiceId = $settings['voiceId'] ?? 'kIZ5Hw3uqBbzuhBs855A';

        $response = $client->request('POST', "https://api.elevenlabs.io/v1/text-to-speech/{$voiceId}/stream", [
            'headers' => [
                'accept' => 'audio/mpeg',
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'text' => $text,
                'model_id' => $settings['modelId'] ?? 'eleven_multilingual_v2',
                'voice_settings' => [
                    'similarity_boost' => $settings['similarityBoost'] ?? 0.87,
                    'stability' => $settings['stability'] ?? 0.87,
                    'style' => $settings['style'] ?? 0.06,
                    'use_speaker_boost' => $settings['useSpeakerBoost'] ?? true,
                ],
            ],
        ]);

        header('Content-Type: audio/mpeg');
        print $response->getBody()->getContents();
    }

    /**************
     * M O D E L S
     **************/

    /**
     * Gets a list of available models
     *
     * GET https://api.elevenlabs.io/v1/models
     */
    public static function getModels(): void
    {
        $client = new Client();

        $response = $client->request('GET', 'https://api.elevenlabs.io/v1/models', [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**************
     * V O I C E S
     **************/

    /**
     * Gets a list of all available voices for a user
     *
     * GET https://api.elevenlabs.io/v1/voices
     */
    public static function getVoices(): void
    {
        $client = new Client();

        $response = $client->request('GET', 'https://api.elevenlabs.io/v1/voices', [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Gets the default settings for voices
     *
     * GET https://api.elevenlabs.io/v1/voices/settings/default
     */
    public static function getDefaultVoiceSettings(): void
    {
        $client = new Client();

        $response = $client->request('GET', 'https://api.elevenlabs.io/v1/voices/settings/default', [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Returns the settings for a specific voice
     *
     * GET https://api.elevenlabs.io/v1/voices/{voice_id}/settings
     */
    public static function getVoiceSettings(string $voiceId): void
    {
        $client = new Client();

        $response = $client->request('GET', "https://api.elevenlabs.io/v1/voices/{$voiceId}/settings", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Returns metadata about a specific voice
     *
     * GET https://api.elevenlabs.io/v1/voices/{voice_id}
     */
    public static function getVoice(string $voiceId): void
    {
        $client = new Client();

        $response = $client->request('GET', "https://api.elevenlabs.io/v1/voices/{$voiceId}", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Deletes a voice by its ID
     *
     * DELETE https://api.elevenlabs.io/v1/voices/{voice_id}
     */
    public static function deleteVoice(string $voiceId): void
    {
        $client = new Client();

        $response = $client->request('DELETE', "https://api.elevenlabs.io/v1/voices/{$voiceId}", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Edit your settings for a specific voice
     *
     * PATCH https://api.elevenlabs.io/v1/voices/{voice_id}/settings/edit
     */
    public static function editVoiceSettings(string $voiceId, array $settings): void
    {
        $client = new Client();

        $response = $client->request('PATCH', "https://api.elevenlabs.io/v1/voices/{$voiceId}/settings/edit", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                'Content-Type' => 'application/json',
            ],
            'json' => $settings,
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Add a new voice to your collection of voices in VoiceLab
     *
     * POST https://api.elevenlabs.io/v1/voices/add
     */
    public static function addVoice(string $name, array $files, $description = null, $labels = null): void
    {
        $client = new Client();

        $response = $client->request('POST', 'https://api.elevenlabs.io/v1/voices/add', [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                'Content-Type' => 'multipart/form-data',
            ],
            'multipart' => [
                [
                    'name' => 'name',
                    'contents' => $name,
                ],
                [
                    'name' => 'files',
                    'contents' => $files,
                ],
                [
                    'name' => 'description',
                    'contents' => $description,
                ],
                [
                    'name' => 'labels',
                    'contents' => $labels,
                ],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Edit a voice created by you
     *
     * POST https://api.elevenlabs.io/v1/voices/{voice_id}/edit
     */
    public static function editVoice(string $voiceId, string $name, array $files = [], $description = null, $labels = null): void
    {
        $client = new Client();

        $response = $client->request('POST', "https://api.elevenlabs.io/v1/voices/{$voiceId}/edit", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                'Content-Type' => 'multipart/form-data',
            ],
            'multipart' => [
                [
                    'name' => 'name',
                    'contents' => $name,
                ],
                [
                    'name' => 'files',
                    'contents' => $files,
                ],
                [
                    'name' => 'description',
                    'contents' => $description,
                ],
                [
                    'name' => 'labels',
                    'contents' => $labels,
                ],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /****************
     * S A M P L E S
     ****************/

    /**
     * Removes a sample by its ID
     *
     * DELETE https://api.elevenlabs.io/v1/voices/{voice_id}/samples/{sample_id}
     */
    public static function deleteSample(string $voiceId, string $sampleId): void
    {
        $client = new Client();

        $response = $client->request('DELETE', "https://api.elevenlabs.io/v1/voices/{$voiceId}/samples/{$sampleId}", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Returns the audio corresponding to a sample attached to a voice
     *
     * GET https://api.elevenlabs.io/v1/voices/{voice_id}/samples/{sample_id}/audio
     */
    public static function getSample(string $voiceId, string $sampleId): void
    {
        $client = new Client();

        $response = $client->request('GET', "https://api.elevenlabs.io/v1/voices/{$voiceId}/samples/{$sampleId}/audio", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: audio/mpeg');
        print $response->getBody()->getContents();
    }

    /****************
     * H I S T O R Y
     ****************/

    /**
     * Returns metadata about all your generated audio
     *
     * ✅
     *
     * GET https://api.elevenlabs.io/v1/history
     */
    public static function getHistory(string $startAfterHistoryItemId = null, int $pageSize = 100): void
    {
        $client = new Client();

        $params[] = $pageSize ? "page_size={$pageSize}" : '';
        $params[] = $startAfterHistoryItemId ? "start_after_history_item_id={$startAfterHistoryItemId}" : '';
        $params = implode('&', $params);

        $response = $client->request('GET', "https://api.elevenlabs.io/v1/history?{$params}", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Returns information about an history item by its ID
     *
     * ♾️
     *
     * GET https://api.elevenlabs.io/v1/history/{history_item_id}
     */
    public static function getHistoryItemById(string $historyItemId): void
    {
        $client = new Client();

        $response = $client->request('GET', "https://api.elevenlabs.io/v1/history/{$historyItemId}", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Deletes an history item by its ID
     *
     * ♾️
     *
     * DELETE https://api.elevenlabs.io/v1/history/{history_item_id}
     */
    public static function deleteHistoryItemById(string $historyItemId): void
    {
        $client = new Client();

        $response = $client->request('DELETE', "https://api.elevenlabs.io/v1/history/{$historyItemId}", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Returns the audio corresponding to a history item
     *
     * ♾️
     *
     * GET https://api.elevenlabs.io/v1/history/{history_item_id}/audio
     */
    public static function getAudioFromHistoryItemById(string $historyItemId): void
    {
        $client = new Client();

        $response = $client->request('GET', "https://api.elevenlabs.io/v1/history/{$historyItemId}/audio", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: audio/mpeg');
        print $response->getBody()->getContents();
    }

    /**
     * Downloads the audio corresponding to a history item
     *
     * ♾️
     *
     * POST https://api.elevenlabs.io/v1/history/download
     */
    public static function downloadHistoryItems(array $historyItemIds = [])
    {
        $client = new Client();

        $response = $client->request('POST', 'https://api.elevenlabs.io/v1/history/download', [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'history_item_ids' => $historyItemIds,
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /*****************
     * P R O J E C T S
     *****************/

    /**
     * Returns a list of your projects together and its metadata
     *
     * ♾️
     *
     * GET https://api.elevenlabs.io/v1/projects
     */
    public static function getProjects(): void
    {
        $client = new Client();

        $response = $client->request('GET', 'https://api.elevenlabs.io/v1/projects', [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Creates a new project, it can be either initialized as blank, from a document or from a URL
     *
     * ♾️
     *
     * POST https://api.elevenlabs.io/v1/projects/add
     */
    public static function addProject(
        string $name,
        string $defaultTitleVoiceId,
        string $defaultParagraphVoiceId,
        string $defaultModelId,
        string $fromUrl = null,
        string $fromDocument = null,
        string $qualityPreset = null,
        string $title = null,
        string $author = null,
        string $isbnNumber = null,
    ): void
    {
        $client = new Client();

        $response = $client->request('POST', 'https://api.elevenlabs.io/v1/projects/add', [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                'Content-Type' => 'multipart/form-data',
            ],
            'multipart' => [
                [
                    'name' => 'name',
                    'contents' => $name,
                ],
                [
                    'name' => 'default_title_voice_id',
                    'contents' => $defaultTitleVoiceId,
                ],
                [
                    'name' => 'default_paragraph_voice_id',
                    'contents' => $defaultParagraphVoiceId,
                ],
                [
                    'name' => 'default_model_id',
                    'contents' => $defaultModelId,
                ],
                [
                    'name' => 'from_url',
                    'contents' => $fromUrl,
                ],
                [
                    'name' => 'from_document',
                    'contents' => $fromDocument,
                ],
                [
                    'name' => 'quality_preset',
                    'contents' => $qualityPreset,
                ],
                [
                    'name' => 'title',
                    'contents' => $title,
                ],
                [
                    'name' => 'author',
                    'contents' => $author,
                ],
                [
                    'name' => 'isbn_number',
                    'contents' => $isbnNumber,
                ],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Returns information about a specific project
     *
     * ♾️
     *
     * GET https://api.elevenlabs.io/v1/projects/{project_id}
     */
    public static function getProject(string $projectId): void
    {
        $client = new Client();

        $response = $client->request('GET', "https://api.elevenlabs.io/v1/projects/{$projectId}", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Delete a project by its project_id
     *
     * ♾️
     *
     * DELETE https://api.elevenlabs.io/v1/projects/{project_id}
     */
    public static function deleteProject(string $projectId): void
    {
        $client = new Client();

        $response = $client->request('DELETE', "https://api.elevenlabs.io/v1/projects/{$projectId}", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Starts conversion of a project and all of its chapters
     *
     * ♾️
     *
     * POST https://api.elevenlabs.io/v1/projects/{project_id}/convert
     */
    public static function convertProject(string $projectId): void
    {
        $client = new Client();

        $response = $client->request('POST', "https://api.elevenlabs.io/v1/projects/{$projectId}/convert", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Gets the snapshots of a project
     *
     * GET https://api.elevenlabs.io/v1/projects/{project_id}/snapshots
     */
    public static function getProjectSnapshots(string $projectId): void
    {
        $client = new Client();

        $response = $client->request('GET', "https://api.elevenlabs.io/v1/projects/{$projectId}/snapshots", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Stream the audio from a project snapshot
     *
     * POST https://api.elevenlabs.io/v1/projects/{project_id}/snapshots/{project_snapshot_id}/stream
     */
    public static function streamProjectSnapshot(string $projectId, string $projectSnapshotId): void
    {
        $client = new Client();

        $response = $client->request('POST', "https://api.elevenlabs.io/v1/projects/{$projectId}/snapshots/{$projectSnapshotId}/stream", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Returns a list of your chapters for a project together and its metadata
     *
     * GET https://api.elevenlabs.io/v1/projects/{project_id}/chapters
     */
    public static function getChapters(string $projectId): void
    {
        $client = new Client();

        $response = $client->request('GET', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Returns information about a specific chapter
     *
     * GET https://api.elevenlabs.io/v1/projects/{project_id}/chapters/{chapter_id}
     */
    public static function getChapterById(string $projectId, string $chapterId): void
    {
        $client = new Client();

        $response = $client->request('GET', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters/{$chapterId}", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Delete a chapter by its chapter_id
     *
     * DELETE https://api.elevenlabs.io/v1/projects/{project_id}/chapters/{chapter_id}
     */
    public static function deleteChapterById(string $projectId, string $chapterId): void
    {
        $client = new Client();

        $response = $client->request('DELETE', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters/{$chapterId}", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Starts conversion of a specific chapter
     *
     * POST https://api.elevenlabs.io/v1/projects/{project_id}/chapters/{chapter_id}/convert
     */
    public static function convertChapter(string $projectId, string $chapterId): void
    {
        $client = new Client();

        $response = $client->request('POST', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters/{$chapterId}/convert", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Gets information about all the snapshots of a chapter, each snapshot corresponds can be downloaded as audio
     *
     * GET https://api.elevenlabs.io/v1/projects/{project_id}/chapters/{chapter_id}/snapshots
     */
    public static function getChapterSnapshots(string $projectId, string $chapterId): void
    {
        $client = new Client();

        $response = $client->request('GET', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters/{$chapterId}/snapshots", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**
     * Stream the audio from a chapter snapshot
     *
     * POST https://api.elevenlabs.io/v1/projects/{project_id}/chapters/{chapter_id}/snapshots/{chapter_snapshot_id}/stream
     */
    public static function streamChapterAudio(string $projectId, string $chapterId, string $chapterSnapshotId): void
    {
        $client = new Client();

        $response = $client->request('POST', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters/{$chapterId}/snapshots/{$chapterSnapshotId}/stream", [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
    }

    /**********
     * U S E R
     **********/

     /**
      * Gets extended information about the users subscription
      *
      * GET https://api.elevenlabs.io/v1/user/subscription
      */
     public static function getUserSubscription(): void
     {
         $client = new Client();

         $response = $client->request('GET', 'https://api.elevenlabs.io/v1/user/subscription', [
             'headers' => [
                 'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
             ],
         ]);

         header('Content-Type: application/json');
         print $response->getBody()->getContents();
     }

     /**
      * Gets information about the user
      *
      * GET https://api.elevenlabs.io/v1/user
      */
     public static function getUserInfo(): void
     {
        $client = new Client();

        $response = $client->request('GET', 'https://api.elevenlabs.io/v1/user', [
            'headers' => [
                'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
            ],
        ]);

        header('Content-Type: application/json');
        print $response->getBody()->getContents();
     }
}
