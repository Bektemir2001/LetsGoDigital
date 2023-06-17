<?php

namespace App\Http\Controllers\API;

use App\Models\User;

class UserController
{
    public function get(User $user)
    {
        return response(['data' => $user]);
    }
}
