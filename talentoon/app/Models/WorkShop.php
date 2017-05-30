<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkShop extends Model
{
    //
    protected $table = 'workshops';

    protected $fillable = [
        'category_id', 'mentor_id', 'time_from','time_to','date_to','date_from','max_capacity','level','is_approved','name',
        'description','media_url','media_type'];
}
