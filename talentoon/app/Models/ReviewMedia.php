<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewMedia extends Model
{
    //
    protected $table = 'review_media';
    protected $fillable =['category_talent_id','review_media_type','review_media_url'];
}
