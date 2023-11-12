<?php

namespace Services;

class Database
{
    private $db;

    public function __construct(string $ip, string $port, string $user, string $password, string $database)
    {
        $this->db = new \PDO(
            "mysql:host={$ip}:{$port};dbname={$database}",
            $user,
            $password,
            [
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            ]
        );
    }

    protected function query($query, $params = []): \PDOStatement
    {
        $statement = $this->db->prepare($query);

        foreach ($params as $key => $value) {
            $statement->bindValue($key, $value);
        }

        $statement->execute();

        return $statement;
    }

    public function fetchAll($query, $params = []): array
    {
        return $this->query($query, $params)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetch($query, $params = []): array
    {
        return $this->query($query, $params)->fetch(\PDO::FETCH_ASSOC) ?: [];
    }

    public function insert(string $table, array $data): int
    {
        $columns = array_keys($data);
        $values = array_values($data);

        $query = "INSERT INTO {$table} (" . implode(', ', $columns) . ") VALUES (:" . implode(', :', $columns) . ")";

        $this->query($query, array_combine($columns, $values));

        return $this->db->lastInsertId();
    }

    public function upsert(string $table, array $data): int
    {
        $columns = array_keys($data);
        $placeholders = array_map(function($col) { return ":$col"; }, $columns);

        $updateClauses = array_map(function($col) { return "$col = VALUES($col)"; }, $columns);

        $query = "INSERT INTO {$table} (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ") ON DUPLICATE KEY UPDATE " . implode(', ', $updateClauses);

        $params = array_combine($placeholders, array_values($data));

        $statement = $this->query($query, $params);

        return $statement->rowCount() > 0 ? $this->db->lastInsertId() : 0;
    }
}
