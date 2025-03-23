<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function getUsers(){
        dd("in get user");
        $users = User::all();
        // $users = User::paginate(10,["*"],'page',2);
        return response()->json([
            "success" => "true",
            "users" => $users,
        ]);
    }
}
