<?php

namespace PaperApi\Posts;

use Storage\Database;

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

    public function getPosts(): array
    {
        $posts = $this->getContents();
        $links = $this->getLinksByContentIds(array_column($posts, 'id'));

        foreach ($posts as &$post) {
            foreach ($links as $link) {
                if ($link['content_id'] === $post['id']) {
                    $post['link'] = $link;
                    break;
                }
            }
        }

        return $posts;
    }

    public function getContents(): array
    {
        $contents = $this->db->fetchAll("SELECT * FROM nc_contents");

        foreach ($contents as &$value) {
            $value['main_image_url'] = 'http://images.localhost/' . $value['image_id_main'];
        }

        return $contents;
    }

    public function getLinksByContentIds(array $ids): array
    {
        $ids = array_map(function ($id) {
            return "'{$id}'";
        }, $ids);

        return $this->db->fetchAll("SELECT * FROM nc_links WHERE content_id IN (" . implode(', ', $ids) . ")");
    }
}