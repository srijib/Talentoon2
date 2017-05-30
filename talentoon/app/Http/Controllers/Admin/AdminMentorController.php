<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryMentor;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;
use Auth;
use App\Models\Role;



class AdminMentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        // $mentors= CategoryMentor::all();

        $mentors = DB::table('category_mentors')
            ->join('users', 'users.id', '=', 'category_mentors.mentor_id')
            ->join('categories', 'categories.id', '=', 'category_mentors.category_id')
            ->select('users.*', 'category_mentors.*','categories.*')
            ->get();

        return view('admin.mentors.index',['mentors'=>$mentors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function be_mentor($id){
            //dd($id);
            DB::table('category_mentors')->where('mentor_id', $id)->update(['status' => 1]);
             
            $role = Role::where('name', '=','mentor')->get()->first();
            //dd($role);
            $userId = DB::table('category_mentors')
            ->join('users', 'users.id', '=', 'category_mentors.mentor_id')
            ->where('category_mentors.mentor_id',$id)
            ->select('users.id')
            ->first();
            //dd($userId);
            $user=User::find($userId->id);
            //dd($user);
             $user->attachRole($role);
   
           return redirect()->route('mentor.index');


    }
        public function unmentor($id){
            DB::table('category_mentors')->where('mentor_id', $id)->update(['status' => 0]);
            return redirect()->route('mentor.index');

        }
}
