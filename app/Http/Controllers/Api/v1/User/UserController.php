<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function profile()
    {
        return response()->json([
            'status' => true,
            'message' => 'User profile Information.',
            'data' => auth()->user()
        ]);
    }

    public function logout()
    {
        // (auth()->user())->revoke();
        $token = auth()->user()->token();
        $token->revoke();

        return response()->json([
            'status' => true,
            'message' => 'User logged out.',
            'data' => []
        ]);
    }
}
