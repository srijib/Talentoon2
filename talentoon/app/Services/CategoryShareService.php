<?php
namespace App\Services;
use App\Models\Share;
use Illuminate\Http\Request;
use DB;

class CategoryShareService
{

    public static function share ($request,$user_id){


    $share=Share::create(['post_id'=>$request->post_id,'user_id'=>$user_id]);

    return response()->json(['message' => 'Share successfully']);


    }
}
