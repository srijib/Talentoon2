<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryMentorService;
use Illuminate\Support\Facades\Auth;
use DB;
use JWTAuth;
class CategoryMentorController extends Controller
{
    //
    public function store(Request $request)
    {

//        return $request;
        $user= JWTAuth::parseToken()->toUser();
//        $user->id;
        $category_mentor= new CategoryMentorService();
        $mentor_data=$request->all();
        $data = $category_mentor->beMentor($mentor_data,$user->id);
        return $data;
    }
    public function update(Request $request){
        //Sentry::getUser()->id;
        if($request->all()){
            $user= JWTAuth::parseToken()->toUser();
//            $user->id;
            $category_mentor= new CategoryMentorService();
            $data = $category_mentor->UnMentor($request,$user->id);
            return $data;
//        }elseif ($request->all()['action']=="approve"){
//            $category_mentor= new CategoryMentorService();
//            $data =$category_mentor->ApproveMentor($request);
//            return $data;
        }else{
            return response()->json(['status' => 0, 'message' => 'unkown action']);
        }
    }
    public function get_mentor_details(Request $request,$id){
        $mentor = DB::table('users')
            ->where('id', '=', $id)
            ->first();
        return response()->json(['status' => 1,'mentor'=>$mentor, 'message' => 'Mentor details retrieved successfully']);
    }
}