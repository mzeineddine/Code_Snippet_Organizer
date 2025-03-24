<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Snippet;
use App\Models\User;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class FavoriteController extends Controller
{
    //
    function getFavorites(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $user_id = $user->id;
        if(!$user_id){
            return response()->json([
                "success" => "true",
                "error" => "Missing Params"
            ]);
        }
        $favorites = Favorite::where("user_id", $user_id)->get();
        if(!$favorites){
            return response()->json([
                "success" => "false",
                "error" => "No favorites"
            ]);
        }
        return response()->json([
            "success" => "true",
            "favorites" => $favorites
        ]);
    }

    function getFavoriteSnippets(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $user_id = $user->id;
        if(!$user_id){
            return response()->json([
                "success" => "true",
                "error" => "Missing Params"
            ]);
        }
        $favorites = Favorite::where("user_id", $user_id)->get();
        if(!$favorites){
            return response()->json([
                "success" => "false",
                "error" => "No favorites"
            ]);
        }
        $snippets= [];
        foreach ($favorites as $favorite) {
            $snippet = Snippet::with("tags")->find($favorite->snippet_id);
            $snippets[] = $snippet;
        }
        return response()->json([
            "success" => "true",
            "snippets" => $snippets
        ]);
    }

    function addFavorite(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $user_id = $user->id;
        $snippet_id = $request["snippet_id"];
        if(!($user_id && $snippet_id)){
            return response()->json([
                "success" => "false",
                "error" => "Missing Params"
            ]);
        }
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
            "success" => true,
            "favorite" => $favorite
        ]);
    }

    function deleteFavorite(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $user_id = $user->id;
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
            "favorite" => $favorite
        ]);
    }
}
