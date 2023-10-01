<?php

namespace PaperApi\Posts;

use Storage\Database;

use loophp\collection\Collection;

class Repository
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

    public function getPosts(): Collection
    {
        $prefix = 'http://images.localhost/';

        $query = "SELECT
                *,
                CONCAT(:prefix, main_image_id) AS main_image_url
            FROM b_posts
        ";

        $result = $this->db->fetchAll($query, ['prefix' => $prefix]);

        return Collection::fromIterable($result);
    }

    public function getPostById(string $id): array
    {
        $prefix = 'http://images.localhost/';

        $query = "SELECT
                *,
                CONCAT(:prefix, main_image_id) AS main_image_url
            FROM b_posts
            WHERE   
                id = :id
        ";

        $result = $this->db->fetch($query, ['prefix' => $prefix, 'id' => $id]);

        return $result;
    }
}