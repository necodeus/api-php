<?php

namespace Repositories;

use loophp\collection\Collection;

interface BaseRepositoryInterface
{
    public function getAll(int $page = 1, int $limit = 10): Collection;
    public function count(): int;
}
