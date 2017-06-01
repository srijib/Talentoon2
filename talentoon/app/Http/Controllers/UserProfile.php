<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Post;
use DB;

class UserProfile extends Controller
{

  public function index(Request $request){

$user= JWTAuth::parseToken()->toUser();
return response()->json(['status' => 1,
                    'message' => 'user data send successfully',
                  'user_id'=>$user->id,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'image'=>$user->image,
              ]);


  }

  public function userposts(Request $request){

    $user= JWTAuth::parseToken()->toUser();
    $post = DB::table('posts')
        ->join('users', 'posts.user_id', '=','users.id' )
        ->select('posts.*')
        ->where("posts.user_id",$user->id)
        ->get();

    return response()->json(['status' => 1,
                'message' => 'user data send successfully',
                'user_id'=>$user->id,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'image'=>$user->image,
                'post'=>$post,
                'countlike'=>$countlike
              ]);


  }
  public function dispalyShared(){
      $user= JWTAuth::parseToken()->toUser();
      $workshop = DB::table('shares')
          ->join('posts', 'shares.post_id', '=', 'posts.id')
          ->join('users', 'shares.user_id', '=', 'users.id')
          ->select('shares.*', 'posts.*', 'users.first_name', 'users.last_name')
          ->where("shares.user_id",$user)
          ->get();



  }


}
