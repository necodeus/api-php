<?php

namespace Commands;

use Services\Database;
use Services\File;

class GetSchemaCommand extends \BaseCommand
{
    protected $name = 'get-schema';

    protected $description = 'Get schema of the database';

    protected Database $db;

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

    public function handle($arguments): void
    {
        $createStatements = $this->getAllTablesCreateStatements();

        (new File('./', 'schema.sql'))->save($createStatements);
    }

    protected function getTablesList(): array
    {
        return $this->db->fetchColumn("SHOW TABLES;");
    }

    protected function getCreateStatement(string $tableName): string
    {
        $result = $this->db->fetchAll("SHOW CREATE TABLE $tableName");

        return $result[0]['Create Table'] ?? '';
    }

    protected function getAllTablesCreateStatements(): string
    {
        $data = '';

        $tables = $this->getTablesList();

        foreach ($tables as $table) {
            $data .= $this->getCreateStatement($table) . "\n\n";
        }

        return $data;
    }
}
