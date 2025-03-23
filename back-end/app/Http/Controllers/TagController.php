<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    static function addTag($t,$snippet_id){
        $tag = new Tag();
        $tag->snippet_id = $snippet_id;
        $tag->tag = $t;
        $tag->save();

        return response()->json([
            "success" => "true",
            "tag" => $tag
        ]);
    }

    function deleteTag($id){
        if(!$id){
            return response()->json([
                "success" => "false",
                "error" => "no id passes"
            ]);
        }else{
            $tag = Tag::find($id);
            if(!$tag){
                return response()->json([
                    "success" => "false",
                    "error" => "snippet not found"
                ]);
            }
        }

        $tag->delete();
        return response()->json([
            "success" => "true",
            "tag" => $tag
        ]);
    }
}
