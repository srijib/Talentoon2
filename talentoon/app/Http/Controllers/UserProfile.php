<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Post;
use DB;
use App\Models\Share;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserProfile extends Controller
{

 public function index(Request $request){

$user= JWTAuth::parseToken()->toUser();


$total_mentor_reviews_points = DB::table('mentor_reviews')
     ->join('posts', 'posts.id', '=', 'mentor_reviews.post_id')
     ->join('users', 'posts.user_id', '=', 'users.id')
     ->where('posts.user_id', '=', 1)
    ->select('posts.user_id',DB::raw('sum(points) as points'))
     ->groupBy('posts.user_id')
     ->get();


return response()->json(['status' => 1,
                    'message' => 'user data send successfully',
                  'user_id'=>$user->id,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'image'=>$user->image,
                'points' => $total_mentor_reviews_points,

              ]);


  }

  public function userposts(Request $request){

    $user= JWTAuth::parseToken()->toUser();

    $post = DB::table('posts')
    // ->join('users', 'posts.user_id', '=','users.id' )
    ->selectRaw('posts.*,count(likeables.id) as like_count,posts.id')
        ->leftJoin('likeables', function($join)
              {
                  $join->on('posts.id','=','likeables.likeable_id')
                  ->where('likeables.liked', '=', '1');
              })
              ->where("posts.user_id",$user->id)
              ->groupBy('posts.id')
                ->get();
//
// select posts.id, posts.title, count(likeables.id) like_count from posts left join likeables on
//  likeables.likeable_id = posts.id and likeables.liked = 1 group by posts.id





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


public function edit(){
    $userToken=JWTAuth::parseToken()->toUser();
    $user = DB::table('users')
        ->join('countries', 'countries.id', '=', 'users.country_id')
        ->select('users.*','countries.name as country_name')
        ->where("users.id",$userToken->id)
        ->get()->first();
    return response()->json($user);
}
public function checkpassword(Request $request)
{

    $userToken=JWTAuth::parseToken()->toUser();

    if(!Hash::check($request->userpassword ,$userToken->password)) {
        return response()->json('wrong');
    }else{
//        return response()->json('right');
//    $return=self::update($request);
        $user=DB::table('users')
            ->where('id', $request->id)
            ->update(['first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'password'=>$request->repassword,
//                'date_of_bith'=>$request->date_of_bith,
//            'country_id'=>$request->country_name
            ]);
        return response()->json($user);
}

}
public function update(Request $request){
//    return response()->json('simona12');
    $user=DB::table('users')
        ->where('id', $request->id)
        ->update(['first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
//            'date_of_bith'=>$request->date_of_bith,
//            'country_id'=>$request->country_name
        ]);


    return response()->json($user);
}




  public function displayShared(){

    //   $categories_id=DB::table('subscribers')
    //       ->select('subscribers.category_id')
    //       ->where([['subscribers.subscriber_id', '=', $user->id],['subscribers.subscribed', '=',1]])
    //       ->get();
    //       $arr=[];
    //       for ($i=0; $i <count($categories_id) ; $i++) {
    //           array_push($arr,$categories_id[$i]->category_id);
    //       }

      $user= JWTAuth::parseToken()->toUser();
      $post_ids= DB::table('shares')
          ->select('shares.post_id')
          ->where("shares.user_id",$user->id)
          ->get();

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
