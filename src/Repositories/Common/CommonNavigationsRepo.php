<?php 

namespace Repositories\Common;

use Services\Database;

class CommonNavigationsRepo
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

    public function getNavigations(): array
    {
        $query = "SELECT *
            FROM c_navigations
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }
}