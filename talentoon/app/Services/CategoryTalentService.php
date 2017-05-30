<?php

namespace App\Services;

use App\Models\CategoryTalent;
use App\Http\Requests;
use DB;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class CategoryTalentService
{

    public function beTalent(\App\Models\User $user, $categoryId, $fromWhen, $desc){
        return CategoryTalent::create([
                'talent_id'=>$user->id,
                'category_id'=> $categoryId,
                'from_when'=>$fromWhen,
                'description'=>$desc
                ]); 
    }

    public function mentorApprove($request){

        $category=$request['category_id'];
        $mentor=$request['talent_id'];

        DB::table('category_talents')->where('category_id', $category)
            ->where('talent_id', $mentor)
            ->update(['status' => 1]);

        return response()->json(["msg" => "done"]);

    }

}
