<?php

namespace App\Http\Controllers\Instructor;

use Exception;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    function index(Request $request,$id)
    {
        $pageTitle = 'Question List';
        $questions = Question::where('quiz_id', $id)->orderBy('id', 'desc');
        if($request->search){
            $questions = $questions->where('question', 'like', "%$request->search%");
        }
        $questions = $questions->paginate(getPaginate());
        $quiz = $this->checkQuizId($id);
        return view($this->activeTemplate . 'instructor.question.index', compact('pageTitle', 'questions', 'quiz'));
    }

    function create($id)
    {
        $pageTitle = 'Create Question';
        $quiz = $this->checkQuizId($id);
        return view($this->activeTemplate . 'instructor.question.create', compact('pageTitle', 'quiz'));
    }


    function store(QuestionRequest $request, $id)
    {
        $quiz = $this->checkQuizId($id);
        if (!$quiz) {
            $notify[] = ['error', 'Quiz is is not valid'];
            return back()->withNotify($notify);
        }
        $pageTitle = 'Create Question';
        $question = new Question();
        $question->quiz_id = $id;
        $question->question = $request->question;
        $question->correct_answer = $request->correct_answer;
        $question->options = $request->options;
        $question->mark = $request->mark;
        if ($request->hasFile('image')) {
            try {
                $question->image = fileUploader($request->image, getFilePath('quiz_question_image'), getFileSize('quiz_question_image'));
            } catch (Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $question->save();
        $notify[] = ['success', 'Question create Successfully'];
        return back()->withNotify($notify);
    }

    function edit($question_id, $quiz_id)
    {
        $pageTitle = 'Edit Question';
        $quiz = $this->checkQuizId($quiz_id);
        $question = Question::where('id', $question_id)->first();
        return view($this->activeTemplate . 'instructor.question.edit', compact('pageTitle', 'quiz', 'question'));
    }

    function update(QuestionRequest $request, $question_id, $quiz_id)
    {

        $pageTitle = 'Edit Question';
        $quiz = $this->checkQuizId($quiz_id);
        $question = Question::findOrFail($question_id);
        $oldImage = $question->image;
        $question->quiz_id = $quiz_id;
        $question->question = $request->question;
        $question->correct_answer = $request->correct_answer;
        $question->options = $request->options;
        $question->mark = $request->mark;
        if ($request->hasFile('image')) {
            try {
                $question->image = fileUploader($request->image, getFilePath('quiz_question_image'), getFileSize('quiz_question_image'),$oldImage);
            } catch (Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $question->save();
        $notify[] = ['success', 'Question Update Successfully'];
        return back()->withNotify($notify);
    }

    function delete($question_id, $quiz_id)
    {
        $quiz = $this->checkQuizId($quiz_id);
        $question = Question::findOrFail($question_id);
        fileManager()->removeFile(getFilePath('quiz_question_image') . '/' . $question->image);
        $quiz->delete();
        $notify[] = ['success', 'Question delete successfully'];
        return redirect()->back()->withNotify($notify);
    }

    function checkQuizId($id)
    {
        $quiz = Quiz::where('id', $id)->where('owner_id', auth('instructor')->id())->where('owner_type', 2)->first();
        if (!$quiz) {
            $notify[] = ['error', 'Your id is not valid'];
            return redirect()->back()->withNotify($notify);
        }
        return $quiz; 
    }
}
