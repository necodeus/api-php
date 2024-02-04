<?php

namespace Repositories;
use Enums\ImageTypeEnum;

class CommonRepository extends BaseRepository
{
    public function uploadImage(string $name, ImageTypeEnum $path): bool
    {
        return false;
    }

    public function getPageBySlug(string $slug): array
    {
        $query = "SELECT *
            FROM c_pages
            WHERE
                slug = :slug
        ";

        return $this->db->fetch($query, [
            'slug' => $slug,
        ]);
    }

    public function getRedirectionById(string $id): array
    {
        return [];
    }
}
