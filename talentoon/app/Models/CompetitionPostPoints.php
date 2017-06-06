<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionPostPoints extends Model
{
    protected $table='competition_post_points';
    protected $fillable=['talent_id','competition_id','competition_post_id','voter_id','points','is_voted'];
}
