<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkshopSession extends Model
{
    //
    protected $table = 'workshop_session';

    protected $fillable = ['workshop_id','media_url','media_type','title'];
}
