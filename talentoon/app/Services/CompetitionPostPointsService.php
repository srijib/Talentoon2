<?php

namespace App\Services;

use App\Models\Competition;
use App\Models\CompetitionPostPoints;
use App\Models\finalCompetitionPoints;
use DB;

class CompetitionPostPointsService {

    public function grantVotePoints($talentPost, $post_id, $user) {
        CompetitionPostPoints::create([
            'talent_id' => $talentPost->talent_id,
            'competition_id' => $talentPost->competition_id,
            'competition_post_id' => $post_id,
            'voter_id' => $user->id,
            'points' => 2
        ]);

        $new_count_votes = DB::table('competition_post_points')
        ->selectRaw('count(id)as count_vote,id')
        ->where([["competition_post_id",$post_id],['is_voted','=',1]])
          ->groupBy('id')
          ->get();
        return response()->json(['status' => 1, 'message' => 'points added successfully','new_votes_count'=>$new_count_votes]);
    }

    public function revokeVotePoints($talentPost, $oldVotedPost, $post_id, $user) {
        $oldVotedPost->update([
            'points' => 0,
            'is_voted' => 0
        ]);
        if ($hesitantPost = CompetitionPostPoints::where('voter_id', $user->id)->where('competition_id', $talentPost->competition_id)->where('is_voted', 0)->where('competition_post_id', $post_id)->first()) {
            $hesitantPost->update([
                'points' => 2,
                'is_voted' => 1
            ]);
        } else {
            CompetitionPostPoints::create([
                'talent_id' => $talentPost->talent_id,
                'competition_id' => $talentPost->competition_id,
                'competition_post_id' => $post_id,
                'voter_id' => $user->id,
                'points' => 2
            ]);
        }

        $new_count_votes = DB::table('competition_post_points')
        ->selectRaw('count(id)as count_vote,id')
        ->where([["competition_post_id",$post_id],['is_voted','=',1]])
          ->groupBy('id')
          ->get();
        return response()->json(['status' => 1, 'message' => 'points revoked from old post and added successfully to new post','new_votes_count'=>$new_count_votes]);
    }

//should be called when competition ends
//------------------------------------------
// select competition_post_id as post_id, talent_id, competition_id ,SUM(competition_post_points.points) as sum
//from competition_post_points
//inner join users on users.id = competition_post_points.voter_id
//inner join role_user on role_user.user_id = users.id
//where competition_id =1 and competition_post_points.voter_id IN (role_user.user_id) and role_user.role_id <> 3
//group by competition_post_id,talent_id;

    public function calculateCompetitiorAudiencePoints($competition_id) {
//        $data = DB::table('competition_post_points')
//                ->where('competition_id', $competition_id)
//                ->groupBy('competition_post_id', 'talent_id')
//                ->select('talent_id', 'competition_post_id', 'competition_id', DB::raw('sum(points) as sum'))
//                ->get();
        $data = DB::table('competition_post_points')
                ->join('users', 'users.id', '=', 'competition_post_points.voter_id')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->where('competition_id', $competition_id)
                ->whereRaw('competition_post_points.voter_id IN (role_user.user_id) and role_user.role_id <> 3')
                ->groupBy('competition_post_id', 'talent_id')
                ->select('talent_id', 'competition_post_id', 'competition_id', DB::raw('sum(points) as sum'))
                ->get();
//        dd($data);

        foreach ($data as $datum) {
            // dd( $datum->competition_post_id);
            $audienceAverageOfPoints = $datum->sum * 0.50;
            //dd($audienceAverageOfPoints);
            //$talentRecord = finalCompetitionPoints::where('competition_id', $competition_id)->where('talent_id',$datum->talent_id)->get();
            //dd($talentRecord);
            if ($talentRecord = finalCompetitionPoints::where('competition_id', $competition_id)->where('talent_id', $datum->talent_id)->first()) {
                //dd('here');
                $talentRecord->update([
                    'audienceSumOfPoints' => $datum->sum,
                    'audienceAverageOfPoints' => $audienceAverageOfPoints
                ]);
                $message = 'Audience or Talent Votes Calculated Successfuly and updated in final_competition_points table';
            } else {
                //dd('create');
                finalCompetitionPoints::create([
                    'talent_id' => $datum->talent_id,
                    'competition_id' => $datum->competition_id,
                    'competition_post_id' => $datum->competition_post_id,
                    'audienceSumOfPoints' => $datum->sum,
                    'audienceAverageOfPoints' => $audienceAverageOfPoints
                ]);
                $message = 'Audience or Talent Votes Calculated Successfuly and inserted in final_competition_points table';
            }
        }

        return response()->json(['status' => 1]);
    }

