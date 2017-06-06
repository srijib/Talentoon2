<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Services\CompetitionPostPointsService;
use App\Models\CompetitionPost;
use App\Models\Competition;
use App\Models\CompetitionJoin;
use App\Models\CompetitionPostPoints;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CompetitionPostPointsConroller extends Controller {

    private $service;

    public function __construct(CompetitionPostPointsService $service) {
        $this->service = $service;
    }

    public function grantVote($post_id) {
        //holding details of the new post
        $talentPost = CompetitionPost::find($post_id);
        $user = JWTAuth::parseToken()->toUser();
        //check if the user is giving points to himself (incase talent)
        if ($talentPost->talent_id === $user->id) {
            return response()->json(['status' => 0, 'message' => 'You can not add points to yourself']);
        }
        //check if the user has already voted for this talent before (incase talent or audience)
        if (CompetitionPostPoints::where('voter_id', $user->id)->where('competition_post_id', $post_id)->where('is_voted', 1)->first()) {
            return response()->json(['status' => 0, 'message' => 'You can not add points to the same talent twice']);
        }
        //check if the user has already voted for another talent and is voting for a new one under the same competition
        if ($oldVotedPost = CompetitionPostPoints::where('voter_id', $user->id)->where('competition_id', $talentPost->competition_id)->where('is_voted', 1)) {
            //dd('here');
            $response=$this->service->revokeVotePoints($talentPost, $oldVotedPost, $post_id,$user);
            return $response;
        } else {
           $response= $this->service->grantVotePoints($talentPost, $post_id, $user);
           return $response;
        }
    }

}
