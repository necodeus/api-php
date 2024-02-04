<?php

namespace Services;

use GuzzleHttp\Client;
use Libraries\File;
use Throwable;

class ElevenLabsApiService
{
    /**
     * Converts text into speech using a voice of your choice and returns audio
     *
     * POST https://api.elevenlabs.io/v1/text-to-speech/kIZ5Hw3uqBbzuhBs855A
     */
    public static function textToSpeech(string $text, array $settings = []): ?array
    {
        try {
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

            $contents = $response->getBody()->getContents();

            $file = new File('/uploads/tests', 'audio.mp3');
            $file->save($contents);

            $contentType = 'audio/mpeg';
            $path = '/uploads/tests/audio.mp3';

            return [
                'path' => $path,
                'contentType' => $contentType,
            ];
        } catch (Throwable $e) {
            log_to_file($e->getMessage(), \Enums\LogLevel::EXCEPTION);

            return null;
        }
    }

    /**
     * Gets a list of available models
     *
     * GET https://api.elevenlabs.io/v1/models
     */
    public static function getModels(): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', 'https://api.elevenlabs.io/v1/models', [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            log_to_file($e->getMessage(), \Enums\LogLevel::EXCEPTION);

            return null;
        }
    }

    /**
     * Gets a list of all available voices for a user
     *
     * GET https://api.elevenlabs.io/v1/voices
     */
    public static function getVoices(): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', 'https://api.elevenlabs.io/v1/voices', [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            log_to_file($e->getMessage(), \Enums\LogLevel::EXCEPTION);

            return null;
        }
    }

    /**
     * Gets the default settings for voices
     *
     * GET https://api.elevenlabs.io/v1/voices/settings/default
     */
    public static function getDefaultVoiceSettings(): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', 'https://api.elevenlabs.io/v1/voices/settings/default', [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Returns the settings for a specific voice
     *
     * GET https://api.elevenlabs.io/v1/voices/{voice_id}/settings
     */
    public static function getVoiceSettings(string $voiceId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.elevenlabs.io/v1/voices/{$voiceId}/settings", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Returns metadata about a specific voice
     *
     * GET https://api.elevenlabs.io/v1/voices/{voice_id}
     */
    public static function getVoice(string $voiceId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.elevenlabs.io/v1/voices/{$voiceId}", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Deletes a voice by its ID
     *
     * DELETE https://api.elevenlabs.io/v1/voices/{voice_id}
     */
    public static function deleteVoice(string $voiceId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('DELETE', "https://api.elevenlabs.io/v1/voices/{$voiceId}", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Edit your settings for a specific voice
     *
     * PATCH https://api.elevenlabs.io/v1/voices/{voice_id}/settings/edit
     */
    public static function editVoiceSettings(string $voiceId, array $settings): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('PATCH', "https://api.elevenlabs.io/v1/voices/{$voiceId}/settings/edit", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                    'Content-Type' => 'application/json',
                ],
                'json' => $settings,
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Add a new voice to your collection of voices in VoiceLab
     *
     * POST https://api.elevenlabs.io/v1/voices/add
     */
    public static function addVoice(string $name, array $files, $description = null, $labels = null): ?array
    {
        try {
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

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Edit a voice created by you
     *
     * POST https://api.elevenlabs.io/v1/voices/{voice_id}/edit
     */
    public static function editVoice(string $voiceId, string $name, array $files = [], $description = null, $labels = null): ?array
    {
        try {
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

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Removes a sample by its ID
     *
     * DELETE https://api.elevenlabs.io/v1/voices/{voice_id}/samples/{sample_id}
     */
    public static function deleteSample(string $voiceId, string $sampleId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('DELETE', "https://api.elevenlabs.io/v1/voices/{$voiceId}/samples/{$sampleId}", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Returns the audio corresponding to a sample attached to a voice
     *
     * GET https://api.elevenlabs.io/v1/voices/{voice_id}/samples/{sample_id}/audio
     */
    public static function getSample(string $voiceId, string $sampleId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.elevenlabs.io/v1/voices/{$voiceId}/samples/{$sampleId}/audio", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            $file = new File('/uploads/tests', 'audio.mp3');

            $file->save($contents);

            return [
                'path' => '/uploads/tests/audio.mp3',
                'contentType' => 'audio/mpeg',
            ];
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Returns metadata about all your generated audio
     *
     * GET https://api.elevenlabs.io/v1/history
     */
    public static function getHistory(string $startAfterHistoryItemId = null, int $pageSize = 100): ?array
    {
        try {
            $client = new Client();

            $params[] = $pageSize ? "page_size={$pageSize}" : '';
            $params[] = $startAfterHistoryItemId ? "start_after_history_item_id={$startAfterHistoryItemId}" : '';
            $params = implode('&', $params);

            $response = $client->request('GET', "https://api.elevenlabs.io/v1/history?{$params}", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Returns information about an history item by its ID
     *
     * GET https://api.elevenlabs.io/v1/history/{history_item_id}
     */
    public static function getHistoryItemById(string $historyItemId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.elevenlabs.io/v1/history/{$historyItemId}", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Deletes an history item by its ID
     *
     * DELETE https://api.elevenlabs.io/v1/history/{history_item_id}
     */
    public static function deleteHistoryItemById(string $historyItemId): ?array
    {
        try {

            $client = new Client();

            $response = $client->request('DELETE', "https://api.elevenlabs.io/v1/history/{$historyItemId}", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Returns the audio corresponding to a history item
     *
     * GET https://api.elevenlabs.io/v1/history/{history_item_id}/audio
     */
    public static function getAudioFromHistoryItemById(string $historyItemId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.elevenlabs.io/v1/history/{$historyItemId}/audio", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            $file = new File('/uploads/tests', 'audio.mp3');

            $file->save($contents);

            return [
                'path' => '/uploads/tests/audio.mp3',
                'contentType' => 'audio/mpeg',
            ];
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Downloads the audio corresponding to a history item
     *
     * POST https://api.elevenlabs.io/v1/history/download
     */
    public static function downloadHistoryItems(array $historyItemIds = []): ?array
    {
        try {
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

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Returns a list of your projects together and its metadata
     *
     * GET https://api.elevenlabs.io/v1/projects
     */
    public static function getProjects(): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', 'https://api.elevenlabs.io/v1/projects', [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Creates a new project, it can be either initialized as blank, from a document or from a URL
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
    ): ?array {
        try {
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

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Returns information about a specific project
     *
     * GET https://api.elevenlabs.io/v1/projects/{project_id}
     */
    public static function getProject(string $projectId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.elevenlabs.io/v1/projects/{$projectId}", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Delete a project by its project_id
     *
     * DELETE https://api.elevenlabs.io/v1/projects/{project_id}
     */
    public static function deleteProject(string $projectId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('DELETE', "https://api.elevenlabs.io/v1/projects/{$projectId}", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Starts conversion of a project and all of its chapters
     *
     * POST https://api.elevenlabs.io/v1/projects/{project_id}/convert
     */
    public static function convertProject(string $projectId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('POST', "https://api.elevenlabs.io/v1/projects/{$projectId}/convert", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Gets the snapshots of a project
     *
     * GET https://api.elevenlabs.io/v1/projects/{project_id}/snapshots
     */
    public static function getProjectSnapshots(string $projectId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.elevenlabs.io/v1/projects/{$projectId}/snapshots", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Stream the audio from a project snapshot
     *
     * POST https://api.elevenlabs.io/v1/projects/{project_id}/snapshots/{project_snapshot_id}/stream
     */
    public static function streamProjectSnapshot(string $projectId, string $projectSnapshotId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('POST', "https://api.elevenlabs.io/v1/projects/{$projectId}/snapshots/{$projectSnapshotId}/stream", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Returns a list of your chapters for a project together and its metadata
     *
     * GET https://api.elevenlabs.io/v1/projects/{project_id}/chapters
     */
    public static function getChapters(string $projectId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Returns information about a specific chapter
     *
     * GET https://api.elevenlabs.io/v1/projects/{project_id}/chapters/{chapter_id}
     */
    public static function getChapterById(string $projectId, string $chapterId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters/{$chapterId}", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Delete a chapter by its chapter_id
     *
     * DELETE https://api.elevenlabs.io/v1/projects/{project_id}/chapters/{chapter_id}
     */
    public static function deleteChapterById(string $projectId, string $chapterId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('DELETE', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters/{$chapterId}", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Starts conversion of a specific chapter
     *
     * POST https://api.elevenlabs.io/v1/projects/{project_id}/chapters/{chapter_id}/convert
     */
    public static function convertChapter(string $projectId, string $chapterId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('POST', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters/{$chapterId}/convert", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Gets information about all the snapshots of a chapter, each snapshot corresponds can be downloaded as audio
     *
     * GET https://api.elevenlabs.io/v1/projects/{project_id}/chapters/{chapter_id}/snapshots
     */
    public static function getChapterSnapshots(string $projectId, string $chapterId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters/{$chapterId}/snapshots", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Stream the audio from a chapter snapshot
     *
     * POST https://api.elevenlabs.io/v1/projects/{project_id}/chapters/{chapter_id}/snapshots/{chapter_snapshot_id}/stream
     */
    public static function streamChapterAudio(string $projectId, string $chapterId, string $chapterSnapshotId): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('POST', "https://api.elevenlabs.io/v1/projects/{$projectId}/chapters/{$chapterId}/snapshots/{$chapterSnapshotId}/stream", [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Gets extended information about the users subscription
     *
     * GET https://api.elevenlabs.io/v1/user/subscription
     */
    public static function getUserSubscription(): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', 'https://api.elevenlabs.io/v1/user/subscription', [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Gets information about the user
     *
     * GET https://api.elevenlabs.io/v1/user
     */
    public static function getUserInfo(): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', 'https://api.elevenlabs.io/v1/user', [
                'headers' => [
                    'xi-api-key' => $_ENV['ELEVENLABS_API_TOKEN'],
                ],
            ]);

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (Throwable $e) {
            return null;
        }
    }
}
