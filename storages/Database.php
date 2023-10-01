<?php 

namespace Storage;

class Database
{
    private $db;

    public function __construct(string $ip, string $port, string $user, string $password, string $database)
    {
        $this->db = new \PDO("mysql:host={$ip}:{$port};dbname={$database}", $user, $password);
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
}
