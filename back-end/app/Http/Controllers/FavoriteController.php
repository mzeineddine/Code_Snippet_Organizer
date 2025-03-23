<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Snippet;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    function getFavorites(Request $request){
        $user_id = $request["user_id"];
        if(!$user_id){
            return response()->json([
                "success" => "false",
                "error" => "No favorites"
            ]);
        }
        $favorites = Favorite::where("user_id", $user_id)->get();
        if(!$favorites){
            return response()->json([
                "success" => "true",
                "error" => "Missing Params"
            ]);
        }
        return response()->json([
            "success" => "true",
            "favorites" => $favorites
        ]);
    }
    function addFavorite(Request $request){
        $user_id = $request["user_id"];
        $snippet_id = $request["snippet_id"];

        if(!($user_id && $snippet_id)){
            return response()->json([
                "success" => "false",
                "error" => "Missing Params"
            ]);
        }
        $user = User::find($user_id);
        if(!$user){
            return response()->json([
                "success" => "false",
                "error" => "Invalid user"
            ]);
        }

        $snippet = Snippet::find($snippet_id);
        if(!$snippet){
            return response()->json([
                "success" => "false",
                "error" => "Invalid snippets"
            ]);
        }

        $favorite = Favorite::where('user_id',$user_id)->where("snippet_id", $snippet_id)->first();
        if($favorite){
            return response()->json([
                "success" => "false",
                "error" => "Already in favorites"
            ]);
        }
        $favorite = new Favorite();
        $favorite->snippet_id = $snippet_id;
        $favorite->user_id = $user_id;
        $favorite->save();
        return response()->json([
            "success" => "false",
            "favorite" => $favorite
        ]);
    }

    function deleteFavorite(Request $request){
        $user_id = $request["user_id"];
        $snippet_id = $request["snippet_id"];
        if(!($user_id && $snippet_id)){
            return response()->json([
                "success" => "false",
                "error" => "Missing Params"
            ]);
        }

        $favorite = Favorite::where('user_id',$user_id)->where("snippet_id", $snippet_id)->first();
        if(!$favorite){
            return response()->json([
                "success" => "false",
                "error" => "favorite not found"
            ]);
        }

        $favorite->delete();
        return response()->json([
            "success" => "true",
            "snippet" => $favorite
        ]);
    }
}
