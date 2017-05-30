<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryTalent extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
    'talent_id','category_id','status','level','from_when','description'
    ];
    
    
}
