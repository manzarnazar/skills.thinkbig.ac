<?php

namespace App\Models;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SupportTicket extends Model
{
    public function fullname(): Attribute
    {
        return new Attribute(
            get:fn () => $this->name,
        );
    }

    public function username(): Attribute
    {
        return new Attribute(
            get:fn () => $this->email,
        );
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(
            get:fn () => $this->badgeData(),
        );
    }
    
    public function badgeData(){
        $html = '';
        if($this->status == 0){
            $html = '<span class="badge badge--success">'.trans("Open").'</span>';
        }
        elseif($this->status == 1){
            $html = '<span class="badge badge--primary">'.trans("Answered").'</span>';
        }

        elseif($this->status == 2){
            $html = '<span class="badge badge--warning">'.trans("Customer Reply").'</span>';
        }
        elseif($this->status == 3){
            $html = '<span class="badge badge--danger">'.trans("Closed").'</span>';
        }
        return $html;
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function scopeOpen(){
        return $this->where('user_id','=',auth()->id())->where('status',0);
    }
    public function scopeReplied(){
        return $this->where('user_id','=',auth()->id())->where('status',2);
    }
    public function scopeClosed(){
        return $this->where('user_id','=',auth()->id())->where('status',3);
    }


    public function scopeInstructorOpen(){
        return $this->where('instructor_id','=',auth('instructor')->id())->where('status',0);
    }
    public function scopeInstructorReplied(){
        return $this->where('instructor_id','=',auth('instructor')->id())->where('status',2);
    }
    public function scopeInstructorClosed(){
        return $this->where('instructor_id','=',auth('instructor')->id())->where('status',3);
    }
  
    public function scopeUser(){
        return $this->where('user_id','!=',0);
    }
    
    public function scopeInstructor(){
        return $this->where('instructor_id','!=',0);
    }

    public function supportMessage(){
        return $this->hasMany(SupportMessage::class);
    }

}
