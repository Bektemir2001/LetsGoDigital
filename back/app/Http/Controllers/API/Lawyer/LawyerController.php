<?php

namespace App\Http\Controllers\API\Lawyer;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LawyerController
{
    public function store(Request $request, User $user)
    {
        $photo = Storage::disk('public')->put('images', $request->file('certificate'));

        $user->update([
            'role' => 'ROLE_LAWYER',
            'certificate' => $photo
        ]);

        return response(['data' => $user]);
    }
}
