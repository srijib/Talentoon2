<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
class Competition extends Model
{

    protected $table = 'competitions';
    protected $fillable =['mentor_id','category_id','description','points_description','competition_from_level','competition_to_level','competition_start_date','competition_start_time','competition_end_date', 'competition_end_time','first_winner_talent_id','second_winner_talent_id','third_winner_talent_id'];
}
