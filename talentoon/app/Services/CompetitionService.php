<?php

namespace App\Services;

use App\Models\Competition;

class CompetitionService {

    public function createCompetition($user, $title,$category_id, $description, $from_level, $to_level, $start_date, $end_date, $start_time, $end_time) {
        Competition::create([
            'mentor_id' => $user->id,
            'category_id' => $category_id,
            'description' => $description,
            'competition_from_level' => $from_level,
            'competition_to_level' => $to_level,
            'competition_start_date' => $start_date,
            'competition_end_date' => $end_date,
            'competition_start_time' => $start_time,
            'competition_end_time' => $end_time,
            'title'=>$title,
        ]);
        return response()->json(['status' => 'ok', 'message' => 'Competition Created Successfully'], 201);
    }

    public function updateCompetition($competitionDetails, $description, $from_level, $to_level, $start_date, $end_date, $start_time, $end_time) {
        $competitionDetails->update([
            'description' => $description,
            'competition_from_level' => $from_level,
            'competition_to_level' => $to_level,
            'competition_start_date' => $start_date,
            'competition_end_date' => $end_date,
            'competition_start_time' => $start_time,
            'competition_end_time' => $end_time
        ]);
        return response()->json(['status' => 'ok', 'message' => 'Competition Updated Successfully'], 201);
    }

    public function deleteCompetition($competitionDetails) {
        $competitionDetails->delete();
        return response()->json(['status' => 'ok', 'message' => 'Competition Deleted Successfully'], 201);
    }

    public function createCompetitionUnderCategory($user, $category_id, $description, $from_level, $to_level, $start_date, $end_date, $start_time, $end_time) {
        Competition::create([
            'mentor_id' => $user->id,
            'category_id' => $category_id,
            'description' => $description,
            'competition_from_level' => $from_level,
            'competition_to_level' => $to_level,
            'competition_start_date' => $start_date,
            'competition_end_date' => $end_date,
            'competition_start_time' => $start_time,
            'competition_end_time' => $end_time
        ]);
        return response()->json(['status' => 'ok', 'message' => 'Competition Created Successfully under Category ' . $category_id], 201);
    }

    public function updateCompetitionUnderCategory($competitionDetails, $category_id, $title, $description, $from_level, $to_level, $start_date, $end_date, $start_time, $end_time) {
        $competitionDetails->update([
            'title' => $title,
            'description' => $description,
            'competition_from_level' => $from_level,
            'competition_to_level' => $to_level,
            'competition_start_date' => $start_date,
            'competition_end_date' => $end_date,
            'competition_start_time' => $start_time,
            'competition_end_time' => $end_time
        ]);
        return response()->json(['status' => 'ok', 'message' => 'Competition Updated Successfully under the specified Category ' . $category_id], 201);
    }

    public function deleteCompetitionUnderCategory($competitionDetails, $category_id) {
        $competitionDetails->delete();
        return response()->json(['status' => 'ok', 'message' => 'Competition Deleted Successfully under category ' . $category_id], 201);
    }

}
