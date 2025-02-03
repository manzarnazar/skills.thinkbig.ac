<?php

namespace App\Http\Controllers\Instructor;

use Exception;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\QuizUser;
use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    function index(Request $request)
    {
        $pageTitle = 'Quizzes List';
        $quizzes = Quiz::with('questions', 'course')->where('owner_id', auth('instructor')->id())->where('owner_type', 2)->orderBy('id', 'desc');
        if($request->search){
            $quizzes = $quizzes->where('name', 'like', "%$request->search%");
        }

        $quizzes = $quizzes->paginate(getPaginate());
        return view($this->activeTemplate . 'instructor.quiz.index', compact('pageTitle', 'quizzes'));
    }

    function create()
    {
        $pageTitle = 'Create Quiz';
        $courses = Course::where('status', 1)->where('owner_id', auth('instructor')->id())->where('owner_type', 2)->get();
        return view($this->activeTemplate . 'instructor.quiz.create', compact('pageTitle', 'courses'));
    }

    function store(QuizRequest $request)
    {
        $pageTitle = 'Create Quiz';
        $quiz = new Quiz();
        $quiz->name = $request->name;
        $quiz->course_id = $request->course_id;
        $quiz->owner_id = auth('instructor')->id();
        $quiz->owner_type = 2;
        $quiz->active_quiz = $request->active_quiz;
        $quiz->total_question = $request->total_question;
        $quiz->pass_mark = $request->pass_mark;
        $quiz->time = $request->time;
        $quiz->description = $request->description;
        if ($request->hasFile('image')) {
            try {
                $quiz->image = fileUploader($request->image, getFilePath('quiz_image'), getFileSize('quiz_image'));
            } catch (Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $quiz->save();
        $notify[] = ['success', 'Quiz create Successfully'];
        return back()->withNotify($notify);
    }

    function edit($id)
    {
        $pageTitle = 'Edit Quiz';
        $courses = Course::where('status', 1)->where('owner_id', auth('instructor')->id())->where('owner_type', 2)->get();
        $quiz = Quiz::findOrFail($id);
        return view($this->activeTemplate . 'instructor.quiz.edit', compact('pageTitle', 'courses', 'quiz'));
    }

    function update(QuizRequest $request, $id)
    {
        $pageTitle = 'Create Quiz';
        $quiz = Quiz::findOrFail($id);
        $oldImage = $quiz->image;
        $quiz->name = $request->name;
        $quiz->course_id = $request->course_id;
        $quiz->owner_id = auth('instructor')->id();
        $quiz->owner_type = 2;
        $quiz->active_quiz = $request->active_quiz;
        $quiz->total_question = $request->total_question;
        $quiz->pass_mark = $request->pass_mark;
        $quiz->time = $request->time;
        $quiz->description = $request->description;

        if ($request->hasFile('image')) {
            try {
                $quiz->image = fileUploader($request->image, getFilePath('quiz_image'), getFileSize('quiz_image'), $oldImage);
            } catch (Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $quiz->save();
        $notify[] = ['success', 'Quiz Update Successfully'];
        return back()->withNotify($notify);
    }

    function delete($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        if (!$quiz) {
            $notify[] = ['error', 'Your id is not valid'];
            return redirect()->back()->withNotify($notify);
        }
        fileManager()->removeFile(getFilePath('quiz_image') . '/' . $quiz->image);
        $quiz->delete();
        $notify[] = ['success', 'Quiz delete successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function participants($id)
    {
        $pageTitle = 'Quiz Participant';
        $quiz = Quiz::with(['userQuizzes' => function ($query) {
            $query->latest()->distinct();
        }])->find($id);

        $quizUsers = QuizUser::with(['quiz', 'quiz.questions', 'user' => function ($query) {
            $query->latest();
        }])
            ->whereIn('id', function ($query) use ($id) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('quiz_user')
                    ->where('quiz_id', $id)
                    ->groupBy('user_id');
            })
            ->where('quiz_id', $id)
            ->paginate(getPaginate());

        // dd($quizUsers);

        return view($this->activeTemplate . 'instructor.quiz.participants', compact('pageTitle', 'quizUsers'));
    }


    public function participantDelete($quiz_id, $user_id)
    {
        // dd($quiz_id,$user_id);
        $quizUsers = QuizUser::where('quiz_id', $quiz_id)->where('user_id', $user_id)->get();
        $quizUsers->each->delete();
        $notify[] = ['success', 'Participant delete successfully'];
        return redirect()->back()->withNotify($notify);
    }
}
