<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

use App\Models\Competition;

use App\Services\CompetitionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryCompetitionController extends Controller {

    public $service;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CompetitionService $service) {
        $this->service = $service;
    }

    public function index($id) {
        $data = Competition::where('category_id', $id)->get();
        //join users (retrieve first name+lastname+image /return competitions*) + add image column to the compeition
        return response()->json(['status' => 'ok', 'message' => 'Competitions under category ' . $id . ' retrieved successfully', 'data' => $data], 201);
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
    public function store(Request $request, $category_id) {
        $user = JWTAuth::parseToken()->toUser();
        $response = $this->service->createCompetitionUnderCategory($user, $category_id, $request->description, $request->competition_from_level, $request->competition_to_level, $request->competition_start_date, $request->competition_end_date, $request->competition_start_time, $request->competition_end_time);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category_id, $competition_id) {
        try {
            $competitionDetails = Competition::where('category_id', $category_id)->findOrFail($competition_id);
        } catch (ModelNotFoundException $e) {
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code, 'SQLmessage' => $SQLmessage, 'message' => 'No Competition Found Under the Specified Category']);
        }
        return response()->json(['status' => 'ok', 'message' => 'Competition Found under Category ' . $category_id . ' and Retrieved Successfully', 'data' => $competitionDetails]);
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
    public function update(Request $request, $category_id, $competition_id) {
        $user = JWTAuth::parseToken()->toUser();
        //dd($user);
        try {
            $competitionDetails = Competition::where('mentor_id', $user->id)->where('category_id', $category_id)->findOrFail($competition_id);
            //dd($competitionDetails);
        } catch (ModelNotFoundException $e) {
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code, 'SQLmessage' => $SQLmessage, 'message' => 'You are trying to edit Competition ' . $competition_id . ' that is not yours under Category ' . $category_id]);
        }
        $response = $this->service->updateCompetitionUnderCategory($competitionDetails, $category_id, $request->description, $request->competition_from_level, $request->competition_to_level, $request->competition_start_date, $request->competition_end_date, $request->competition_start_time, $request->competition_end_time);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id, $competition_id) {
        $user = JWTAuth::parseToken()->toUser();
        try {
            $competitionDetails = Competition::where('mentor_id', $user->id)->where('category_id', $category_id)->findOrFail($competition_id);
            //dd($competitionDetails);       
        } catch (ModelNotFoundException $e) {
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code, 'SQLmessage' => $SQLmessage, 'message' => 'You are trying to delete Competition ' . $competition_id . ' that is not yours under Category ' . $category_id]);
        }
        $response = $this->service->deleteCompetitionUnderCategory($competitionDetails, $category_id);
        return $response;
    }

}
