<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    function login(Request $request){
        $credentials = [
            "email" => $request["email"],
            "password"=> $request["password"]
        ];


        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                "success" => false,
                "error" => "Unauthorized"
            ], status: 401);
        }

        $user = Auth::user();
        $user->token = $token;

        return response()->json([
            "success" => true,
            "user" => $user
        ]);
    }

    function signup(Request $request){
        $user = new User();

        $user = User::where('email',$request["email"])->first();
        if($user){
            return response()->json([
                "success" => "false",
                "error" => "Email Already used"
            ]);
        }

        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = bcrypt($request["password"]);
        $user->save();

        return response()->json([
            "success" => true
        ]);
    }

    function validate_token (Request $request) {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return response()->json(['success' => true, 'user' => $user], 200);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'message' => 'Token is invalid'], 401);
        }
    }

}
