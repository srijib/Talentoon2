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

use App\Models\Country;
use App\Models\Follow;


class UserProfile extends Controller
{
    public function cur_user(){
        $user= JWTAuth::parseToken()->toUser();
        $talent_in = DB::table('category_talents')
             ->where('talent_id', '=', $user->id)
            ->select('category_id')
             ->get();

        $country = DB::table('users')
            ->join('countries', 'countries.id', '=', 'users.country_id')
            ->select('countries.name as country_name')
            ->where("users.id",$user->id)
            ->get()->first();

        return response()->json(['cur_user'=>$user,'talent_in'=>$talent_in,'country'=>$country]);
    }
    public function main_role(){
        $user= JWTAuth::parseToken()->toUser();
        $is_mentor = DB::table('role_user')
             ->where('user_id', '=', $user->id)
            ->select('role_id')
             ->first();

        return response()->json($is_mentor);
    }

 public function index(Request $request){


     $user= JWTAuth::parseToken()->toUser();
    //mentor review points
//     return response()->json($user);
    $total_mentor_reviews_points = DB::table('mentor_reviews')
         ->join('posts', 'posts.id', '=', 'mentor_reviews.post_id')
         ->join('users', 'posts.user_id', '=', 'users.id')
         ->where('posts.user_id', '=', 1)
        ->select('posts.user_id',DB::raw('sum(points) as points'))
         ->groupBy('posts.user_id')
         ->get();





    //user points
    if(count($total_mentor_reviews_points)){
    $points = $total_mentor_reviews_points[0]->points;


//        return response()->json($points);


    //level of user
     $level = 0;

     if($points<100){
         $level = 1;
     }
     if($points>=100 && $points<200)
     {
         $level = 2;
     }
     if($points>=200 && $points<300)
     {
         $level = 3;
     }
     if($points>=300 && $points<400)
     {
         $level = 4;
     }
     if($points>=400 && $points<500)
     {
         $level = 5;
     }
     if($points>=500 && $points<600)
     {
         $level = 6;
     }
     if($points>=600 && $points<700)
     {
         $level = 7;
     }
     if($points>=700 && $points<800)
     {
         $level = 8;
     }
     if($points>=800 && $points<900)
     {
         $level = 9;
     }
     if($points>=900 && $points<1000)
     {
         $level = 10;
     }


    //image of the reward
         switch ($level) {
             case "1":
                 $rewardimage = DB::table('rewards')
                     ->select('first')
                     ->get();
                 $levelname = "first";
                 break;
             case "2":
                 $rewardimage = DB::table('rewards')
                     ->select('second')
                     ->get();
                 $levelname = "second";
                 break;
             case "3":
                 $rewardimage = DB::table('rewards')
                     ->select('third')
                     ->get();
                 $levelname = "third";
                 break;
             case "4":
                 $rewardimage = DB::table('rewards')
                     ->select('fourth')
                     ->get();
                 $levelname = "fourth";
                 break;
             case "5":
                 $rewardimage = DB::table('rewards')
                     ->select('fifth')
                     ->get();
                 $levelname = "fifth";
                 break;
             case "6":
                 $rewardimage = DB::table('rewards')
                     ->select('sixth')
                     ->get();
                 $levelname = "sixth";
                 break;
             case "7":
                 $rewardimage = DB::table('rewards')
                     ->select('seventh')
                     ->get();
                 $levelname = "seventh";
                 break;
             case "8":
                 $rewardimage = DB::table('rewards')
                     ->select('eighths')
                     ->get();
                 $levelname = "eighths";
                 break;
             case "9":
                 $rewardimage = DB::table('rewards')
                     ->select('ninth')
                     ->get();
                 $levelname = "ninth";
                 break;
             case "10":
                 $rewardimage = DB::table('rewards')
                     ->select('tenth')
                     ->get();
                 $levelname = "tenth";
                 break;
             default:
                 $rewardimage = DB::table('rewards')
                     ->select('first')
                     ->get();
                 $levelname = "first";
                 break;
         }




         $rewardimage = $rewardimage[0]->$levelname;

         return response()->json(['status' => 1,
                        'message' => 'user data send successfully',
                      'user_id'=>$user->id,
                    'first_name'=>$user->first_name,
                    'last_name'=>$user->last_name,
                    'image'=>$user->image,
    //                'points' => $total_mentor_reviews_points,
                    'points_number' =>$points,
                    'reward_image'=>$rewardimage,
                    'level' => $level
                  ]);
}
         return response()->json(['status' => 1,
                        'message' => 'user data send successfully',
                      'user_id'=>$user->id,
                    'first_name'=>$user->first_name,
                    'last_name'=>$user->last_name,
                    'image'=>$user->image,
                  ]);

  }

