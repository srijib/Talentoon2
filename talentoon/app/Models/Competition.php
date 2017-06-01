<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
class Competition extends Model
{

    protected $table = 'competitions';
    protected $fillable =['mentor_id','category_id','winner_talent_id','winner_points','competition_level','competition_start_date','competition_start_time','competition_end_date', 'competition_end_time', 'voting_start_date', 'voting_start_time', 'voting_end_date', 'voting_end_time'];
}
