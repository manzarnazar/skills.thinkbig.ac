<?php

namespace App\Traits;

trait FileInfo
{

    /*
    |--------------------------------------------------------------------------
    | File Information
    |--------------------------------------------------------------------------
    |
    | This trait basically contain the path of files and size of images.
    | All information are stored as an array. Developer will be able to access
    | this info as method and property using FileManager class.
    |
    */

    public function fileInfo(){
        $data['withdrawVerify'] = [
            'path'=>'assets/images/verify/withdraw'
        ];
        $data['depositVerify'] = [
            'path'      =>'assets/images/verify/deposit'
        ];
        $data['verify'] = [
            'path'      =>'assets/verify'
        ];
        $data['default'] = [
            'path'      => 'assets/images/general/default.png',
        ];
        $data['withdrawMethod'] = [
            'path'      => 'assets/images/withdraw/method',
            'size'      => '800x800',
        ];
        $data['ticket'] = [
            'path'      => 'assets/support',
        ];
        $data['logoIcon'] = [
            'path'      => 'assets/images/general',
        ];
        $data['favicon'] = [
            'size'      => '128x128',
        ];
        $data['extensions'] = [
            'path'      => 'assets/images/plugins',
            'size'      => '36x36',
        ];
        $data['seo'] = [
            'path'      => 'assets/images/seo',
            'size'      => '1180x600',
        ];
        $data['userProfile'] = [
            'path'      =>'assets/images/user/profile',
            'size'      =>'350x300',
        ];
        $data['instructorProfile'] = [
            'path'      =>'assets/images/instructor/profile',
            'size'      =>'350x300',
        ];
        $data['adminProfile'] = [
            'path'      =>'assets/admin/images/profile',
            'size'      =>'400x400',
        ];

        $data['ads'] = [
            'path'      =>'assets/images/backend/ads',
        ];

        $data['category'] = [
            'path'      =>'assets/images/backend/category',
            'size'      =>'50x50',
        ];

       $data['banner'] = [
            'path'      =>'assets/images/frontend/banner',
        ];
        
        $data['works'] = [
            'path'      =>'assets/images/frontend/works',
        ];

        $data['services'] = [
            'path'      =>'assets/images/frontend/services',
        ];

       $data['faq'] = [
            'path'      =>'assets/images/frontend/faq',
        ];

       $data['testimonial'] = [
            'path'      =>'assets/images/frontend/testimonial',
        ];

       $data['blog'] = [
            'path'      =>'assets/images/frontend/blog',
        ];

       $data['contact'] = [
            'path'      =>'assets/images/frontend/contact',
        ];

       $data['about'] = [
            'path'      =>'assets/images/frontend/about',
        ];

       $data['login'] = [
            'path'      =>'assets/images/frontend/login',
        ];

       $data['videoUpload'] = [
            'path'      =>'assets/videos/backend',
        ];

       $data['lesson_image'] = [
            'path'      =>'assets/images/backend/lesson_image',
            'size'      =>'30x30',
        ];

        $data['course_image'] = [
            'path'      =>'assets/images/backend/course_image',
            'size'      =>'310x210',
        ];

        $data['quiz_image'] = [
            'path'      =>'assets/images/backend/quiz_image',
            'size'      =>'310x210',
        ];

        $data['quiz_question_image'] = [
            'path'      =>'assets/images/backend/quiz_question_image',
            'size'      =>'310x210',
        ];

        return $data;
	}

}
