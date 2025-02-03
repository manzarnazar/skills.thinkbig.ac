<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\QuizCertificate;
use App\Models\CertificateTemplate;
use App\Http\Controllers\Controller;
use App\Models\NotificationTemplate;

class CertificateController extends Controller
{
    public function templateEdit()
    {
        $template = CertificateTemplate::first();
        $pageTitle = $template->name;
        return view('admin.certificate.edit', compact('pageTitle', 'template'));
    }

    public function templateUpdate(Request $request){
        $request->validate([
            'template' => 'required',
        ]);
        $template = CertificateTemplate::first();
        $template->name = $request->name ?? $template->name;
        $template->template = $request->template;
        $template->save();

        $notify[] = ['success','Certificate template has been updated successfully'];
        return back()->withNotify($notify);
    }

    function all(Request $request)
    {
        $pageTitle = 'Certificates';
        $quizCertificates = QuizCertificate::with('course','user','quiz');

        if ($request->search) {
            $quizCertificates = $quizCertificates->with('course','user','quiz')->whereHas('course',function($q)use ($request){
                $q->where('name', 'like', "%$request->search%");
            })->orderBy('id', 'desc')->paginate(getPaginate());
        } else {
            $quizCertificates = $quizCertificates->with('course','user','quiz')->orderBy('id', 'desc')->paginate(getPaginate());
        }

        return view('admin.certificate.all', compact('pageTitle', 'quizCertificates'));
    }


}
