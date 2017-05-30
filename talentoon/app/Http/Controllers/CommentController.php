<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommentService;
use \Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class CommentController extends Controller
{
    //
    //
    /**
     * Send back all comments as JSON
     *
     * @return Response
     */
    public function __construct() {
       $this->middleware('ability:audience,permission:create-comment|delete-comment',['only'=>['store','destroy']]);
       $user=JWTAuth::parseToken()->toUser();
      //dd($user->can('be-talent'));
       }
    public function index()
    {
        return Response::json(Comment::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $user= JWTAuth::parseToken()->toUser();

        $comment=new CommentService();
        $data=$comment->CreateComment($request,$user->id);

        return Response::json(array('message' => $data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        //will be checked later

        // dd($request->all());

//        dd('simonaaaaaaaaaa');
        $user= JWTAuth::parseToken()->toUser();
        $comment=new CommentService();
        $data=$comment->DeleteComment($request,$user->id);

        return Response::json(array('message' => $data));
    }
}
