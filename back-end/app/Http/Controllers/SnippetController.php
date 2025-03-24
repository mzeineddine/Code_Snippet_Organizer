<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use App\Models\Tag;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class SnippetController extends Controller
{
    //
    function getSnippet(Request $request){
        $snippets = Snippet::all();
        return response()->json([
            "success" => "true",
            "snippets" => $snippets,
        ]);
    }
    function addOrUpdateSnippet(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        if(!$request["id"]){
            $snippet = new Snippet();
            $snippet_tags = null;
        }else{
            $snippet = Snippet::find($request["id"]);
            $snippet_tags = $snippet->tags;
            if(!$snippet){
                return response()->json([
                    "success" => "false",
                    "error" => "snippet not found"
                ]);
            }
        }

        $snippet->user_id = $user->id;
        $snippet->title = $request["title"] ? $request["title"] : $snippet->title;
        $snippet->content = $request["content"] ? $request["content"] : $snippet->content;
        $snippet->language = $request["language"] ? $request["language"] : $snippet->language;
        $snippet->save();

        $id = $snippet->id;

        $tags = explode(" ", $request["tags"]);
        if($snippet_tags){
            foreach($snippet_tags as $snippet_tag){
                $snippet_tag->delete();
            }
        }
        foreach($tags as $tag){
            if(!($tag == " " || $tag == "")){
                TagController::addTag($tag, $snippet->id);
            }
        }

        $snippet = Snippet::with("tags")->find($id);

        return response()->json([
            "success" => "true",
            "snippet" => $snippet
        ]);
    }

    function getMySnippet(){
        $user = JWTAuth::parseToken()->authenticate();

        $snippets = Snippet::where("user_id", $user->id)->get();
        return response()->json([
            "success" => "true",
            "snippets" => $snippets,
        ]);
    }


    function deleteSnippet(Request $request){
        if(!$request["id"]){
            return response()->json([
                "success" => "false",
                "error" => "no id passes"
            ]);
        }else{
            $snippet = Snippet::find($request["id"]);
            if(!$snippet){
                return response()->json([
                    "success" => "false",
                    "error" => "snippet not found"
                ]);
            }
        }

        $snippet->delete();
        return response()->json([
            "success" => "true",
            "snippet" => $snippet
        ]);
    }
}
