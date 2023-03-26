<?php

namespace App\Helpers;

use App\Models\Work;

class WorkHelper
{
    /**
     * Find work by slug
     * 
     * @return object
     */ 
    public static function find($work)
    {
        $work = Work::where('slug', $work)->first();
        if ($work == null) {
            abort(404);
        }

        return $work;
    }
}
