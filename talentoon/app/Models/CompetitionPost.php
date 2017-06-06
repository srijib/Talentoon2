<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionPost extends Model
{
    protected $table = 'competitions_posts';
    protected $fillable =['competition_post_title','competition_post_description','competition_post_media_type','competition_post_media_url','talent_id','competition_id'];
}


