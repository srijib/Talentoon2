<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\WorkShop;
use App\Models\CategoryTalent;
use App\Models\CategoryMentor;
use App\Models\MentorReviews;
use Response;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Services\Notification;
use DB;
use App\Models\Comment;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('jwt.auth', ['only'=>['index','show']]);
    }
    public function index()
    {


        try{
        $user = JWTAuth::parseToken()->authenticate();
       $categories= Category::all();
       //N.B token had value however it is printed {}
       $token=JWTAuth::getToken();
        } catch (Exception $ex) {
            dd(['here']);
        }
       //dd($token);
        // $path=$categories[0]->getAttributes()['image'];
        // $categories[5]->getAttributes()['image'] = '/uploads/files/'.$categories[5]->getAttributes()['image'];
        // dd($categories[5]->getAttributes()['image']);

        return response()->json(['user' => $user,'data' => $categories,'status' => '1','message' => 'data sent successfully'
          //'token'=>$token
            ]);
        // return view('categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // dd($request->all());
        // Category::create($request->all());
        // return Response::json(['status' => '1','message' => 'data saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cat_id)
    {

        $user = JWTAuth::parseToken()->authenticate();
        $category=Category::find($cat_id);

        $subscribed = DB::table('subscribers')
                    -> select('subscribed')
                    ->where([['subscriber_id', '=', $user->id],['category_id','=',$cat_id]])
                    ->get();
        $talent = DB::table('category_talents')
                    -> select('status')
                    ->where([['talent_id', '=', $user->id],['category_id','=',$cat_id]])
                    ->get();

        $mentor = DB::table('category_mentors')
                    -> select('status')
                    ->where([['mentor_id', '=', $user->id],['category_id','=',$cat_id]])
                    ->get();

        $posts = DB::table('posts')
        ->join('users', 'posts.user_id', '=','users.id' )
        ->selectRaw('posts.*,count(likeables.id) as like_count,posts.id,users.last_name,users.first_name,users.image as user_image,users.id as user_id')
            ->leftJoin('likeables', function($join)
                  {
                      $join->on('posts.id','=','likeables.likeable_id')
                      ->where('likeables.liked', '=', '1');
                  })
                //   ->rightJoin('comments', function($join)
                //         {
                //             $join->on('comments.post_id','=','posts.id');
                //         })
        // ->join('comments','comments.post_id','=','posts.id')
                  ->where([['posts.category_id','=',$cat_id],['posts.is_approved','=',1]])
                  ->groupBy('posts.id')
                    ->get();
        $workshops = DB::table('workshops')
            ->join('users', 'users.id', '=', 'workshops.mentor_id')
            ->select('workshops.*','users.first_name', 'users.last_name', 'users.image as user_image')
            ->where([['workshops.category_id','=',$cat_id],['workshops.is_approved','=',1]])
            ->where('workshops.date_to','>=', date('Y-m-d').' 00:00:00')
            ->get();
        $events = DB::table('events')
            ->join('users', 'users.id', '=', 'events.mentor_id')
            ->select('events.*','users.first_name', 'users.last_name', 'users.image as user_image')
            ->where([['events.category_id','=',$cat_id],['events.is_approved','=',1]])
            ->where('events.date_to','>=', date('Y-m-d').' 00:00:00')
            ->get();
            // return response()->json(['posts' => $posts,'status' => '1','message' => 'data sent successfully']);
            $comments = DB::table('comments')
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->select('comments.*','users.first_name as first_name', 'users.last_name as last_name', 'users.image as user_image')
                ->get();
        return response()->json(['comments'=>$comments,'is_mentor'=>$mentor,'is_talent'=>$talent,'is_sub'=>$subscribed,'cur_user'=>$user,'events'=>$events,'category_details' => $category,'workshops' => $workshops,'posts' => $posts,'status' => '1','message' => 'data sent successfully']);
    }
//
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //may be front end don't want this method
        // $category=Post::find($categoryId);
        // return Response::json($category);
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
        // Category::find($id)->update($request->all());
        // return Response::json($category);
        // return redirect()->route('admin.posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $category=Category::findOrFail($id);
        // $category->delete();
        // return Response::json($category);
        // return redirect()->route('admin.posts');
    }


    public function get_post_reviews()
    {
        //$mentor_reviews=MentorReviews::all();
        $mentor_reviews = DB::table('mentor_reviews')
                 ->join('users', 'mentor_reviews.mentor_id', '=', 'users.id')
                 ->select('mentor_reviews.*','users.*')
                 ->get();
        return Response::json(['status' => '1','message' => 'data retrieved successfully','reviews'=>$mentor_reviews]);

    }
    public function add_mentor_post_review(Request $request)
    {
        $user= JWTAuth::parseToken()->toUser();

        $mentor_review = new MentorReviews;

        $mentor_review->post_id = $request->id;
        $mentor_review->mentor_id = $user->id;
        $mentor_review->points = $request->rev['points'];
        $mentor_review->comment = $request->rev['comment'];
        $mentor_review->save();

        return Response::json(['status' => '1','message' => 'here successfully']);
    }
}
