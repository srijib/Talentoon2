<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CategoryMentor extends Model
{
    use SoftDeletes;

    protected $fillable = [
    'mentor_id','category_id','status','experience','years_of_experience'
    ];

}
