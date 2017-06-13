<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
class Event extends Model
{
//    use SoftDeletes;
    protected $table = 'events';
    protected $fillable =['title','time_from','time_to','date_from','date_to','location','description','is_approved','category_id','mentor_id'];
}
