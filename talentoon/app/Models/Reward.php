<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
    protected $table = 'rewards';
    protected $fillable = [
        'created_at', 'updated_at', 'first_place_competition_reward', 'second_place_competition_reward`, `third_place_competition_reward', 'first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighths', 'ninth', 'tenth'
    ];
    
    
}
