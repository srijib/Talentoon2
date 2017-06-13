<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use JWTAuth;
use App\Services\CompetitionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CompetitionsController extends Controller {

    public $service;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CompetitionService $service) {
        //use middleware
        $this->service = $service;
    }

    public function index() {

        $data = Competition::orderBy('competition_end_date', 'DESC')->get();
        return response()->json(['status' => 'ok', 'message' => 'Competitions retrieved successfully', 'data' => $data], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $user = JWTAuth::parseToken()->toUser();
        $response = $this->service->createCompetition($user, $request->title, $request->category_id, $request->description, $request->competition_from_level, $request->competition_to_level, $request->competition_start_date, $request->competition_end_date, $request->competition_start_time, $request->competition_end_time);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        try {
            $competitionDetails = Competition::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            //dd(get_class_methods($e)); // lists all available methods for exception object
            //dd($e);
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code, 'SQLmessage' => $SQLmessage]);
        }
        return response()->json(['status' => 'ok', 'message' => 'Competition Found and Retrieved Successfully', 'data' => $competitionDetails]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = JWTAuth::parseToken()->toUser();
        //dd($user);
        try {
            $competitionDetails = Competition::where('mentor_id',$user->id)->findOrFail($id);
            //dd($competitionDetails);

            } catch (ModelNotFoundException $e) {
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code,'SQLmessage'=>$SQLmessage, 'message' =>'You are trying to edit a competition that is not yours']);
        }
        $response = $this->service->updateCompetition($competitionDetails, $request->description, $request->competition_from_level, $request->competition_to_level, $request->competition_start_date, $request->competition_end_date, $request->competition_start_time, $request->competition_end_time);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $user = JWTAuth::parseToken()->toUser();
       try {
            $competitionDetails = Competition::where('mentor_id',$user->id)->findOrFail($id);
            //dd($competitionDetails);
            } catch (ModelNotFoundException $e) {
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code,'SQLmessage'=>$SQLmessage, 'message' =>'You are trying to delete a competition that is not yours']);
        }
        $response = $this->service->deleteCompetition($competitionDetails);
        return $response;

    }

}
