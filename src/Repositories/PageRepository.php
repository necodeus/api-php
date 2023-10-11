<?php 

namespace Repositories;

use Services\Database;

use loophp\collection\Collection;

class PageRepository
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database(
            $_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_PORT'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD'],
            $_ENV['DATABASE_NAME'],
        );
    }

    public function getPageBySlug(string $slug): array
    {
        $query = "SELECT *
            FROM c_pages
            WHERE
                http_req_uri = :slug
        ";

        $result = $this->db->fetch($query, ['slug' => $slug]);

        return $result;
    }

    // public function getPagesByPostIds(array $ids): Collection
    // {
    //     $ids = array_map(fn($id) => "'{$id}'", $ids);
    //     $queryIds = implode(', ', $ids);

    //     $query = "SELECT *
    //         FROM c_pages
    //         WHERE
    //             content_id IN ($queryIds)
    //     ";

    //     $result = $this->db->fetchAll($query);

    //     return Collection::fromIterable($result);
    // }
}