<?php

namespace App\Http\Controllers\Admin;

use Closure;
use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    function index(Request $request)
    {
        $pageTitle = 'My Course';
        $courses = Course::adminCourseCategories();
        $categories = Category::where('status', 1)->get();
        if ($request->search) {
            $courses = $courses->where('name', 'like', "%$request->search%")->paginate(getPaginate());
        } else {
            $courses = $courses->orderBy('id','desc')->paginate(getPaginate());
        }
        return view('admin.courses.index', compact('pageTitle', 'courses', 'categories'));
    }

    function instructorCourses(Request $request)
    {
        
        $pageTitle = 'Instructor Course';
        $courses =  Course::instructorCourseCategories()->orderBy('id','desc');
        if ($request->search) {
            $courses = $courses->with('quizzes')->where('name', 'like', "%$request->search%")->paginate(getPaginate());
        } else {
            $courses = $courses->with('quizzes')->paginate(getPaginate());
        }
        return view('admin.courses.instructor', compact('pageTitle', 'courses'));
    }

    function create (){
        $pageTitle = 'Create Course';
        $categories = Category::where('status', 1)->get();
        return view('admin.courses.create', compact('pageTitle','categories'));
    }

    function store(CourseRequest $request)
    {

        $pageTitle = 'Create My Course Category';
        $category = Category::findOrFail($request->category_id);
        if (!$category) {
            $notify[] = ['error', 'Category id is not Valid'];
                return back()->withNotify($notify);
        }

        $course = new Course();

        // -------------------------Check only this user already same name create or not--------------------
        $request->validate([
            'name' => [
                function (string $attribute, mixed $value, Closure $fail) use ($course) {
                    $existing_course_names = $course->adminCourseCategories()->pluck('name')->map(function ($name) {
                        return strtolower($name);
                    });

                    if ($existing_course_names->contains(strtolower($value))) {
                        $fail('Your course category name already exists.');
                    }
                },
            ],

        ]);

        $course->name = $request->name;
        $course->category_id = $request->category_id;
        $course->owner_id = auth('admin')->id();
        $course->owner_type = 1;
        $course->status = $request->status;
        $course->admin_status =1;
        $course->price = $request->price;
        $course->discount = $request->discount ?? null;
        $course->learn_description = $request->learn_description;
        $course->course_outline = $request->course_outline;
        $course->curriculum = $request->curriculum;
        $course->description = $request->description;
        if ($request->hasFile('image')) {
            try {
                $course->image = fileUploader($request->image, getFilePath('course_image'), getFileSize('course_image'));
            } catch (Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $course->save();
        $notify[] = ['success', 'Course category create Successfully'];
        return back()->withNotify($notify);
    }

    function edit($id){
        $pageTitle = 'Edit Course';
        $categories = Category::where('status', 1)->get();
        $course= Course::findOrFail($id);
        return view('admin.courses.edit', compact('pageTitle','categories','course'));
    }

    function update(CourseRequest $request, $id)
    {
        $pageTitle = 'Update My Course Category';
        $course = new Course();
        $request->validate([
            'name' => [
                function (string $attribute, mixed $value, Closure $fail) use ($course, $id) {
                    $existing_course_names = $course->adminCourseCategories()->whereNot('id', $id)->pluck('name')->map(function ($name) use ($id) {
                        return strtolower($name);
                    });
                    if ($existing_course_names->contains(strtolower($value))) {
                        $fail('Your course category name already exists.');
                    }
                },
            ],

        ]);

        $course = $course->where('id', $id)->first();
        $old_image = $course->image;
        $course->name = $request->name;
        $course->owner_id = auth('admin')->id();
        $course->owner_type = 1;
        $course->status = $request->status;
        $course->price = $request->price;
        $course->discount = $request->discount ?? null;
        $course->learn_description = $request->learn_description;
        $course->course_outline = $request->course_outline;
        $course->curriculum = $request->curriculum;
        $course->description = $request->description;
        if ($request->hasFile('image')) {
            try {
                $course->image = fileUploader($request->image, getFilePath('course_image'), getFileSize('course_image'), $old_image);
            } catch (Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $course->save();
        $notify[] = ['success', 'Course category create Successfully'];
        return to_route('admin.course.index')->withNotify($notify);
    }


    function adminStatusApproved(Request $request, $id)
    {
        $request->validate([
            'admin_status' => 'required|in:0,1'
        ]);

        $course = Course::findOrFail($id);
        $course->admin_status = $request->admin_status;
        $course->save();
        $notify[] = ['success', 'Course Admin Approved Successfully'];
        return redirect()->back()->withNotify($notify);
    }
}
