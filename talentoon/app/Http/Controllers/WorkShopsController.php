<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkShop;
use App\Models\WorkshopEnroll;
use App\Models\WorkshopSession;
use DB;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class WorkShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
     $this->middleware(['ability:mentor,create-workshop,true','checkmentorauthority'])->only('store');
    }
    public function index()
    {
        //
        $data = DB::table('workshops')
            ->join('users', 'users.id', '=', 'workshops.mentor_id')
            ->select('workshops.*','users.first_name as first_name', 'users.last_name as last_name', 'users.image as user_image')
//            -where(['workshops.is_approved','=',1])
            ->where('workshops.date_to','>=', date('Y-m-d').' 00:00:00')
            ->get();
//        dd($data);
        return response()->json(['msg1'=>$data]);

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
//        return response()->json(['req'=>$request]);
        $id=WorkShop::create($request->all())->id;

        return response()->json(['workshop_id'=>$id,'message' => 'data saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_old($cat_id,$workshop_id)
    {
        //
        $workshop = DB::table('workshops')
            ->join('categories', 'workshops.category_id', '=', 'categories.id')
            ->join('users', 'workshops.mentor_id', '=', 'users.id')
            ->select('workshops.*', 'categories.title as category_title', 'users.first_name', 'users.last_name')
            ->where("workshops.id",$workshop_id)
            ->get();

        return response()->json(['post' => $workshop,'status' => '1','message' => 'data sent successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cat_id,$workshop_id)
    {   //I need to take category id and workshop id and
        // by checking the mentor_id is the user id then edit else not
        //from Request $request we will git the editable data
        $user=JWTAuth::parseToken()->toUser();
        $workshop = DB::table('workshops')
            ->select('workshops.*')
            ->where("workshops.category_id",$cat_id)
            ->where("workshops.id",$workshop_id)
            ->get()->first();
        return response()->json($workshop);


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

        $workshop=DB::table('workshops')
                ->where('id', $request->id)
                ->update(['name'=>$request->name,
                'description'=>$request->description,
                'time_from'=>$request->time_from,
                'time_to'=>$request->time_to,
                'date_from'=>$request->date_from,
                'date_to'=>$request->date_to,
                'level'=>$request->level,
                'max_capacity'=>$request->max_capacity,
                'media_type'=>$request->media_type,
                'media_url'=>$request->media_url
                ]);


        return response()->json($workshop);
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
        $affectedRows = WorkShop::where('id', '=', $id)
            ->delete();

        if ($affectedRows){
            return response()->json('true');
        }else{
            return response()->json('false');
        }
    }
    public function isWorkshopCraetor(Request $request){
        $user=JWTAuth::parsetoken()->toUser();
//        dd($user->id);
//        dd($request->workshop_id);
        $creator = DB::table('workshops')
            ->select('workshops.*')
            ->where("workshops.mentor_id",$user->id)
            ->where("workshops.id",$request->workshop_id)
            ->get()->first();
        if ($creator){
            return response()->json(['creator'=>1]);
        }else{
            return response()->json(['creator'=>0]);
        }

    }
    public function show($category_id,$workshop_id){
//        return response()->json(['creator'=>$workshop_id]);
        try {
            //dd($request->all());
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

        $session=DB::table('workshop_session')
            ->join('workshop_enrollment','workshop_enrollment.workshop_id','=','workshop_session.workshop_id')

            ->where([["workshop_session.workshop_id",$workshop_id],['workshop_enrollment.workshop_id','=',$workshop_id],['workshop_enrollment.user_id','=',$user->id]])
            ->get();

      $workshop = DB::table('workshops')
          ->join('categories', 'workshops.category_id', '=', 'categories.id')
          ->join('users', 'users.id', '=', 'workshops.mentor_id')
          ->select('workshops.*', 'categories.title as category_title','users.first_name as first_name','users.last_name as last_name','users.first_name as first_name','users.image as image')
          ->where([["workshops.id",$workshop_id],['workshops.is_approved','=',1]])
          ->get()->first();

          $capacity=$workshop->max_capacity;
          $countcapacity = DB::table('workshop_enrollment')
          ->join('workshops','workshop_enrollment.workshop_id', '=','workshops.id')
          ->select(DB::raw('count(workshop_enrollment.workshop_id) as workshop_count','workshop_enrollment.workshop_id'))
          ->where([
             ['workshop_enrollment.workshop_id','=',$workshop_id]])
              ->groupBy('workshop_enrollment.workshop_id')
                  ->get()->first();


        if(is_null($countcapacity)){

            return response()->json(['session'=>$session,'enroll'=>1,'user'=>$user,'workshop' => $workshop,'message' => 'workshop sent successfully']);

        }else{
        $countcapacity=get_object_vars($countcapacity);
        if($countcapacity["workshop_count"]==$capacity){

            return response()->json(['session'=>$session,'enroll'=>0,'workshop' => $workshop,'user'=>$user,'message' => 'workshop sent successfully']);

            }else{

            return response()->json(['session'=>$session,'enroll'=>1,'workshop' => $workshop,'user'=>$user,'message' => 'workshop sent successfully']);
            }

    }
}
    public function enroll(Request $request){

        $enroll = DB::table('workshop_enrollment')
        ->where('user_id', '=', $request->user_id)
        ->where('workshop_id', '=', $request->workshop_id)
        ->first();

        if (is_null($enroll)) {
        WorkshopEnroll::create($request->all());
        return response()->json(['message' => 'data saved successfully']);

        }else{
        return response()->json(['message' => 'you already enroll in this workshop ']);

        }
    }
    public function createSession(Request $request)
    {
    //
    $id=WorkshopSession::create($request->all())->id;
    return response()->json(['workshop_id'=>$id,'message' => 'data saved successfully']);
    }

}
