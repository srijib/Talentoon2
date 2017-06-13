<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use DB;
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
        $data = Competition::where('category_id', $id)->orderBy('competition_end_date', 'DESC')->get();
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
    public function store(Request $request) {
//        return response()->json($request);
        $user = JWTAuth::parseToken()->toUser();
        $response = $this->service->createCompetitionUnderCategory($user, $request->category_id, $request->description, $request->competition_from_level, $request->competition_to_level, $request->date_to, $request->date_from, $request->time_from, $request->time_to);
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
            // $competitionDetails = Competition::where('category_id', $category_id)->findOrFail($competition_id);
            $user = JWTAuth::parseToken()->toUser();
            $competitionDetails = DB::table('competitions')
                ->join('users', 'users.id', '=', 'competitions.mentor_id')
                ->select('competitions.*','users.first_name', 'users.last_name', 'users.image as mentor_image')
                ->where([['competitions.id','=',$competition_id],['competitions.category_id','=',$category_id]])
                ->get();
            $is_joined =  DB::table('competition_join')
                ->select('joined')
                ->where([['competition_id','=',$competition_id],['talent_id','=',$user->id]])
                ->first();

                $talent=DB::table('category_talents')
                ->join('users', 'users.id', '=', 'category_talents.talent_id')
                ->select('category_talents.talent_id')
                ->where([['category_talents.category_id','=',$category_id],['category_talents.talent_id','=',$user->id]])
                ->distinct()
                ->get()->first();
        } catch (ModelNotFoundException $e) {
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code, 'SQLmessage' => $SQLmessage, 'message' => 'No Competition Found Under the Specified Category']);
        }
        return response()->json(['talent'=>$talent,'status' => 'ok', 'message' => 'Competition Found under Category ' . $category_id . ' and Retrieved Successfully', 'data' => $competitionDetails,'is_joined'=>$is_joined]);
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
