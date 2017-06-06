<?php

namespace App\Services;

use App\Models\CategoryTalent;
use App\Http\Requests;
use DB;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


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

    public static function untalent ($request){
            $is_talent=DB::table('category_talents')->where([['talent_id',$request->talent_id],['category_id',$request->category_id]])->update(['status' => 0]);
            return response()->json(['status' => 200,
                                'message' => 'unTalent successfully']);

        }

}
