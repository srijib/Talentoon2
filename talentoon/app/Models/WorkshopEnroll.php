<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkshopEnroll extends Model
{
    //
    protected $table = 'workshop_enrollment';

    protected $fillable = ['user_id', 'workshop_id'];
}
