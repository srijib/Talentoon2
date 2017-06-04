<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorReviews extends Model
{
    //
    protected $table = 'mentor_reviews';
    protected $fillable =['mentor_id','post_id','points','comment'];
}
