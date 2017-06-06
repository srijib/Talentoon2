<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionJoin extends Model
{
    protected $table = 'competition_join';
    protected $fillable =['talent_id','competition_id','joined'];
}

