<?php

namespace App\Http\Controllers\User;

use App\Models\Course;
use App\Models\Enroll;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function reviewStore(Request $request)
    {
        $request->validate([
            'rating'=> 'required|numeric|gt:0',
            'course_id'=> 'required|numeric',
            'message'=> 'required|string',
        ]);

        $purifier = new \HTMLPurifier();
        $course_id = $request->course_id;
        $course = Course::findOrFail($course_id);
        // Check if the user has already submitted a review for this product
        $existingReview = Review::with('user')->where('user_id',auth()->id())
        ->where('course_id', $course_id)
        ->first();
        if ($existingReview) {
        $notify[] = ['error', 'You have already submitted a review for this Course'];
        return back()->withNotify($notify);
        }
        $isEnroll = Enroll::where('user_id',auth()->id())
            ->where('course_id', $course_id)
            ->where('status', 1)
            ->get();
        if ($isEnroll->isEmpty()) {
            $notify[]= ['error', 'Please enroll in this course first before reviewing it'];
            return back()->withNotify($notify);
        }
       
        $review = new Review();
        $review->user_id =  auth()->id();
        $review->course_id = $request->course_id;
        $review->message = $purifier->purify($request->message);
        $review->rating = $request->rating;
        $review->save();
        $reviews = $course->reviews()->get();
        $reviewCount = $reviews->count();
        $totalRating = $reviews->sum('rating');

        $newAverageRating = $totalRating / $reviewCount;
        // Update review_count and avg_count
        $course->review_count = $reviewCount;
        $course->average_rating = $newAverageRating;
        $course->save();
        $notify[] = ['success','Review submitted successfully'];
        return back()->withNotify($notify);
    } 
}
