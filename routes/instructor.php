<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->name('instructor.')->group(function () {
    Route::controller('LoginController')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::controller('RegisterController')->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'register')->middleware('registration.status');
        Route::post('check-mail', 'checkUser')->name('checkUser');
    });

    Route::controller('ForgotPasswordController')->group(function () {
        Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'sendResetCodeEmail')->name('password.email');
        Route::get('password/code-verify', 'codeVerify')->name('password.code.verify');
        Route::post('password/verify-code', 'verifyCode')->name('password.verify.code');
    });
    Route::controller('ResetPasswordController')->group(function () {
        Route::post('password/reset', 'reset')->name('password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    });

    Route::controller('SocialiteController')->prefix('social')->group(function () {
        Route::get('login/{provider}', 'socialLogin')->name('social.login');
        Route::get('login/callback/{provider}', 'callback')->name('social.login.callback');
    });
});



Route::middleware('instructor')->name('instructor.')->group(function () {
    //authorization
    Route::controller('AuthorizationController')->group(function () {
        Route::get('authorization', 'authorizeForm')->name('authorization');
        Route::get('resend/verify/{type}', 'sendVerifyCode')->name('send.verify.code');
        Route::post('verify/email', 'emailVerification')->name('verify.email');
        Route::post('verify/mobile', 'mobileVerification')->name('verify.mobile');
        Route::post('verify/g2fa', 'g2faVerification')->name('go2fa.verify');
    });

    Route::middleware(['instructor.check.status'])->group(function () {
        Route::get('instructor/data', 'InstructorController@userData')->name('data');
        Route::post('instructor/data/submit', 'InstructorController@userDataSubmit')->name('data.submit');
        Route::middleware('instructor.registration.complete')->group(function () {
            Route::controller('InstructorController')->group(function () {
                Route::get('dashboard', 'home')->name('home');
                //2FA
                Route::get('twofactor', 'show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

                //Report
                Route::any('deposit/history', 'depositHistory')->name('deposit.history');
                Route::get('transactions', 'transactions')->name('transactions');

                Route::get('attachment-download/{fil_hash}', 'attachmentDownload')->name('attachment.download');
            });

            //Profile setting
            Route::controller('ProfileController')->group(function () {
                Route::get('profile/setting', 'profile')->name('profile.setting');
                Route::post('profile/setting', 'submitProfile');
                Route::get('change-password', 'changePassword')->name('change.password');
                Route::post('change-password', 'submitPassword');
            });

            //KYC
            Route::controller('InstructorController')->group(function () {
                Route::get('kyc-form', 'kycForm')->name('kyc.form');
                Route::get('kyc-data', 'kycData')->name('kyc.data');
                Route::post('kyc-submit', 'kycSubmit')->name('kyc.submit');
            });

            //Lesson Route
            Route::controller('LessonController')->name('lesson.')->group(function () {
                Route::get('lessons/{lesson_id}', 'lessons')->name('lessons');
                Route::middleware('instructor.kyc')->group(function () {
                    Route::get('lesson/create', 'create')->name('create');
                    Route::post('lesson/store', 'store')->name('store');
                    Route::get('lesson/edit/{id}', 'edit')->name('edit');
                    Route::post('lesson/update/{id}', 'update')->name('update');

                    Route::post('lesson/delete/{id}', 'lessonDelete')->name('delete');

                    Route::post('lesson/video-upload', 'videoUpload')->name('video.upload');
                    Route::post('lesson/video-upload-delete', 'videoUploadDelete')->name('video.upload.delete');

                    Route::post('lesson/edit-video-upload', 'editVideoUpload')->name('edit.video.upload');
                    Route::post('lesson/edit-video-upload-delete', 'editVideoUploadDelete')->name('edit.video.upload.delete');

                    Route::post('course/group', 'CourseGroup')->name('course.group');
                });
            });

            //Create Course  
            Route::controller('CourseController')->name('course.')->group(function () {
                Route::get('course', 'index')->name('index');
                Route::get('course/create', 'create')->name('create');
                Route::post('course/store', 'store')->name('store');
                Route::get('course/edit/{id}', 'edit')->name('edit');
                Route::put('course/update/{id}', 'update')->name('update');
            });


            // Quizzes Manager
            Route::controller('QuizController')->name('quiz.')->prefix('quiz/')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{id}', 'edit')->name('edit');
                Route::put('update/{id}', 'update')->name('update');
                Route::post('delete/{id}', 'delete')->name('delete');
                Route::get('student/participants/{id}', 'participants')->name('participants');
                Route::post('delete/{quiz_id}/{user_id}', 'participantDelete')->name('participant.delete');
            });

            // Question Manager
            Route::controller('QuestionController')->name('question.')->prefix('question/')->group(function () {
                Route::get('/{id}', 'index')->name('index');
                Route::get('create/{id}', 'create')->name('create');
                Route::post('store/{id}', 'store')->name('store');
                Route::get('edit/{question_id}/{quiz_id}', 'edit')->name('edit');
                Route::put('update/{question_id}/{quiz_id}', 'update')->name('update');
                Route::post('delete/{question_id}/{quiz_id}', 'delete')->name('delete');
                
            });

            // Zoom credentials
            Route::controller('ZoomController')->name('zoom.')->group(function () {
                Route::get('setup-credential', 'zoomCredential')->name('credential');
                Route::post('setup-credential', 'zoomCredentialStore')->name('store.credential');
            });


            // Quiz Certificates
            Route::controller('QuizCertificateController')->name('quiz.certificate.')->group(function () {
                Route::get('quiz/certificates', 'certificates')->name('all');
            });


            // Withdraw controller
            Route::controller('WithdrawController')->prefix('withdraw')->name('withdraw')->group(function () {
                Route::get('/', 'withdrawMoney');
                Route::post('/', 'withdrawStore')->name('.money');
                Route::get('preview', 'withdrawPreview')->name('.preview');
                Route::post('preview', 'withdrawSubmit')->name('.submit');
                Route::get('history', 'withdrawLog')->name('.history');
            });

 
            Route::controller('TicketController')->prefix('ticket')->group(function () {
                Route::get('all', 'supportTicket')->name('ticket');
                Route::get('new', 'openSupportTicket')->name('ticket.open');
                Route::post('create', 'storeSupportTicket')->name('ticket.store');
                Route::get('view/{ticket}', 'viewTicket')->name('ticket.view');
                Route::post('reply/{ticket}', 'replyTicket')->name('ticket.reply');
                Route::post('close/{ticket}', 'closeTicket')->name('ticket.close');
                Route::get('download/{ticket}', 'ticketDownload')->name('ticket.download');
            });
        });
    });
});
