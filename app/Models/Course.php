<?php

namespace App\Models;

use App\Models\Enroll;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
   use HasFactory;

   protected $casts = [
      'course_outline' => 'object'
   ];

   static function instructorCourseCategories()
   {
      return self::where('owner_type', 2);
   }

   static function adminCourseCategories()
   {
      return self::where('owner_id', auth('admin')->id())->where('owner_type', 1);
   }

   public function lessons()
   {
      return $this->hasMany(Lesson::class, 'course_id');
   }

   public function category()
   {
      return $this->belongsTo(Category::class);
   }

   public function enrolls()
   {
      return $this->hasMany(Enroll::class);
   }

   public function reviews()
   {
      return $this->hasMany(Review::class);
   }

   public function quizzes()
   {
      return $this->hasMany(Quiz::class);
   }

   public function quizCertificate()
   {
      return $this->hasMany(QuizCertificate::class);
   }

   public function checkedPurchase()
   {

      return  $this->enrolls->where('user_id', auth()->id())->first();
   }
}
