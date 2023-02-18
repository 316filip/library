<?php

namespace App\Helpers;

use App\Models\Author;

class AuthorHelper
{
    public static function find($author)
    {
        $author = Author::where('slug', $author)->first();
        if ($author == null) {
            abort(404);
        }

        return $author;
    }
}
