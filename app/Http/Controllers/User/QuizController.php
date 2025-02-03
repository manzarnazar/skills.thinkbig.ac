<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Quiz;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Question;
use App\Models\Instructor;
use App\Models\QuizStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CertificateTemplate;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    public function courseQuiz($course_id)
    {
        $pageTitle = " Course Quiz List";
        $enroll = Enroll::where('course_id', $course_id)->where('user_id', auth()->id())->first();

        if (!$enroll) {
            $notify[] = ['error', 'You are not access able this course'];
            return to_route('user.home')->withNotify($notify);
        }

        $quizzes = Quiz::with('questions')->where('course_id', $course_id)->paginate(getPaginate());
        return view($this->activeTemplate . 'user.quiz.list', compact('pageTitle', 'quizzes'));
    }

    public function quizDetails($id)
    {
        $pageTitle = "Quiz Details";
        $quiz = Quiz::with('questions', 'user', 'admin')->where('id', $id)->first();
        return view($this->activeTemplate . 'user.quiz.details', compact('pageTitle', 'quiz'));
    }

    public function quizStart($id)
    {
        $pageTitle = "Quiz Start";

        $questions = Question::where('quiz_id', $id)->get();
        $quiz = Quiz::where('id', $id)->first();
        $quizStatus = new QuizStatus();
        $existQuizStatus = $quizStatus->where('quiz_id', $id)->where('user_id', auth()->id())->first();

        if (!$existQuizStatus) {
            $quizStatus->quiz_id = $id;
            $quizStatus->user_id = auth()->id();
            $quizStatus->status = 1;
            $quizStatus->save();

            $existQuizStatus = $quizStatus;
        }


        if (@$existQuizStatus->status == 0) {
            $notify[] = ['error', 'You are already participant this quiz'];
            return to_route('user.home')->withNotify($notify);
        }
        return view($this->activeTemplate . 'user.quiz.start', compact('pageTitle', 'questions', 'quiz', 'existQuizStatus'));
    }

    public function quizAnswer(Request $request)
    {
        $pageTitle = "Quiz Start";
        $quiz = Quiz::findOrFail($request->quiz_id);
        $question = Question::findOrFail($request->question_id);

        $existData = $quiz->with('userQuizzes')->whereHas('userQuizzes', function ($query) use ($question) {
            $query->where('user_id', auth()->id())->where('question_id', $question->id);
        })->first();

        if ($existData) {
            $quiz->userQuizzes()->detach();
        }

        $quiz->userQuizzes()->attach([
            [
                'quiz_id' => $request->quiz_id,
                'question_id' => $question->id,
                'mark' => $question->mark,
                'user_answer' => $request->user_answer,
                'correct_answer' => $question->correct_answer,
                'user_id' => auth()->id(),
            ]
        ]);

        return response()->json(['success' => true]);
    }

    public function quizResult()
    {

        $pageTitle = "Quiz Result Lists";
        $quiz = new Quiz();
        $quizzes = $quiz->with('userQuizzes', 'questions', 'course')->whereHas('userQuizzes', function ($query) {
            $query->where('user_id', auth()->id());
        })->paginate(getPaginate());

        return view($this->activeTemplate . 'user.quiz.result', compact('pageTitle', 'quizzes'));
    }


    public function quizStatus($id)
    {
        $quizStatus = QuizStatus::findOrFail($id);
        $quizStatus->status = 0;
        $quizStatus->save();
        return to_route('user.quiz.result');
    }


    public function certificate($quiz_id, $marking)
    {
        $quiz = Quiz::with('course')->where('id', $quiz_id)->first();
        $pageTitle = $quiz->name;
        if ($quiz->course->owner_type == 1) {
            $examinerName = Admin::where('id', $quiz->course->owner_id)->first();
            $examinerName = $examinerName->name;
        } else {
            $examinerName = Instructor::where('id', $quiz->course->owner_id)->first();
            $examinerName = $examinerName->fullname;
        }
        $certificateTemplate = CertificateTemplate::first();

        $template = $certificateTemplate->template;
        $replacedData = [
            '{{sitename}}' =>gs()->site_name,
            '{{studentname}}' =>auth()->user()->fullname,
            '{{score}}' =>$marking,
            '{{exam_name}}' =>$quiz->name,
            '{{examiner_name}}' =>$examinerName,
            '{{date}}' =>showDateTime($quiz->created_at,'m/d/Y'),
        ];


        $replaced = '';

        foreach ($replacedData as $key => $value) {
            if($replaced){
                $replaced = $replaced;
            }else{
                $replaced = $template;
            }
            $replaced = Str::of($replaced)->replace($key,$value);
        }

        return view($this->activeTemplate . 'user.quiz.certificate', compact('pageTitle','quiz','replaced'));
    }
}
