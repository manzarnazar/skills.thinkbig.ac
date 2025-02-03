<?php

namespace App\Http\Controllers\Instructor;

use Closure;
use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    function index()
    {
        $pageTitle = 'Create My Course';
        $courses = Course::with('category','enrolls')->where('owner_type', 2)->orderBy('id', 'desc')->paginate(getPaginate());
        $categories = Category::where('status', 1)->get();
        return view($this->activeTemplate . 'instructor.course.index', compact('pageTitle', 'courses', 'categories'));
    }

    function create()
    {
        $pageTitle = 'Create Course';
        $categories = Category::where('status', 1)->get();
        return view($this->activeTemplate . 'instructor.course.create', compact('pageTitle', 'categories'));
    }

    function store(CourseRequest $request)
    {

        $pageTitle = 'Create My Course Category';
        $course = new Course();

        // -------------------------Check only this user already same name create or not--------------------
        $request->validate([
            'name' => [
                function (string $attribute, mixed $value, Closure $fail) use ($course) {
                    $existing_course_names = $course->instructorCourseCategories()->pluck('name')->map(function ($name) {
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
        $course->owner_id = auth('instructor')->id();
        $course->owner_type = 2;
        $course->status = $request->status;
        $course->price = $request->price;
        $course->discount = $request->discount ?? null;
        $course->learn_description = $request->learn_description;
        $course->curriculum = $request->curriculum;
        $course->course_outline = $request->course_outline;
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

    function edit($id)
    {
        $pageTitle = 'Edit Course';
        $categories = Category::where('status', 1)->get();
        $course = Course::findOrFail($id);
        return view($this->activeTemplate . 'instructor.course.edit', compact('pageTitle', 'categories', 'course'));
    }

    function update(CourseRequest $request, $id)
    {
        $pageTitle = 'Update My Course Category';
        $course = new Course();
        $request->validate([
            'name' => [
                function (string $attribute, mixed $value, Closure $fail) use ($course, $id) {
                    $existing_course_names = $course->instructorCourseCategories()->whereNot('id', $id)->pluck('name')->map(function ($name) use ($id) {
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
        $course->category_id = $request->category_id;
        $course->owner_id = auth('instructor')->id();
        $course->owner_type = 2;
        $course->status = $request->status;
        $course->price = $request->price;
        $course->discount = $request->discount ?? null;
        $course->learn_description = $request->learn_description;
        $course->curriculum = $request->curriculum;
        $course->description = $request->description;
        $course->course_outline = $request->course_outline;
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
        return redirect()->back()->withNotify($notify);
    }
}