    public function addMentorPoints($talentPost, $post_id, $user, $points) {
        CompetitionPostPoints::create([
            'talent_id' => $talentPost->talent_id,
            'competition_id' => $talentPost->competition_id,
            'competition_post_id' => $post_id,
            'voter_id' => $user->id,
            'points' => $points
        ]);
        return response()->json(['status' => 1, 'message' => 'mentor points added successfully']);
    }

    public function updateMentorPoints($foundTalentPost, $points) {
        $foundTalentPost->update([
            'points' => $points
        ]);
        return response()->json(['status' => 1, 'message' => 'mentor points updated successfully']);
    }

    //should be called when the competition ends
    public function calculateCompetitiorMentorPoints($competition_id) {
        $data = DB::table('competition_post_points')
                ->join('users', 'users.id', '=', 'competition_post_points.voter_id')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->where('competition_id', $competition_id)
                //->where('competition_post_points.voter_id','in',('role_user.user_id'))
                //->where('role_user.role_id','=',3)
                ->whereRaw('competition_post_points.voter_id IN (role_user.user_id) and role_user.role_id = 3')
                ->groupBy('competition_post_id', 'talent_id')
                ->select('talent_id', 'competition_post_id', 'competition_id', DB::raw('sum(points) as sum'))
                ->get();

//        dd($data);
        foreach ($data as $datum) {
            // dd( $datum->competition_post_id);
            $mentorAverageOfPoints = $datum->sum * 0.50;
            //dd($audienceAverageOfPoints);
            if ($talentRecord = finalCompetitionPoints::where('competition_id', $competition_id)->where('talent_id', $datum->talent_id)->first()) {
//                dd('here');
                $talentRecord->update([
                    'mentorsSumOfPoints' => $datum->sum,
                    'mentorsAverageOfPoints' => $mentorAverageOfPoints
                ]);
                $message = 'Mentor Points Calculated Successfuly and updated in final_competition_points table';
            } else {
                finalCompetitionPoints::create([
                    'talent_id' => $datum->talent_id,
                    'competition_id' => $datum->competition_id,
                    'competition_post_id' => $datum->competition_post_id,
                    'mentorsSumOfPoints' => $datum->sum,
                    'mentorsAverageOfPoints' => $mentorAverageOfPoints
                ]);
                $message = 'Mentor Points Calculated Successfuly and inserted in final_competition_points table';
            }
        }

        return response()->json(['status' => 1]);
    }

    //should be called after calculateCompetitorAudiencePoints and calculateCompetitorMentorPoints
    public function calculateFinalCompetitionPoints($competition_id) {
        $audience_and_mentor_points = DB::table('final_competition_points')
                ->where('competition_id', $competition_id)
                ->select('talent_id', 'competition_id', 'competition_post_id', 'audienceAverageOfPoints', 'mentorsAverageOfPoints', 'total')
                ->get();
        //dd($audience_and_mentor_points);
        foreach ($audience_and_mentor_points as $value) {
            $total = $value->audienceAverageOfPoints + $value->mentorsAverageOfPoints;
            $value->total = $total;
            //dd($value->total);
            $competitorRecord = finalCompetitionPoints::where('competition_id', $competition_id)->where('talent_id', $value->talent_id)->first();
            $competitorRecord->update([
                'total' => $value->total
            ]);
        }
        return response()->json(['status' => 1, 'message' => 'Final Points Calculated Successfully']);
    }

    public function determineFinalCompetitionWinners($competition_id) {
        $competitorsRecords = DB::table('final_competition_points')
                ->where('competition_id', $competition_id)
                ->orderBy('total', 'desc')
                ->limit(3)
                ->select('talent_id', 'total')
                ->get();
        //dd($competitorsRecords.length);
        $competitorsArray = array();
        foreach ($competitorsRecords as $competitorRecord) {
            array_push($competitorsArray, $competitorRecord);
        }
//        dd($competitorsArray[0]);
        $competition = Competition::where('id', $competition_id);
//        dd($competition)
        $competition->update([
            'first_winner_talent_id' => $competitorsArray[0]->talent_id,
            'second_winner_talent_id'=>$competitorsArray[1]->talent_id,
            'third_winner_talent_id'=>$competitorsArray[2]->talent_id
        ]);
        return response()->json(['status'=>1,'message'=>'Winners added successfully','winners'=>$competitorsRecords]);
    }

}
