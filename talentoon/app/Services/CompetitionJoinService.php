<?php

namespace App\Services;

use App\Models\CompetitionJoin;


class CompetitionJoinService{

         public function joinCompetition($user, $competition_id) {
        CompetitionJoin::create([
         'talent_id'=>$user->id,
         'competition_id'=>$competition_id,
         'joined'=>0
        ]);
        return response()->json(['status'=>'ok','message'=>'Talent '.$user->id.' joined competition '.$competition_id.' successfully'],201);
    }

}
