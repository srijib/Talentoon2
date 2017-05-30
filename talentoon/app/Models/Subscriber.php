<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    //
    protected $table = 'subscribers';
    protected $fillable =['subscriber_id','category_id','subscribed'];
}
