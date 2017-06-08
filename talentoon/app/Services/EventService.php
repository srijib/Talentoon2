<?php

namespace App\Services;

use App\Models\Event;
use App\Http\Requests;
use DB;


class EventService
{
    public function add_event($request,$mentor_id){
//        dd($request);
        //dd($mentor_id);

        try {

            $A=Event::create(array(
                'title' => $request['title'],
                'category_id' => $request['category_id'],
                'time_from' => $request['time_from'],
                'time_to' => $request['time_to'],
                'date_from' => $request['date_from'],
                'date_to' => $request['date_to'],
                'location' => $request['location'],
                'description' => $request['description'],
//            'is_approved' => $request['is_approved'],
                'mentor_id' => $mentor_id,
                'is_paid' => $request['is_paid'],
                'category_id' => $request['category_id'],
//            'media_url' => $request['media_url'],
//            'media_type' => $request['media_type']
            ))->id;

            //code causing exception to be thrown

            return response()->json(["id"=>$A,"msg" => "done","status" => "1"]);

        } catch(Exception $e) {
            //exception handling
            return response()->json(["id"=>$A,"msg" => "done","status" => "0","exception" => $e]);
        }






    }public function show_event($cat_id,$id){

        $event = DB::table('events')
            ->join('categories', 'events.category_id', '=', 'categories.id')
            ->join('users', 'events.mentor_id', '=', 'users.id')
            ->select('categories.title as category_title', 'users.first_name', 'users.last_name', 'users.image','events.*')
            ->where("events.id",$id)
            ->get();
        return response()->json(['event' => $event,'status' => '1','message' => 'data sent successfully']);


    }

}
