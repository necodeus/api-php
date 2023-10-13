<?php 

namespace Repositories\Shop;

use Repositories\BaseRepository;

class ShopReviewsRepo extends BaseRepository
{
    public function getReviews(): array
    {
        $query = "SELECT *
            FROM s_reviews
        ";

        $result = $this->db->fetchAll($query);

        return $result;
    }

    public function countReviews(): int
    {
        $query = "SELECT
                COUNT(*) as count
            FROM s_reviews
        ";

        $result = $this->db->fetch($query);

        return $result['count'];
    }
}