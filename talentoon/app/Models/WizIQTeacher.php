<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WizIQTeacher extends Model
{
    //
    protected $table = 'video_conference_teacher';

    protected $fillable = [
        'wiziq_teacher_name', 'wiziq_teacher_email','wiziq_teacher_password'];
}
