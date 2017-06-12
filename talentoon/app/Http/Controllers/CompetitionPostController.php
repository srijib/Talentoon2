<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompetitionPostService;
use App\Models\CompetitionPost;
use App\Models\Competition;
use App\Models\CompetitionJoin;
use DB;
use JWTAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\CompetitionPostPointsController;
use App\Services\CompetitionPostPointsService;
class CompetitionPostController extends Controller {


    private $service;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CompetitionPostService $service) {
        $this->service = $service;
    }

    public function index($competition_id) {

        $user = JWTAuth::parseToken()->toUser();

        $data= DB::table('competitions_posts')

            ->join('users', 'users.id', '=', 'competitions_posts.talent_id')

            // ->leftjoin('competition_post_points', 'competition_post_points.competition_post_id', '=', 'competitions_posts.id')
            ->leftJoin('competition_post_points', function($join)
                  {
                      $join->on('competition_post_points.competition_post_id','=','competitions_posts.id')
                      ->where('competition_post_points.is_voted', '=', '1');

                  })
            ->selectRaw('competitions_posts.id,competitions_posts.*,count(competition_post_points.id) as votes_count,users.first_name, users.last_name, users.image as user_image,competition_post_points.is_voted,count(competition_post_points.id) as votes_count')
            ->where('competitions_posts.competition_id','=',$competition_id)
            ->groupBy('competitions_posts.id')

            ->get();


//        $data= DB::table('competitions_posts')
//            ->join('users', 'users.id', '=', 'competitions_posts.talent_id')
//            ->leftjoin('competition_post_points', 'competition_post_points.competition_post_id', '=', 'competitions_posts.id')
//            ->select('competitions_posts.*','users.first_name', 'users.last_name', 'users.image as user_image','competition_post_points.is_voted')
//            ->where('competitions_posts.competition_id','=',$competition_id)
//            ->get();


        // $data = CompetitionPost::where('competition_id', $competition_id)->get();
        return response()->json(['status' => 'ok', 'message' => 'Posts under competition ' . $competition_id . ' retrieved successfully', 'data' => $data], 201);
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
    public function store(Request $request, $competition_id) {
        try {
            $competition = Competition::findOrFail($competition_id)->first();
                                $user = JWTAuth::parseToken()->toUser();
            $joinedTalent = CompetitionJoin::where('talent_id', $user->id)->where('competition_id', $competition_id)->first();
            if (!$joinedTalent) {
                return response()->json(['status' => 'wrong', 'message' => 'You need to Join competition first']);
            } else {
                if ($competition) {
                    $postfound = CompetitionPost::where('talent_id', $user->id)->where('competition_id', $competition_id)->first();
                    //dd($postfound);
                    if ($postfound) {
                        return response()->json(['status' => 'wrong', 'message' => 'Talent ' . $user->id . ' already has an uploaded post under competition ' . $competition_id]);
                    } else {
                        $joinedTalent = CompetitionJoin::where('talent_id', $user->id)->where('competition_id', $competition_id);
                        $response = $this->service->createPost($joinedTalent, $user, $competition_id, $request->competition_post_title, $request->competition_post_description, $request->competition_post_media_type, $request->competition_post_media_url);
                        return $response;
                    }
                }
            }
        } catch (ModelNotFoundException $e) {
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code, 'SQLmessage' => $SQLmessage, 'message' => 'No competition with id ' . $competition_id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($competition_id, $post_id) {
        try {
            $postDetails = CompetitionPost::where('competition_id', $competition_id)->findOrFail($post_id);
        } catch (ModelNotFoundException $e) {
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code, 'SQLmessage' => $SQLmessage, 'message' => 'No post Found Under the Specified Competition']);
        }
        return response()->json(['status' => 'ok', 'message' => 'post found under competition ' . $competition_id . ' and Retrieved Successfully', 'data' => $postDetails]);
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
    public function update(Request $request, $competition_id, $post_id) {
        $user = JWTAuth::parseToken()->toUser();
        //dd($user);
        try {
            $postDetails = CompetitionPost::where('talent_id', $user->id)->where('competition_id', $competition_id)->findOrFail($post_id);
            //dd($competitionDetails);
        } catch (ModelNotFoundException $e) {
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code, 'SQLmessage' => $SQLmessage, 'message' => 'You are trying to edit post ' . $post_id . ' that is not yours under Competition ' . $competition_id]);
        }
        $response = $this->service->updatePost($postDetails, $competition_id, $request->competition_post_title, $request->competition_post_description, $request->competition_post_media_type, $request->competition_post_media_url);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($competition_id, $post_id) {
        $user = JWTAuth::parseToken()->toUser();
        try {
            $postDetails = CompetitionPost::where('talent_id', $user->id)->where('competition_id', $competition_id)->findOrFail($post_id);
            //dd($competitionDetails);
        } catch (ModelNotFoundException $e) {
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code, 'SQLmessage' => $SQLmessage, 'message' => 'You are trying to delete post ' . $post_id . ' that is not yours under competition ' . $competition_id]);
        }
        $response = $this->service->deletePost($postDetails, $competition_id);
        return $response;
    }
    public function check(){
        $date_check=DB::table('competitions')
            ->join('competition_post_points','competition_post_points.competition_id','competitions.id')
            ->select('competitions.id','competitions.competition_end_date')
            ->where('competition_end_date','<',date('Y-m-d').' 00:00:00' )
            ->get();
//        dd($date_check);

        $array_comps=array();
        foreach ($date_check as $data){
            $num_days = floor((strtotime("now")-strtotime($data->competition_end_date))/(60*60*24));
            if ($num_days >= 1){
                $service =new CompetitionPostPointsService();
                $calculations=new CompetitionPostPointsController($service);
                //we have 50% votes and 50%
                $CompetitiorMentorPoints=$calculations->getCompetitiorMentorPoints($data->id);
                $CompetitiorAudiencePoints=$calculations->getCompetitiorAudiencePoints($data->id);
                //calculates the total points for each competitor in the competition
                $FinalCompetitionPoints=$calculations->getFinalCompetitionPoints($data->id);
                //sends back the total and the talent_ids
                $FinalCompetitionWinners=$calculations->getFinalCompetitionWinners($data->id);

                array_push($array_comps,$data->id);
            }


        }
        return response()->json([
            'CompetitiorMentorPoints'=>$CompetitiorMentorPoints,
            'CompetitiorAudiencePoints'=>$CompetitiorAudiencePoints,
            'FinalCompetitionPoints'=>$FinalCompetitionPoints,
            'FinalCompetitionWinners'=>$FinalCompetitionWinners,
            'el array'=>$array_comps
        ]);

    }

}
