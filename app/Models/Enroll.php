<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enroll extends Model
{
    use HasFactory;
    
    public function course(){
        return $this->belongsTo(Course::class);
    }
    
    public function user(){
        
        return $this->belongsTo(user::class);
    }

    public function scopeApproved()
    {
        return $this->where('user_id', auth()->id())->where('status', 1);
    }

    public function scopePending()
    {
        return $this->where('user_id', auth()->id())->where('status', 2);
    }

    public function enrollCount($id){
        return $this->where('id', $id)->count();
    }
}
