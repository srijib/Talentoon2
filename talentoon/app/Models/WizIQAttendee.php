<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WizIQAttendee extends Model
{
    //
    protected $table = 'video_conference_attendee';

    protected $fillable = [
        'class_id','wiziq_attendee_id', 'wiziq_attendee_url'];
}
