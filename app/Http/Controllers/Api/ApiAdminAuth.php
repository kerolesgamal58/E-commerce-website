<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWTGuard;

class ApiAdminAuth extends Controller
{
    public function login(Request $request){
        // validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //extract email and password and remember me
        $credentials = $request->only(['email', 'password']);

        //Auth
        $token = Auth::guard('admin_api')->attempt($credentials);
        if ( ! $token ){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
//        return response()->json([
//            'status' => true,
//            'access_token' => $token
//        ]);
        return $this->respondWithToken($token);
    }

    public function logout(){
        Auth::guard('admin_api')->logout();
        return response()->json(['status' => true, 'message' => 'Logout Successfully']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin_api')->factory()->getTTL() * 60
        ]);
    }
}
