<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizUser extends Model
{
    use HasFactory;
    protected $table = "quiz_user";

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function quiz(){
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    public function question(){
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function correctMarking($quiz_id,$user_id){
        if($quiz_id && $user_id){
            $correctAns = $this->where('quiz_id',$quiz_id)->where('user_id',$user_id)->whereColumn('user_answer','correct_answer')->sum('mark');
            return $correctAns;
        }
        return 0;
    }

}
