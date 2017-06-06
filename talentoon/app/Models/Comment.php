<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{


    protected $table = 'comments';

    protected $fillable =['comment','user_id','post_id'];


}
