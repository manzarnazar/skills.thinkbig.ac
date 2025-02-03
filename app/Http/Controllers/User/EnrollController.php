<?php

namespace App\Http\Controllers\User;

use App\Models\Course;
use App\Models\Enroll;
use Illuminate\Http\Request;
use App\Models\GatewayCurrency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class EnrollController extends Controller
{
    public function enrollCourses(Request $request)
    {
        $pageTitle = "Enroll Courses";
        $enrolls = Enroll::with('course', 'course.category','course.quizzes')->where('user_id', auth()->id())->where('status', 1)->orderBy('id', 'desc');
        if ($request->search) {
            $enrolls = $enrolls->where('name', 'like', "%$request->search%")->paginate(getPaginate());
        } else {
            $enrolls = $enrolls->paginate(getPaginate());
        }
        return view($this->activeTemplate . 'user.enrolls.courses', compact('pageTitle', 'enrolls'));
    }

    public function allCourses(Request $request)
    {
        $pageTitle = "All Courses";
        $courses = Course::with('enrolls','category')->whereIn('status', [1])->orderBy('id', 'desc');
        if ($request->search) {
            $courses = $courses->where('name', 'like', "%$request->search%")->paginate(getPaginate());
        } else {
            $courses = $courses->paginate(getPaginate());
        }
        return view($this->activeTemplate . 'user.enrolls.all_courses', compact('pageTitle', 'courses'));
    }


    public function enroll($id)
    {
        $pageTitle = "Enroll Course";
        $course = Course::where('id', $id)->where('status', 1)->first();
        $price = $course->price;
        if (!$course) {
            $notify[] = ['error', 'Your course is not valid'];
            return back()->withNotify($notify);
        }

        if ($course->discount) {
            $price = priceCalculate(@$course->price, @$course->discount);
        }

        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();

        return view($this->activeTemplate . 'user.payment.deposit', compact('course', 'pageTitle', 'gatewayCurrency', 'price'));
    }
}
