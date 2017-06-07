<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class finalCompetitionPoints extends Model
{
    protected $table = 'final_competition_points';

    protected $fillable = ['talent_id','competition_id','competition_post_id','audienceSumOfPoints','mentorsSumOfPoints','audienceAverageOfPoints','mentorsAverageOfPoints','total'];
}
