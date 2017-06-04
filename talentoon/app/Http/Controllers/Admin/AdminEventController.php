<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AdminEventController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth:admin');
     }
    public function index()
    {
        //
        $events= Event::all();
        return view('admin.events.index',['events'=>$events]);
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
        $event=Event::find($id);
        $user=User::find($event->mentor_id);
        $user_name=$user->first_name." ".$user->last_name;
        $category=Category::find($event->category_id);
        $category_name=$category->title;
        return view('admin.events.show',['event'=>$event,'user_name'=>$user_name,'category_name'=>$category_name]);
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
    public function isApprove($id){
            DB::table('events')->where('id', $id)->update(['is_approved' => 1]);

        return redirect()->route('event.index');


    }
        public function unApprove($id){
            DB::table('events')->where('id', $id)->update(['is_approved' => 0]);
            return redirect()->route('event.index');

        }
}
