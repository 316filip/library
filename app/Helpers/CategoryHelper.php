<?php

namespace App\Helpers;

use App\Models\Category;

class CategoryHelper
{
    public static function find($category)
    {
        $category = Category::where('slug', $category)->first();
        if ($category == null) {
            abort(404);
        }

        return $category;
    }
}
