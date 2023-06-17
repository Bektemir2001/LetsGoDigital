<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $data = $request->validate([
            'inn' => '',
            'password' => ''
        ]);

        $user = User::where('inn', $data['inn'])->first();
        return response($user);

    }
}
