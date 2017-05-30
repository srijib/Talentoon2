<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{


    protected $table = 'comments';

    protected $fillable =['text','commentable_id','commentable_type','id','user_id'];


}



