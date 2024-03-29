<?php

namespace Libraries;

use Predis\Client as RedisClient;
use Libraries\Database;

class RedisQueue
{
    protected RedisClient $redis;

    protected string $queueKey;

    protected Database $db;

    public function __construct(string $queueKey = 'sql_queue')
    {
        $this->db = new Database(
            $_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_PORT'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD'],
            $_ENV['DATABASE_NAME'],
        );

        $this->redis = new RedisClient([
            'scheme' => $_ENV['REDIS_SCHEME'], // tcp
            'host' =>  $_ENV['REDIS_HOST'], // use "redis" if developing with Docker
            'port' => $_ENV['REDIS_PORT'] // 6379
        ]);

        $this->queueKey = $queueKey;
    }

    public function addToQueue(string $query): void
    {
        log_to_file("addToQueue({$query})", \Enums\LogLevel::INFO);

        $this->redis->rpush($this->queueKey, [serialize($query)]);
    }

    public function processQueue(): void
    {
        while ($serializedQuery = $this->redis->lpop($this->queueKey)) {
            try {
                log_to_file("processQueue($serializedQuery)", \Enums\LogLevel::INFO);

                $query = unserialize($serializedQuery);
                $this->db->exec($query);
            } catch (\Exception $e) {
                $message = $e->getMessage();

                log_to_file($message, \Enums\LogLevel::EXCEPTION);

                continue;
            }
        }
    }
}