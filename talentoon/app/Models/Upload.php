<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    //
    protected $fillable = ['src_id', 'filename'];
    public function src()
    {
        return $this->belongsTo('App\Model\Post');
    }
}
