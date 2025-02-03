<?php

namespace App\Http\Controllers\Instructor;

use Closure;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Rules\FileTypeValidate;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class LessonController extends Controller
{
    function lessons(Request $request,$id)
    {
        $pageTitle = 'Course Lessons';
        $lessons = Lesson::instructorOwner()->where('course_id', $id)->orderBy('id','desc');
        if ($request->search) {
            $lessons = $lessons->where('title', 'like', "%$request->search%")->paginate(getPaginate());
        } else {
            $lessons = $lessons->paginate(getPaginate());
        }
        return view($this->activeTemplate . 'instructor.lessons.index', compact('pageTitle', 'lessons'));
    }

    function create()
    {
        $pageTitle = 'Create Lesson';
        $courses = Course::instructorCourseCategories()->get();
        $upload_video = null;

        if (session()->get('videoUpload')) {
            $oldFileName = session()->get('videoUpload');
            fileManager()->removeFile(getFilePath('videoUpload') . '/videoUpload/' . $oldFileName);
            session()->forget('videoUpload');
        }
        return view($this->activeTemplate . 'instructor.lessons.create', compact('pageTitle', 'courses'));
    }


    function store(Request $request)
    {
        $lesson = new Lesson();
        $request->validate([
            'course_id' => "required|numeric",
            'title' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) use ($lesson) {
                    $existing_lesson_names = $lesson->instructorOwner()->pluck('title')->map(function ($name) {
                        return strtolower($name);
                    });
                    if ($existing_lesson_names->contains(strtolower($value))) {
                        $fail('Your Lesson title name already exists.');
                    }
                },
            ],
            'level' => "required|numeric|" . Rule::in(['1', '2', '3']),
            'value' => "required|" . Rule::in(['0', '1']),
            'preview_video' => "required|" . Rule::in(['1', '2', '3']),
            'video_url' => "required_if:preview_video,2",
            'description' => "required|string",
            'agenda' => "required_if:preview_video,3",
            'class_topic' => "required_if:preview_video,3",
            'type' => "required_if:preview_video,3|" . Rule::in(['1', '2']),
            'approximate_time' => "required_if:preview_video,3",
            'email' => "required_if:preview_video,3",
            'password' => "required_if:preview_video,3",
            'start_time' => "required_if:preview_video,3",
            'approval_type' => "required_if:preview_video,3|" . Rule::in(['0', '1']),
            'status' => "required|" . Rule::in(['0', '1']),
        ]);

        $sessionVideo = session()->get('videoUpload');

        if (!$sessionVideo && $request->preview_video == 1) {
            $request->validate([
                'upload_video' => [
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->input('preview_video') == 1 && !$request->hasFile('upload_video')) {
                            $fail('Upload video is required when preview video is set.');
                        }
                    },
                    $request->preview_video == 1 ? 'required_if:preview_video,1' : '', // This ensures that upload_video is required when preview_video is set to 1
                    $request->preview_video == 1 ? 'mimes:mp4' : '' // This ensures that the uploaded file is of the mp4 format
                ]
            ]);
        }

        
        if ($request->start_time && $request->start_time < now()) {
            $notify[] = ['error', 'your current date is less then meeting date'];
            return back()->withNotify($notify);
        }



        if ($request->preview_video == 3 && $request->start_time && $request->start_time > now()) {
            $start_date = Carbon::parse($request->start_time);
            $zoom_array = [
                'agenda' => $request->agenda ?? null,
                'class_topic' => $request->class_topic ?? null,
                'type' => (int) $request->type ?? null,
                'approximate_time' => (int) $request->approximate_time ?? null,
                'password' => $request->password ?? null,
                'start_time' => $start_date->format('Y-m-d\TH:i:s') ?? null,
                'approval_type' => (int) $request->approval_type ?? null,
                'email' => $request->email ?? null,
            ];

            $collectionZoomData = collect($zoom_array);
            $allNotNull = $collectionZoomData->every(function ($item, $key) {
                return $item !== null;
            });

            // ---------------------check all value is null---------------------
            if ($allNotNull) {
                $instructor = auth('instructor')->user();

                $zoom = new ZoomController();
                if (!($instructor->zoom_account_id) && !($instructor->zoom_client_id) && !($instructor->zoom_secret_id)) {
                    $notify[] = ['error', 'At first setup zoom credentials'];
                    return redirect()->back()->withNotify($notify);
                }
                $zoom_data = $zoom->storeMeeting($collectionZoomData);
                if (!$zoom_data['status']) {
                    $notify[] = ['error', 'meeting is not created'];
                    return back()->withNotify($notify);
                }
            } else {
                $notify[] = ['error', 'some data are missing'];
                return back()->withNotify($notify);
            }
        }


        $purifier = new \HTMLPurifier();
        $lesson->title = $request->title;
        $lesson->owner_id = auth('instructor')->id();
        $lesson->owner_type = 2;
        $lesson->course_id = $request->course_id;
        $lesson->preview_video = $request->preview_video;
        $lesson->video_url = $request->video_url;
        $lesson->level = $request->level;
        $lesson->value = $request->value;
        $lesson->upload_video = $sessionVideo ?? null;
        $lesson->description = $purifier->purify($request->description);
        $lesson->status = $request->status;
        $lesson->zoom_data = $zoom_data ?? null;

        session()->forget('videoUpload');
        $lesson->save();

        $notify[] = ['success', 'Lesson create Successfully'];
        return back()->withNotify($notify);
    }

    public function videoUpload(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name
            $fileName = str_replace(' ', '_', $fileName);

            $uploadPath = getFilePath('videoUpload');
            $path = $uploadPath . '/videoUpload/' . $fileName;
            $file->move($uploadPath . '/videoUpload', $fileName);
            Storage::disk('local')->delete('chunks/' . $fileName);

            if (session()->get('videoUpload')) {
                $oldFileName = session()->get('videoUpload');
                fileManager()->removeFile(getFilePath('videoUpload') . '/videoUpload/' . $oldFileName);
            }

            session()->put('videoUpload', $fileName);

            return [
                'path' => asset($path),
                'filename' => $fileName
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }

    public function videoUploadDelete(Request $request)
    {
        $data = '';
        $fileName = session()->get('videoUpload') ?? $request->fileName;
        $path = asset(getFilePath('videoUpload') . '/videoUpload/' . $fileName);
        $ch = curl_init($path);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            fileManager()->removeFile(getFilePath('videoUpload') . '/videoUpload/' . $fileName);
            session()->forget('videoUpload');
            $data = [
                'status' => "success",
                'message' => "Your upload video is removed",
            ];
        } else {
            $data = [
                'status' => "error",
                'message' => "Your upload video url is not valid",
            ];
        }

        return response()->json($data);
    }

    function edit($id)
    {
        $pageTitle = 'Edit Lesson';
        $categories = Category::where('status', 1)->get();
        $courses = Course::instructorCourseCategories()->get();
        $lesson = Lesson::instructorOwner()->where('id', $id)->first();


        if (!$lesson->first()) {
            $notify[] = ['error', 'Your id is not valid'];
            return back()->withNotify($notify);
        }


        $upload_video = null;
        if (session()->get('videoUpload')) {
            $oldFileName = session()->get('videoUpload');
            fileManager()->removeFile(getFilePath('videoUpload') . '/videoUpload/' . $oldFileName);
            session()->forget('videoUpload');
        }
        if ($lesson->upload_video) {
            $upload_video = asset(getFilePath('videoUpload') . '/videoUpload/' . $lesson->upload_video);
        }

        return view($this->activeTemplate . 'instructor.lessons.edit', compact('pageTitle', 'categories', 'lesson', 'courses', 'upload_video'));
    }

    function Update(Request $request, $id)
    {
        $lessonObject = new Lesson();
        $lesson = Lesson::instructorOwner()->where('id', $id)->first();

        // ------------------------validation------------------------
        $request->validate([
            'course_id' => "required|numeric",
            'level' => "required|numeric|" . Rule::in(['1', '2', '3']),
            'value' => "required|" . Rule::in(['0', '1']),
            'title' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) use ($lessonObject, $id) {
                    $existing_lesson_names = $lessonObject->instructorOwner()->whereNot('id', $id)->pluck('title')->map(function ($name) {
                        return strtolower($name);
                    });
                    if ($existing_lesson_names->contains(strtolower($value))) {
                        $fail('Your course title name already exists.');
                    }
                },
            ],
            'preview_video' => "required|" . Rule::in(['1', '2', '3']),
            'video_url' => "required_if:preview_video,2",
            'description' => "required|string",
            'status' => "required|" . Rule::in(['0', '1'])
        ]);

        $oldImage = $lesson->image;
        if ($request->image && $oldImage) {
            fileManager()->removeFile(getFilePath('lesson_image') . '/' . $oldImage);
        }

        
        $sessionVideo = session()->get('videoUpload');
        $uploadVideo = $lesson->upload_video;
        $path = asset(getFilePath('videoUpload') . '/videoUpload/' . $uploadVideo);
        $ch = curl_init($path);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        
        if (!$sessionVideo && !$uploadVideo && $httpCode != 200) {
            $request->validate([
                'upload_video' => "mimes:mp4|required_if:preview_video,1",
            ]);
        } else {
            $request->validate([
                'upload_video' => "mimes:mp4",
            ]);
        }
        
        if ($request->preview_video && $sessionVideo) {
            if ($httpCode == 200) {
           
                fileManager()->removeFile(getFilePath('videoUpload') . '/videoUpload/' . $uploadVideo);
            }
        }
        $purifier = new \HTMLPurifier();
        $lesson->title = $request->title;
        $lesson->course_id = $request->course_id;
        $lesson->owner_id = auth('instructor')->id();
        $lesson->owner_type = 2;
        $lesson->level = $request->level;
        $lesson->preview_video = $request->preview_video;
        $lesson->value = $request->value;
        $lesson->video_url = $request->preview_video == 2 ? $request->video_url : null;
        $lesson->upload_video = $sessionVideo ?? $uploadVideo;
        $lesson->description = $purifier->purify($request->description);
        $lesson->status = $request->status;
        session()->forget('videoUpload');
        $lesson->save();
        $notify[] = ['success', 'Lesson update successfully'];
        return redirect()->back()->withNotify($notify);;
    }

    public function editVideoUpload(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extension
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name
            $fileName = str_replace(' ', '_', $fileName);

            $uploadPath = getFilePath('videoUpload');
            $path = $uploadPath . '/videoUpload/' . $fileName;
            $file->move($uploadPath . '/videoUpload', $fileName);
            Storage::disk('local')->delete('chunks/' . $fileName);

            if (session()->get('videoUpload')) {
                $oldFileName = session()->get('videoUpload');
                fileManager()->removeFile(getFilePath('videoUpload') . '/videoUpload/' . $oldFileName);
            }

            session()->put('videoUpload', $fileName);

            return [
                'path' => asset($path),
                'filename' => $fileName
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }

    public function editVideoUploadDelete(Request $request)
    {
        $data = '';
        $fileName = session()->get('videoUpload') ?? $request->fileName;
        $path = asset(getFilePath('videoUpload') . '/videoUpload/' . $fileName);
        $ch = curl_init($path);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (!session()->get('videoUpload')) {
            $Lesson = Lesson::instructorOwner()->where('id', $request->id)->first();
            $Lesson->upload_video = null;
            $Lesson->save();
        }

        if ($httpCode == 200) {
            fileManager()->removeFile(getFilePath('videoUpload') . '/videoUpload/' . $fileName);
            session()->forget('videoUpload');
            $data = [
                'status' => "success",
                'message' => "Your upload video is removed",
            ];
        } else {
            $data = [
                'status' => "error",
                'message' => "Your upload video url is not valid",
            ];
        }

        return response()->json($data);
    }

    function lessonDelete($id)
    {

        $Lesson = Lesson::instructorOwner()->where('id', $id)->first();
        if (!$Lesson) {
            $notify[] = ['error', 'Your id is not valid'];
            return redirect()->back()->withNotify($notify);
        }
        $fileName = $Lesson->upload_video;
        $path = asset(getFilePath('videoUpload') . '/videoUpload/' . $fileName);
        $ch = curl_init($path);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            fileManager()->removeFile(getFilePath('videoUpload') . '/videoUpload/' . $fileName);
            $notify[] = ['success', 'Your Course delete successfully'];
        } else {
            $notify[] = ['error', 'Your Course delete successfully'];
        }

        $Lesson->delete();
        return redirect()->back()->withNotify($notify);
    }
}
