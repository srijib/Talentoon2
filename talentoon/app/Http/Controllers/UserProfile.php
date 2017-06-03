<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Post;
use DB;
use App\Models\Share;
use App\Models\User;

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


    // $countlike=[];
    // for ($i=0; $i <count($post) ; $i++) {
    //       $countlike = DB::table('likeables')
    //           ->join('posts','likeables.likeable_id', '=','posts.id')
    //           ->select(DB::raw('count(likeables.liked) as liked_count','likeables.liked'))
    //           ->where([
    //              ['likeables.likeable_id','=',$post[$i]->id],
    //              ['likeables.liked', '=', '1'],
    //              ])
    //               ->groupBy('likeables.liked')
    //
    //           ->get();

        }



    return response()->json(['status' => 1,
                'message' => 'user data send successfully',
                'user_id'=>$user->id,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'image'=>$user->image,
                'post'=>$post
                // 'count'=>$countlike

              ]);


  }
  public function displayShared(){
      $user= JWTAuth::parseToken()->toUser();
      $post_ids= DB::table('shares')
          ->select('shares.post_id')
          ->where("shares.user_id",$user->id)
          ->get();
        //   dd($post_ids[0]->post_id);

      $arr=[];
      for ($i=0; $i <count($post_ids) ; $i++) {
          array_push($arr,$post_ids[$i]->post_id);
      }



      $shares = DB::table('posts')
          ->join('users', 'posts.user_id', '=', 'users.id')
          ->select('posts.*','users.*')
          ->whereIn("posts.id", $arr)
          ->get();
    return response()->json(['status' => 1,
                      'message' => 'posts send successfully',
                      'shares'=>$shares
                    ]);
  }


}
