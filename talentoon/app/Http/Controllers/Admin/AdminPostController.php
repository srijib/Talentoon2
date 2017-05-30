<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminPostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin');
        $posts= Post::all();
        return view('admin.posts.index',['posts'=>$posts]);
    }

    // public function posts()
    // {
    //     $posts= Post::all();
    //     return view('admin.posts.index',['posts'=>$posts]);
    // }
    public function destroy($id){
        $post=Post::findOrFail($id);
        $post->delete();
        return redirect()->route('post.index');
    }
    public function edit($id){
        $post=Post::find($id);
        return view('admin.posts.edit',['post'=> $post]);

    }
    public function update(Request $request,$id)
    {

        Post::find($id)->update($request->all());
        return redirect()->route('post.index');

    }
    public function show($id){
        $post=Post::find($id);
        $user=User::find($post->user_id);
        $user_name=$user->first_name." ".$user->last_name;
        $category=Category::find($post->category_id);
        $category_name=$category->title;
        return view('admin.posts.show',['post'=>$post,'user_name'=>$user_name,'category_name'=>$category_name]);
    }
    public function isApprove($id){
            DB::table('posts')->where('id', $id)->update(['is_approved' => 1]);

        return redirect()->route('post.index');


    }
        public function unApprove($id){
            DB::table('posts')->where('id', $id)->update(['is_approved' => 0]);
            return redirect()->route('post.index');

        }


}
