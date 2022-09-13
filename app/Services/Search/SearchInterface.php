<?php

namespace App\Services\Search;

interface SearchInterface
{
    public function search(?string $value, int $limit = 5);
}