  public function userposts(Request $request){

    $cur_user= JWTAuth::parseToken()->toUser();
    $user=User::find($cur_user->id);

    $my_posts = DB::table('posts')
    ->join('users', 'posts.user_id', '=','users.id' )
    ->selectRaw('CONCAT("http://172.16.3.77:8000","/",posts.media_url) as url,posts.*,cast(posts.created_at as date) as formatted_created_at,count(likeables.id) as like_count,posts.id,users.first_name,users.last_name,users.image')
    // ->join('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('likeables', function($join)
              {
                  $join->on('posts.id','=','likeables.likeable_id')
                  ->where('likeables.liked', '=', '1');
              })
              ->where("posts.user_id",$user->id)
              ->groupBy('posts.id')
                ->get();

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
        ->selectRaw('posts.* , cast(posts.created_at as date) as formatted_created_at , users.first_name , users.last_name , users.image')
        ->whereIn("posts.id", $arr)
        ->get();

//
// select posts.id, posts.title, count(likeables.id) like_count from posts left join likeables on
//  likeables.likeable_id = posts.id and likeables.liked = 1 group by posts.id

    $allPosts = array_merge($my_posts->toArray(),$shares->toArray());


    foreach ($allPosts as $key => $part) {
        $sort[$key] = strtotime($part->created_at);
    }
    array_multisort($sort, SORT_DESC, $allPosts);

    $follower_count = DB::table('follow')
    ->select(DB::raw('count(follow.follower_id) as followers_count'))
    ->where([
       ['follow.following_id','=',$user->id]])
        ->groupBy('follow.following_id')
            ->get()->first();
          //   if(is_null( $follower_count)){
          //       json([$follower_count=>0]);
          //   }

  $following_count = DB::table('follow')
  ->select(DB::raw('count(follow.following_id) as following_count'))
  ->where([
      ['follow.follower_id','=',$user->id]])
      ->groupBy('follow.follower_id')
      ->get()->first();
      $country=Country::find($user->country_id);

