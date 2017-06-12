<?php
namespace App\Services;
use App\Models\Like;
use Illuminate\Http\Request;
use DB;

class LikeService
{

    public static function like ($request, $user_id){
    $like = DB::table('likeables')
    ->where('user_id', '=', $user_id)
    ->where('likeable_id', '=', $request->likeable_id)
    ->where('likeable_type', '=', $request->likeable_type)
    ->first();


    // $is_like=DB::table('likeables')->where('user_id',$request->user_id)->update(['liked' => 1]);

if (is_null($like)) {
    $liked=Like::create([
        'user_id'=>$user_id,
        'likeable_id'=>$request->likeable_id,
        'likeable_type'=>$request->likeable_type
    ]);

} else {
    $is_like=DB::table('likeables')->where('user_id',$user_id)->where('likeable_id',$request->likeable_id)->update(['liked' => 1]);
}


$new_count_likes = DB::table('likeables')
->selectRaw('count(id)as count_like,id')
->where([["likeable_id",$request->likeable_id],['liked','=',1]])
  ->groupBy('id')
  ->get();

  $is_liked = DB::table('likeables')
  ->select('liked')
  ->where([["user_id",'=',$user_id],['likeable_id','=',$request->likeable_id]])
    ->get();

return response()->json(['status' => 1,
                    'message' => 'liked successfully',
                  'user_id'=>$user_id,
              'new_like_count'=>$new_count_likes,
                'is_liked'=>$is_liked]);


    }
    public static function Dislike ($request,$user_id){
    $is_like=DB::table('likeables')->where('user_id',$user_id)->where('likeable_id',$request->likeable_id)->update(['liked' => 0]);
    // $is_like=DB::table('likeables')->where('user_id',$request->user_id)->where('likeable_id',$request->likeable_id)->delete();
    $new_count_likes = DB::table('likeables')
    ->selectRaw('count(id)as count_like,id')
    ->where([["likeable_id",$request->likeable_id],['liked','=',1]])
      ->groupBy('id')
      ->get();

      $is_liked = DB::table('likeables')
      ->select('liked')
      ->where([["user_id",'=',$user_id],['likeable_id','=',$request->likeable_id]])
        ->get();
    return response()->json(['status' => 0,
                                'message' => 'dislike successfully',
                              'user_id'=>$user_id,
                              'new_like_count'=>$new_count_likes,
                                'is_liked'=>$is_liked]);

        }

}


?>
