<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompetitionPostService;
use App\Models\CompetitionPost;
use App\Models\Competition;
use App\Models\CompetitionJoin;
use JWTAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $data = CompetitionPost::where('competition_id', $competition_id)->get();
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

}
