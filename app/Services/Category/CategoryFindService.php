<?php

namespace App\Services\Category;

use App\Models\Category;

class CategoryFindService
{
    public const DESCRIPTION_FIELD = 'description';

    public function findByDescription(string $categoryDescription): Category
    {
        return Category::where(self::DESCRIPTION_FIELD, $categoryDescription)
            ->first();
    }
}
