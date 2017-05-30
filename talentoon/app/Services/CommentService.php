<?php

namespace App\Services;

use App\Models\Comment;
use App\Http\Requests;
use Illuminate\Database\Eloquent\Model;
use \Response;
use Carbon\Carbon ;
use DB;

class CommentService
{

    public function CreateComment($request,$user_id){



        Comment::create(array(
            'text' => $request['text'],
            'user_id' => $user_id,
            'commentable_id' => $request['commentable_id'],
            'commentable_type' => $request['commentable_type']
        ));

        return Response::json(array('success' => true));
    }
    public function DeleteComment($data,$id){

        //let id will be comment_id which will be deleted

        //$id=1;
        $affectedRows = Comment::where('id', '=', $data['comment_id'])
            ->where('user_id', '=', $data['user_id'])
            ->where('commentable_id','=',$data['commentable_id'])
            ->where('commentable_type','=',$data['commentable_type'])
            ->delete();

        if ($affectedRows){
            return Response::json(array('success' => true));
        }else{
            return Response::json(array('success' => false));
        }


    }



}