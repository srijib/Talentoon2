<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InitialReview extends Model
{
    //
    protected $table = 'initial_reviews';
    protected $fillable =['category_talent_id','category_mentor_id','review_media_id','level_single','comment'];
}
