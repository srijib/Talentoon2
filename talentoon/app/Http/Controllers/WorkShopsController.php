<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkShop;
use App\Models\WorkshopEnroll;
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
    public function index()
    {
        //
        $data = DB::table('workshops')
            ->join('users', 'users.id', '=', 'workshops.mentor_id')
            ->select('workshops.*','users.first_name as first_name', 'users.last_name as last_name', 'users.image as user_image')
            ->get();
//
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
    public function show($workshop_id){
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

      $workshop = DB::table('workshops')
          ->join('categories', 'workshops.category_id', '=', 'categories.id')
          ->select('workshops.*', 'categories.title as category_title')
          ->where("workshops.id",$workshop_id)
          ->get()->first();

          $capacity=$workshop->max_capacity;
          $countcapacity = DB::table('workshop_enrollment')
          ->join('workshops','workshop_enrollment.workshop_id', '=','workshops.id')
          ->select(DB::raw('count(workshop_enrollment.workshop_id) as workshop_count','workshop_enrollment.workshop_id'))
          ->where([
             ['workshop_enrollment.workshop_id','=',$workshop_id]])
              ->groupBy('workshop_enrollment.workshop_id')
              ->get()->first();
    //           $countcapacity=get_object_vars($countcapacity);
    //           if($countcapacity["workshop_count"]==$capacity){
    //
    //     return response()->json(['enroll'=>0,'user'=>$user,'workshop' => $workshop,'message' => 'workshop sent successfully']);
    //
    //     }else{
    //
    //   return response()->json(['enroll'=>1,'user'=>$user,'workshop' => $workshop,'message' => 'workshop sent successfully']);
    //     }
    //
    //
    // }
    if(is_null($countcapacity)){
        return response()->json(['enroll'=>1,'user'=>$user,'workshop' => $workshop,'message' => 'workshop sent successfully']);

    }else{
    $countcapacity=get_object_vars($countcapacity);
    if($countcapacity["workshop_count"]==$capacity){

return response()->json(['enroll'=>0,'workshop' => $workshop,'user'=>$user,'message' => 'workshop sent successfully']);

}else{

return response()->json(['enroll'=>1,'workshop' => $workshop,'user'=>$user,'message' => 'workshop sent successfully']);
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
}
