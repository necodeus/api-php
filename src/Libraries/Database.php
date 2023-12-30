<?php

namespace Libraries;

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

    /**
     * Executes a query and returns the statement
     */
    protected function query($query, $params = []): \PDOStatement
    {
        $statement = $this->db->prepare($query);

        foreach ($params as $key => $value) {
            $statement->bindValue($key, $value);
        }

        $statement->execute();

        return $statement;
    }

    public function fetchColumn(string $query, array $params = []): array
    {
        return $this->query($query, $params)->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function fetchAll(string $query, array $params = []): array
    {
        return $this->query($query, $params)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetch(string $query, array $params = []): array
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

    public function update(string $table, array $data, array $where): int
    {
        $columns = array_keys($data);
        $whereColumns = array_keys($where);

        $query = "UPDATE {$table} SET " . implode(', ', array_map(function($col) { return "$col = :$col"; }, $columns)) . " WHERE " . implode(' AND ', array_map(function($col) { return "$col = :$col"; }, $whereColumns));

        $params = array_merge(array_combine($columns, array_values($data)), array_combine($whereColumns, array_values($where)));

        $statement = $this->query($query, $params);

        return $statement->rowCount();
    }
}
