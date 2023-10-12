<?php 

namespace Repositories\Common;

use Services\Database;

class CommonRedirectionsRepo
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

    public function getRedirections(): array
    {
        $query = "SELECT *
            FROM c_redirections
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function getRedirectionById(string $id): array
    {
        $query = "SELECT *
            FROM c_redirections
            WHERE
                id = :id
        ";

        $result = $this->db->fetch($query, ['id' => $id]);

        return $result;
    }
}