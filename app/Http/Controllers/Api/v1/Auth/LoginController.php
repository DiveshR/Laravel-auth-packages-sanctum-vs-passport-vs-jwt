<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        // return $request->all();
        $user = User::where('email',$request->email)->first();

        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid email address.',
                'data' => []
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid password.',
                'data' => []
            ]);
        }

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'token' => $token,
            'data' => []
        ]);
    }
}
