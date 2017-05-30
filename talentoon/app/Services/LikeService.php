<?php
namespace App\Services;
use App\Models\Like;
use Illuminate\Http\Request;
use DB;

class LikeService
{

    public static function like ($request){

    $like = DB::table('likeables')
    ->where('user_id', '=', $request->user_id)
    ->where('likeable_id', '=', $request->likeable_id)
    ->where('likeable_type', '=', $request->likeable_type)
    ->first();


    // $is_like=DB::table('likeables')->where('user_id',$request->user_id)->update(['liked' => 1]);

if (is_null($like)) {
    $liked=Like::create($request->all());

} else {
    $is_like=DB::table('likeables')->where('user_id',$request->user_id)->where('likeable_id',$request->likeable_id)->update(['liked' => 1]);


}
return response()->json(['status' => 1,
                    'message' => 'liked successfully',
                  'user_id'=>$request->user_id]);


    }
    public static function Dislike ($request){
            $is_like=DB::table('likeables')->where('user_id',$request->user_id)->where('likeable_id',$request->likeable_id)->update(['liked' => 0]);

    return response()->json(['status' => 0,
                                'message' => 'dislike successfully',
                              'user_id'=>$request->user_id]);

        }

}


?>
