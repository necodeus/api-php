<?php 

namespace Repositories\Common;

use Services\Database;

class CommonSettingGroupsRepo
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
    
    public function getSettingGroups(): array
    {
        $query = "SELECT *
            FROM c_setting_groups
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countSettingGroups(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM c_setting_groups
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}