    return response()->json(['status' => 1,
                'message' => 'user data send successfully',
                'user_id'=>$user->id,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'image'=>$user->image,
                'user'=>$user,
                // 'post'=>$my_posts,
                'allPosts'=>$allPosts,
                'follower'=>$follower_count,
                'following'=>$following_count,
                'country'=>$country

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
//    return response()->json($request->all());
    $userToken=JWTAuth::parseToken()->toUser();
//    dd(Hash::check($request->userpassword ,$userToken->password));
//    dd($request->email);
    if(!Hash::check($request->userpassword ,$userToken->password)) {
        return response()->json('y nada we should check this to be displayed as a message to user>> ally 2olti fkrini beha simona ');
    }else{
//        return response()->json('right');
//    $return=self::update($request);
        $user=DB::table('users')
            ->where('id', $request->id)
            ->update(['first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'password'=>Hash::make($request->repassword)
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
          ->select('posts.*','users.first_name','users.last_name','users.image')

          ->whereIn("posts.id", $arr)

          ->get();

  $his_posts = DB::table('posts')
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
    $aaa = array_merge($his_posts->toArray(),$shares->toArray());


    foreach ($aaa as $key => $part) {
        $sort[$key] = strtotime($part->created_at);
    }
    array_multisort($sort, SORT_DESC, $aaa);

    return response()->json(['status' => 1,
                      'message' => 'posts send successfully',
                      'shares'=>$shares,
                      'his'=>$his_posts,
                      'aaa'=>$aaa
                    ]);
  }
  public function show($id){
      $follower_count = DB::table('follow')
      ->select(DB::raw('count(follow.follower_id) as followers_count'))
      ->where([
         ['follow.following_id','=',$id]])
          ->groupBy('follow.following_id')
              ->get()->first();
            //   if(is_null( $follower_count)){
            //       json([$follower_count=>0]);
            //   }

    $following_count = DB::table('follow')
    ->select(DB::raw('count(follow.following_id) as following_count'))
    ->where([
        ['follow.follower_id','=',$id]])
        ->groupBy('follow.follower_id')
        ->get()->first();
        // if(is_null( $following_count)){
        //     $following_count=0;
        // }
    $my_posts = DB::table('posts')
    ->join('users', 'posts.user_id', '=','users.id' )
    ->selectRaw('posts.*,cast(posts.created_at as date) as formatted_created_at,count(likeables.id) as like_count,posts.id,users.first_name,users.last_name,users.image')
    // ->join('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('likeables', function($join)
              {
                  $join->on('posts.id','=','likeables.likeable_id')
                  ->where('likeables.liked', '=', '1');
              })
              ->where("posts.user_id",$id)
              ->groupBy('posts.id')
                ->get();

    $post_ids= DB::table('shares')
        ->select('shares.post_id')
        ->where("shares.user_id",$id)
        ->get();

    $arr=[];
    for ($i=0; $i <count($post_ids) ; $i++) {
        array_push($arr,$post_ids[$i]->post_id);
    }

   $shares = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->selectRaw('posts.* , cast(posts.created_at as date) as formatted_created_at , users.first_name , users.last_name , users.image')
        ->whereIn("posts.id", $arr)
        ->get();

  //
  // select posts.id, posts.title, count(likeables.id) like_count from posts left join likeables on
  //  likeables.likeable_id = posts.id and likeables.liked = 1 group by posts.id

    $allPosts = array_merge($my_posts->toArray(),$shares->toArray());


    foreach ($allPosts as $key => $part) {
        $sort[$key] = strtotime($part->created_at);
    }
    array_multisort($sort, SORT_DESC, $allPosts);
    $user=User::find($id);
    $country=Country::find($user->country_id);

    $current_user= JWTAuth::parseToken()->toUser();

    $follow = DB::table('follow')
    ->where('following_id', '=', $id)
    ->where('follower_id', '=', $current_user->id)
    ->first();

if (is_null($follow)) {
    return response()->json(['status' => 1,
                'message' => 'user data send successfully',
                'user'=>$user,
                'country'=>$country,
                // 'post'=>$my_posts,
                'allPosts'=>$allPosts,
                'follow'=>0,
                'follower'=>$follower_count,
                'following'=>$following_count
                // 'count'=>$countlike

              ]);
}else{

    return response()->json(['status' => 1,
                'message' => 'user data send successfully',
                'user'=>$user,
                'country'=>$country,
                // 'post'=>$my_posts,
                'allPosts'=>$allPosts,
                'follow'=>1,
                'follower'=>$follower_count,
                'following'=>$following_count
                // 'count'=>$countlike

              ]);
}
        }
public function follow(Request $request){
    $user= JWTAuth::parseToken()->toUser();
Follow::create(['following_id'=>$request->following_id,'follower_id'=>$user->id]);

return response()->json(['status' => 1,
                    'message' => 'follow successfully']);
}
public function unfollow(Request $request){
    $user= JWTAuth::parseToken()->toUser();
    DB::table('follow')->where(['following_id'=>$request->following_id,'follower_id'=>$user->id])->delete();

return response()->json(['status' => 1,
                    'message' => 'unfollow successfully']);
}

}
