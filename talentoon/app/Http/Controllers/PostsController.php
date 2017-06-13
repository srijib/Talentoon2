<?php

namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Follow;

use App\Services\Notification;
// use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['ability:talent|mentor,create-post','checkrelatedcategory'])->only('store');

    }

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


        // $notify = new Notification();
        // $n=$notify->sendMessageFilter();
        // $response=array(
        //     'post_id' => $id,
        //     'message' => 'data saved successfully'
        // );
//        $result=json_encode(array_merge($response,json_decode($n, true)));
        // return $n;

       return response()->json(['post_id' => $id,'message' => 'data saved successfully']);


        // return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category_id,$id)
    {
        //
        $post = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'categories.title as category_title', 'users.first_name', 'users.last_name', 'users.image')
            ->where([["posts.id",$id],['posts.is_approved','=',1]])
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
//    public function edit($id)
//    {
//        //
//        $post = DB::table('posts')
//            ->join('categories', 'posts.category_id', '=', 'categories.id')
//            ->join('users', 'posts.user_id', '=', 'users.id')
//            ->select('posts.*', 'categories.title as category_title', 'users.first_name', 'users.last_name', 'users.image')
//            ->where("posts.id",$id)
//            ->get();
//        return response()->json(['post' => $post,'status' => '1','message' => 'data sent successfully']);
//
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, $id)
//    {
//        //
//        post::find($id)->update($request->all());
//        return response()->json(['status' => '1','message' => 'data sent successfully']);
//    }

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
        $data=array();
        // $comments=array();
        foreach ($posts_id as &$value) {

            $post = DB::table('posts')
//                $users = DB::table('users')
//                    ->join('contacts', 'users.id', '=', 'contacts.user_id')
                ->join('users', 'posts.user_id' , '=', 'users.id' )
                //,'users.first_name as first_name', 'users.last_name as last_name', 'users.image as user_image'
                ->select(DB::raw('CONCAT("http://172.16.3.77:8000","/",posts.media_url) as url' ) ,'posts.*','users.first_name as first_name', 'users.last_name as last_name', 'users.image as user_image')
                ->where("posts.id",$value->likeable_id)
                ->get();



            $post[0]->total = $value->total;




                // dd($post[0]);
            array_push($data, $post[0]);



        }
        $comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*','users.first_name as first_name', 'users.last_name as last_name', 'users.image as user_image')
            ->get();

        return response()->json(['msg'=>'success','posts'=>$data,'comments'=>$comments]);

    }
//    public function destroy($id)
//    {
//        //
//        $post=Post::findOrFail($id);
//        $post->delete();
//        return response()->json(['status' => '1','message' => 'post deleted successfully']);
//    }



    public function edit($cat_id,$post_id)
    {   //I need to take category id and workshop id and
        // by checking the mentor_id is the user id then edit else not
        //from Request $request we will git the editable data
        $user=JWTAuth::parseToken()->toUser();
//        return response()->json($post_id);
        $post = DB::table('posts')
            ->select('posts.*')
            ->where("posts.category_id",$cat_id)
            ->where("posts.id",$post_id)
            ->get()->first();
        return response()->json($post);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        return response()->json($request);
        $post=DB::table('posts')
            ->where('id', $request->id)
            ->update(['title'=>$request->title,
                'description'=>$request->description,
//                'media_type'=>$request->media_type,
//                'media_url'=>$request->media_url
            ]);


        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cat_id,$id)
    {
//        return response()->json($id);
        $affectedRows = Post::where('id', '=', $id)
            ->delete();

        if ($affectedRows){
//            $post->likes()->detach();

            $deleteLikes = DB::table('likeables')
                ->where('likeable_id', '=', $id)
                ->where('likeable_type', '=', 'post')
                ->delete();

            return response()->json(['result'=>'true','deleted likes'=>$deleteLikes]);
        }else{
            return response()->json('false');
        }
    }
    public function isPostCreator(Request $request){
        $user=JWTAuth::parsetoken()->toUser();
//        dd($user->id);

        $creator = DB::table('posts')
            ->select('posts.*')
            ->where("posts.user_id",$user->id)
            ->where("users.id",$request->user_id)
            ->get()->first();
        if ($creator){
            return response()->json(['creator'=>1]);
        }else{
            return response()->json(['creator'=>0]);
        }

    }
