<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function register(Request $request): Response
    {
        try {
            $data = $request->validate([
                'name' => '',
                'email' => '',
                'inn' => '',
                'password' => ''
            ]);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'inn' => $data['inn'],
            ]);
            $user = User::where('id', $user->id)->get();
            return response($user);
        }
        catch (\Exception $e){
            return response(['error' => $e->getMessage()])->setStatusCode(500);
        }

    }
}
