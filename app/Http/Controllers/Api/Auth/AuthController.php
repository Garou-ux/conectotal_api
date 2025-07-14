<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\Loginrequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;


use App\Models\User;

class AuthController extends Controller
{
    /*Login method*/

    public function login(Loginrequest $request){
        $token = auth()->attempt($request->validated());
        if( $token ){
            return $this->responseWithToken($token, auth()->user());
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid Credentials',
                'isLoggedIn' => false
            ], 422);
        }
    }

    /**
     * Registration method
     */
    public function register(RegistrationRequest $request){
        $user = User::create($request->validated());

        if( $user ){
            $token = auth()->login($user);
            return $this->responseWithToken($token, $user);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'An error ocurre while trying to create user',
                'isLoggedIn' => false
            ], 500);
        }
    }

    /**
     * return jwt access token
     */
    public function responseWithToken($token, $user){
        return response([
            'status' => 'success',
            'user' => $user,
            'access_token' => $token,
            'type' => 'bearer',
            'isLoggedIn' => true
        ]);
    }

    /**
     * logout the user
     */
    public function logout(){
        if (Auth::check()) {
            Auth::logout();
            return response()->json(['message' => 'Logged out successfully.']);
        }

        return response()->json(['message' => 'No user is logged in.'], 400);
    }

        /**
     * Refresh token
     */
public function refresh()
{
    try {
        $newToken = JWTAuth::parseToken()->refresh();
        $user = JWTAuth::setToken($newToken)->toUser(); // para obtener el user actualizado

        return $this->responseWithToken($newToken, $user);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'failed',
            'message' => 'Token refresh failed'
        ], 401);
    }
}

}
