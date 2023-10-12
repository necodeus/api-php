<?php 

namespace Repositories\Common;

use Services\Database;

class CommonPagesRepo
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

    public function getPages(): array
    {
        $query = "SELECT *
            FROM c_pages
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function getPageBySlug(string $slug): array
    {
        $query = "SELECT *
            FROM c_pages
            WHERE
                slug = :slug
        ";

        $result = $this->db->fetch($query, ['slug' => $slug]);

        return $result;
    }
}