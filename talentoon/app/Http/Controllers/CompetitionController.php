<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Competition;
use App\Models\WorkShop;
use Response;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Services\Notification;


class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        $competitions= Competition::all();

        return response()->json(['user' => $user,'data' => $competitions,'status' => '1','message' => 'data retrieved successfully']);
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
        $user= JWTAuth::parseToken()->toUser();
//        $user->id;

         Competition::create($request->all());
         return Response::json(['status' => '1','message' => 'competition data saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $competition=Competition::find($id);
//        $posts=Post::where('category_id','=', $id)->get();
//        $workshops=WorkShop::where('category_id','=', $id)->get();
//
//
//        // dd($posts);
//        // dd(response()->json(['category_details' => $category,'posts' => $posts,'status' => '1','message' => 'data sent successfully']));
//        return response()->json(['category_details' => $category,'workshops' => $workshops,'posts' => $posts,'status' => '1','message' => 'data sent successfully']);
//        // return view('category.show',['category'=>$category]);
    }

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
}
