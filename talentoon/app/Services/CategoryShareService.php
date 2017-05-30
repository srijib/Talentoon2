<?php
namespace App\Services;
use App\Models\Share;
use Illuminate\Http\Request;
use DB;

class CategoryShareService
{

    public static function share ($request){


    $share=Share::create($request->all());

    return response()->json(['message' => 'Share successfully']);


    }
}
