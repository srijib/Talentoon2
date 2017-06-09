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
                ->where('date_from','>=', date('Y-m-d').' 00:00:00')
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
    //by clicking on the event a page is opened to see it's contents
    public function show($cat_id, $event_id){
//        return response()->json(['eventttttttttttttt' => $event_id]);
        $new_event= new EventService();
        $data = $new_event->show_event($cat_id,$event_id);
        return $data;
    }

    public function edit($cat_id,$event_id)
    {
        $user=JWTAuth::parseToken()->toUser();
        $event = DB::table('events')
            ->select('events.*')
            ->where("events.category_id",$cat_id)
            ->where("events.id",$event_id)
            ->get()->first();
        return response()->json($event);


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

        $event=DB::table('events')
            ->where('id', $request->id)
            ->update(['title'=>$request->title,
                'description'=>$request->description,
                'time_from'=>$request->time_from,
                'time_to'=>$request->time_to,
                'date_from'=>$request->date_from,
                'date_to'=>$request->date_to,
                'location'=>$request->location,
                'title'=>$request->title,
                'is_paid'=>$request->is_paid,
                'media_type'=>$request->media_type,
                'media_url'=>$request->media_url
            ]);


        return response()->json($event);
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
        $affectedRows = Event::where('id', '=', $id)
            ->delete();

        if ($affectedRows){
            return response()->json('true');
        }else{
            return response()->json('false');
        }
    }
    public function isEventCreator(Request $request){
        $user=JWTAuth::parsetoken()->toUser();
//        dd($user->id);

        $creator = DB::table('events')
            ->select('events.*')
            ->where("events.user_id",$user->id)
            ->where("users.id",$request->user_id)
            ->get()->first();
        if ($creator){
            return response()->json(['creator'=>1]);
        }else{
            return response()->json(['creator'=>0]);
        }

    }
//***************************************************

}
