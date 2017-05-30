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




      //   // for($i=0;$i<count($post);$i++){
      //   for($i=0;$i<count($post);$i++){
      //     $countlike = DB::table('likeables')
      //
      // ->join('posts','likeables.likeable_id', '=',$post[$i]->id)
      // ->select(DB::raw('count(likeables.liked) as liked_count','likeables.liked'))
      // ->where([
      //    ['likeables.likeable_id','=',$post[$i]->id,
      //    ['likeables.liked', '=', '1']
      //   ]])
      // ->groupBy('likeables.liked')
      //
      // ->get();
      //   }







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


}
