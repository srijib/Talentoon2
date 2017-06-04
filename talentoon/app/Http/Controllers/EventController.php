<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EventService;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use DB;
use JWTAuth;

class EventController extends Controller
{
public function __construct(){
    $this->middleware(['ability:mentor,create-event,true','checkmentorauthority'])->only('store');
}

    public function index(){

//            $user->id;
            $data = DB::table('events')
                ->join('users', 'users.id', '=', 'events.mentor_id')
                ->select('events.*','users.first_name as first_name', 'users.last_name as last_name', 'users.image as user_image')
                ->where('events.is_approved','=',1)
                ->get();

        return response()->json(['data'=>$data]);
    }
    //store the created events
    public function store(Request $request)
    {
        $user= JWTAuth::parseToken()->toUser();
        //return $user;
        $new_event= new EventService();
        $event=$request->all();
        $data = $new_event->add_event($event,$user->id);
//        return response()->json(['data' => $data,'status' => '1','message' => 'data sent successfully']);
        return response()->json(['data'=>$data]);
    }
    //to give the creator the avaliblity to update in event's data
    //it is'nt found in back log
    public function edit(Request $request){

    }
    //by clicking on the event a page is opened to see it's contents
    public function show($cat_id, $event_id){
        return response()->json(['eventttttttttttttt' => $event_id]);
        $new_event= new EventService();
        $data = $new_event->show_event($event_id);
        return $data;
    }

}
