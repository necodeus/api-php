<?php

namespace Repositories\Common;

use Repositories\BaseRepositoryInterface;
use Repositories\BaseRepository;

use Enums\ImageTypeEnum;

use loophp\collection\Collection;

function uuidv4() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

class CommonImagesRepo extends BaseRepository implements BaseRepositoryInterface
{
    public function getAll(int $page = 1, int $limit = 10): Collection
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT *
            FROM c_images
            LIMIT $limit OFFSET $offset
        ";

        $result = $this->db->fetchAll($query);

        return Collection::fromIterable($result);
    }

    /** Uploads an image to FS, and inserts a record into the database\
     *
     * TODO: resolution_x, resolution_y -> dimension_x, dimension_y
     *
     * @exception \Exception
     */
    public function upload(string $filePath, ImageTypeEnum $type): array
    {
        $id = uuidv4();
        $localPath = "/uploads/{$id}";
        $remotePath = $id;

        $size = filesize($filePath);
        if ($size > 10_000_000) {
            throw new \Exception('Over 10MB file size limit');
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $filePath);
        finfo_close($finfo);
        if (strpos($mimeType, 'image') === false) {
            throw new \Exception('Only images are allowed');
        }

        $resolutionX = null;
        $resolutionY = null;
        if (strpos($mimeType, 'image') !== false) {
            $imageSize = getimagesize($filePath);
            $resolutionX = $imageSize[0];
            $resolutionY = $imageSize[1];
        }
        if ($resolutionX > 10_000 || $resolutionY > 10_000) {
            throw new \Exception('Over 10k resolution limit');
        }

        $moved = move_uploaded_file($filePath, __DIR__ . '/../../..' . $localPath);
        if (!$moved) {
            throw new \Exception('Failed to move uploaded file');
        }

        $this->db->insert('c_images', [
            'id' => $id,
            'type' => $type->value,
            'local_path' => $localPath,
            'remote_path' => $remotePath,
            'size' => $size,
            'mime_type' => $mimeType,
            'resolution_x' => $resolutionX,
            'resolution_y' => $resolutionY,
        ]);

        return [
            'id' => $id,
            'type' => $type,
            'local_path' => $localPath,
            'remote_path' => $remotePath,
            'size' => $size,
            'mime_type' => $mimeType,
            'resolution_x' => $resolutionX,
            'resolution_y' => $resolutionY,
        ];
    }

    public function count(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM c_images
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}