//***************************************************


public function showSinglePost($post_id){

    $user=JWTAuth::parsetoken()->toUser();
  $post = DB::table('posts')
      ->join('categories', 'posts.category_id', '=', 'categories.id')
      ->join('users', 'posts.user_id', '=', 'users.id')
      ->leftJoin('likeables', function($join)
            {
                $join->on('posts.id','=','likeables.likeable_id')
                ->where('likeables.liked', '=', '1');
            })

      ->selectRaw('CONCAT("http://172.16.3.77:8000","/",posts.media_url) as url,posts.*,count(likeables.id) as like_count,posts.id, categories.title as category_title, users.first_name, users.last_name, users.image as user_image')

          ->where([["posts.id",$post_id],['posts.is_approved','=',1]])
          ->groupBy('posts.id')
      ->get()->first();


     $is_liked = DB::table('likeables')
     ->select('liked')
     ->where([["user_id",'=',$user->id],['likeable_id','=',$post_id]])
       ->get();


  $post_comment = DB::table('posts')
  ->join('comments', 'comments.post_id', '=', 'posts.id')
  ->selectRaw('count(comments.id)as count_comment,posts.id')
  ->where("comments.post_id",$post_id)
    ->groupBy('posts.id')
    ->get();


      $comments=DB::table('comments')
          ->join('users', 'comments.user_id', '=', 'users.id')
          ->select('comments.*','users.first_name', 'users.last_name', 'users.image')
          ->where("comments.post_id",$post_id)
          ->get();
// 'comments'=>$comments,


  return response()->json(['post_comment'=>$post_comment,'post' => $post,'is_liked'=>$is_liked,'comments'=>$comments,'status' => '1','message' => 'data sent successfully']);
// 'countlike'=>$countlike



}

    public function Subscribedposts(){
        $user= JWTAuth::parseToken()->toUser();

        $categories_id=DB::table('subscribers')
           ->select('subscribers.category_id')
           ->where([['subscribers.subscriber_id', '=', $user->id],['subscribers.subscribed', '=',1]])
           ->get();
           $arr=[];
           for ($i=0; $i <count($categories_id) ; $i++) {
               array_push($arr,$categories_id[$i]->category_id);
           }

           $all_posts = DB::table('posts')
               ->join('users', 'posts.user_id', '=', 'users.id')
               ->select('posts.*','users.first_name','users.last_name','users.image')
               ->where('posts.is_approved','=',1)
               ->whereIn("posts.category_id", $arr)
               ->get();
               $following_id=DB::table('follow')
                  ->select('follow.following_id')
                  ->where([['follow.follower_id', '=', $user->id]])
                  ->get();
                  $following=[];
                  for ($i=0; $i <count($following_id) ; $i++) {
                      array_push($following,$following_id[$i]->following_id);
                  }
                  $allposts = DB::table('posts')
                      ->join('users', 'posts.user_id', '=', 'users.id')
                      ->select('posts.*','users.first_name','users.last_name','users.image')
                      ->where('posts.is_approved','=',1)
                      ->whereIn("posts.user_id", $following)
                      ->get();
                      $posts=array_merge($allposts->toArray(),$all_posts->toArray());
                      foreach ($posts as $key => $part) {
                          $sort[$key] = strtotime($part->created_at);
                      }
                      array_multisort($sort, SORT_DESC, $posts);

            return response()->json(['posts'=>$posts,'status' => '1','message' => 'data sent successfully']);
    }


}
