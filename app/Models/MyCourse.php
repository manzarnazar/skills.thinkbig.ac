<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MyCourse extends Model
{
    use HasFactory;

    protected $casts = [
        'tags' => 'object',
        'zoom_data' => 'object'
    ];

    function scopeInstructorOwner($query){

       return $query->where('owner_id',auth('instructor')->id())->where('owner_type',2);
    }

    function scopeAdminOwner($query){
       return $query->where('owner_id',auth('admin')->id())->where('owner_type',1);
    }

    function category() {
        return $this->belongsTo(Category::class);
    }
    function course_category() {
        return $this->belongsTo(CourseCategory::class,'course_id');
    }

    function scopeStep($scope)
    {
        return $this->where('step', $scope)->get();
    }

    function stepOne(){
        return $this->where('step',1);
    }

    function stepTwo($id){
        return $this->where('step',2);
    }

    function stepThree($id){
        return $this->where('step',3);
    }

}
