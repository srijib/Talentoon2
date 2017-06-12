<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LikeService;
use JWTAuth;
class LikeController extends Controller
{

  public function store(Request $request){
      // return response()->json(['status' => $request,'message' => 'data saved successfully']);
      $user= JWTAuth::parseToken()->toUser();
   $response=LikeService::like($request , $user->id);
   return $response;


  }
  public function update(Request $request){
      $user= JWTAuth::parseToken()->toUser();

   $response=LikeService::Dislike($request,$user->id);
   return $response;

}






}
    //
    // public function likePost($id)
    // {
    //     // here you can check if product exists or is valid or whatever
    //
    //     $this->handleLike('App\Post', $id);
    //     return redirect()->back();
    // }
    //
    //
    //
    // public function handleLike($type, $id)
    // {
    //     $existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($id)->whereUserId(Auth::id())->first();
    //
    //     if (is_null($existing_like)) {
    //         Like::create([
    //             'user_id'       => Auth::id(),
    //             'likeable_id'   => $id,
    //             'likeable_type' => $type,
    //         ]);
    //     } else {
    //         if (is_null($existing_like->deleted_at)) {
    //             $existing_like->delete();
    //         } else {
    //             $existing_like->restore();
    //         }
    //     }
    // }


    //Dislike section

    // public function dislikePost($id)
    // {
    //     // here you can check if product exists or is valid or whatever
    //
    //     $this->handleDisLike('App\Post', $id);
    //     return redirect()->back();
    // }

    //
    // public function handleDisLike($type, $id)
    // {
    //     $existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($id)->whereUserId(Auth::id())->first();
    //
    //     Like::delete([
    //         'user_id'       => Auth::id(),
    //         'likeable_id'   => $id,
    //         'likeable_type' => $type,
    //     ]);


//        if (is_null($existing_like)) {
//            Like::create([
//                'user_id'       => Auth::id(),
//                'likeable_id'   => $id,
//                'likeable_type' => $type,
//            ]);
//        } else {
//            if (is_null($existing_like->deleted_at)) {
//                $existing_like->delete();
//            } else {
//                $existing_like->restore();
//            }
//        }
    // }
// }
