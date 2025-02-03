<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorPasswordReset extends Model
{
    protected $table = "instructor_password_resets";
    protected $guarded = ['id'];
    public $timestamps = false;
}
