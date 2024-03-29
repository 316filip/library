<?php

namespace App\Helpers;

use App\Models\User;

class UserHelper {
    /**
     * Find user by code
     * 
     * @return object
     */ 
    public static function find($user)
    {
        if ($user === "") {
            $user = auth()->user();
        } else {
            $user = User::where('code', $user)->first();

            if ($user === null || !auth()->user()->librarian) {
                abort(404);
            }
        }

        return $user;
    }
}
