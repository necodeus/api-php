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
}