<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\QuizCertificate;
use App\Http\Controllers\Controller;

class QuizCertificateController extends Controller
{
    function certificates(Request $request)
    {
        $pageTitle = 'Certificates';
        $quizCertificates = QuizCertificate::with('course','user','quiz')->whereHas('course',function($q){
            $q->where('owner_id',auth('instructor')->id())->where('owner_type',2);
        });

        if ($request->search) {
            $quizCertificates = $quizCertificates->with('course','user','quiz')->whereHas('course',function($q)use ($request){
                $q->where('name', 'like', "%$request->search%")->where('owner_id',auth('instructor')->id())->where('owner_type',2);
            })->orderBy('id', 'desc')->paginate(getPaginate());
        } else {
            $quizCertificates = $quizCertificates->with('course','user','quiz')->orderBy('id', 'desc')->paginate(getPaginate());
        }

        return view($this->activeTemplate . 'instructor.certificate.index', compact('pageTitle', 'quizCertificates'));
    }
}
