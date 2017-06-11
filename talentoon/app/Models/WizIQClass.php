<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WizIQClass extends Model
{
    //
    protected $table = 'video_conference_class';

    protected $fillable = [
        'wiziq_class_id','wiziq_recording_url','wiziq_class_start_time','wiziq_class_duration','wiziq_class_attendee_limit', 'wiziq_presenter_url', 'wiziq_teacher_email','wiziq_teacher_id'];
}
