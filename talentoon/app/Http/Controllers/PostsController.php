<?php

namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Services\Notification;
//use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        // $posts= Post::all();
        // return view('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Mail::to('mina.zakaria.zakher@gmail.com')->send(new WelcomeMina());
        // dd($request->all());

        // return response()->json(['cat_id'=>$cat_id,'status' => $request->all(),'message' => 'data saved successfully']);

        //Post::create($request->all());
         $user= JWTAuth::parseToken()->toUser();
        // $id = Post::create($request->all())->id;

        $id=Post::create(array(
            'user_id' => $user->id,
            'category_id' => $request['category_id'],
            'title' => $request['title'],
            'description' => $request['description'],
        ))->id;





        return response()->json(['post_id' => $id,'message' => 'data saved successfully']);
        // return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'categories.title as category_title', 'users.first_name', 'users.last_name', 'users.image')
            ->where("posts.id",$id)
            ->get();







        return response()->json(['post' => $post,'status' => '1','message' => 'data sent successfully']);

        // return view('posts.show',['post'=>$post]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'categories.title as category_title', 'users.first_name', 'users.last_name', 'users.image')
            ->where("posts.id",$id)
            ->get();
        return response()->json(['post' => $post,'status' => '1','message' => 'data sent successfully']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        post::find($id)->update($request->all());
        return response()->json(['status' => '1','message' => 'data sent successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostLikablePosts(){


        $posts_id=DB::table('likeables')
            ->select('likeable_id',DB::raw('count(*) as total'))
            ->where('likeable_type', '=', 'post')
            ->groupBy('likeable_id')
            ->orderBy('total', 'desc')
            ->take(3)
            ->get();
//        dd($posts_id);
        $data=array();
        foreach ($posts_id as &$value) {
            $post = DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.*','users.first_name as first_name', 'users.last_name as last_name', 'users.image as user_image')
                ->where("posts.id",$value->likeable_id)
                ->get();
            array_push($data, $post[0]);
//            dd($data);
        }
//        dd($data);
//        $notify=new Notification();
//        $device=$notify->addDevice();
//        $response = $notify->sendMessageAll();
//        $return["allresponses"] = $response;
//        $return = json_encode( $return);
        return response()->json(['msg'=>'success','posts'=>$data]);
    }
    public function destroy($id)
    {
        //
        $post=Post::findOrFail($id);
        $post->delete();
        return response()->json(['status' => '1','message' => 'post deleted successfully']);
    }

public function showSinglePost($post_id){

  $post = DB::table('posts')
      ->join('categories', 'posts.category_id', '=', 'categories.id')
      ->join('users', 'posts.user_id', '=', 'users.id')
      ->leftJoin('likeables', function($join)
            {
                $join->on('posts.id','=','likeables.likeable_id')
                ->where('likeables.liked', '=', '1');
            })

      ->selectRaw('posts.*,count(likeables.id) as like_count,posts.id, categories.title as category_title, users.first_name, users.last_name, users.image as user_image')

          ->where("posts.id",$post_id)
          ->groupBy('posts.id')
      ->get()->first();







      // $comments=DB::table('comments')
      //     ->join('users', 'comments.user_id', '=', 'users.id')
      //     ->select('comments.*','users.first_name', 'users.last_name', 'users.image')
      //     ->where("comments.post_id",$post_id)
      //     ->get();
// 'comments'=>$comments,
      // $countlike = DB::table('likeables')
      //     ->join('posts','likeables.likeable_id', '=','posts.id')
      //     ->select(DB::raw('count(likeables.liked) as liked_count','likeables.liked'))
      //     ->where([
      //        ['likeables.likeable_id','=',$post_id],
      //        ['likeables.liked', '=', '1'],
      //        ])
      //         ->groupBy('likeables.liked')
      //
      //     ->get()->first();

  return response()->json(['post' => $post,'status' => '1','message' => 'data sent successfully']);
// 'countlike'=>$countlike


}


}
