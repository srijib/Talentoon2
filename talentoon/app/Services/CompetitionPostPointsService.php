<?php

namespace App\Services;

use App\Models\CompetitionPostPoints;

class CompetitionPostPointsService {

    public function grantVotePoints($talentPost, $post_id, $user) {
        CompetitionPostPoints::create([
            'talent_id' => $talentPost->talent_id,
            'competition_id' => $talentPost->competition_id,
            'competition_post_id' => $post_id,
            'voter_id' => $user->id,
            'points' => 2
        ]);
        return response()->json(['status' => 1, 'message' => 'points added successfully']);
    }

    public function revokeVotePoints($talentPost, $oldVotedPost, $post_id, $user) {
        $oldVotedPost->update([
            'points' => 0,
            'is_voted' => 0
        ]);
        if ($hesitantPost = CompetitionPostPoints::where('voter_id', $user->id)->where('competition_id', $talentPost->competition_id)->where('is_voted', 0)->where('competition_post_id',$post_id)->first()) {
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
        return response()->json(['status' => 1, 'message' => 'points revoked from old post and added successfully to new post']);
    }

}
