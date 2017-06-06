<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompetitionJoinService;
use JWTAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Competition;
use App\Models\CompetitionJoin;

class CompetitionJoinController extends Controller {

    private $service;

    public function __construct(CompetitionJoinService $service) {
        $this->service = $service;
    }

    public function joinCompetition($competition_id) {
        try {
            Competition::findOrFail($competition_id);
            $user = JWTAuth::parseToken()->toUser();
            $joinedTalent = CompetitionJoin::where('talent_id', $user->id)->where('competition_id', $competition_id)->first();
            if ($joinedTalent) {
                return response()->json(['status' => 'wrong', 'message' => 'Talent already joined this competition']);
            } else {
                $response = $this->service->joinCompetition($user, $competition_id);
                return $response;
            }
        } catch (ModelNotFoundException $e) {
            $code = $e->getCode();
            $SQLmessage = $e->getMessage();
            return response()->json(['code' => $code, 'SQLmessage' => $SQLmessage, 'message' => 'No competition with id ' . $competition_id]);
        }
    }

}
