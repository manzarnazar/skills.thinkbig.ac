<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use Jubaer\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ZoomController extends Controller
{

    public function zoomCredential(){
        $pageTitle = 'Zoom Credential Setup';
        $instructor = auth('instructor')->user();
        return view($this->activeTemplate . 'instructor.zoom.credential', compact('pageTitle','instructor'));
    }

    public function zoomCredentialStore(Request $request){
        $request->validate([
            'zoom_account_id'=>'required|string',
            'zoom_client_id'=>'required|string',
            'zoom_secret_id'=>'required|string'
        ]);
        $instructor = auth('instructor')->user();
        $instructor->zoom_account_id = $request->zoom_account_id;
        $instructor->zoom_client_id = $request->zoom_client_id;
        $instructor->zoom_secret_id = $request->zoom_secret_id;
        $instructor->save();
        $notify[] = ['success', 'zoom credential setup successfully'];
        return back()->withNotify($notify);
    }


    public function allMeeting()
    {

        $pageTitle = 'All Meeting';
        $meetings = Zoom::getAllMeeting();

        return view($this->activeTemplate . 'instructor.zoom.all_meeting', compact('pageTitle', 'meetings'));
    }

    public function createMeeting()
    {
        $pageTitle = 'Create Meeting';
        return view($this->activeTemplate . 'instructor.zoom.create_meeting', compact('pageTitle'));
    }

    public function storeMeeting($zoom_data)
    {
     
        $meetings = Zoom::createMeeting([
            "agenda" => $zoom_data['agenda'],
            "topic" => $zoom_data['class_topic'],
            "type" => $zoom_data['type'], // 1 => instant, 2 => scheduled, 3 => recurring with no fixed time, 8 => recurring with fixed time
            "duration" => $zoom_data['approximate_time'], // in minutes
            "timezone" => config('app.timezone'), // set your timezone
            "password" => $zoom_data['password'],
            "start_time" => $zoom_data['start_time'], // set your start time
            // "template_id" => 'Dv4YdINdTk+Z5RToadh5ug', // set your template id  Ex: "Dv4YdINdTk+Z5RToadh5ug==" from https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetingtemplates
            "pre_schedule" => false,  // set true if you want to create a pre-scheduled meeting
            "schedule_for" => $zoom_data['email'], // set your schedule for
            "settings" => [
                'join_before_host' => false, // if you want to join before host set true otherwise set false
                'host_video' => false, // if you want to start video when host join set true otherwise set false
                'participant_video' => false, // if you want to start video when participants join set true otherwise set false
                'mute_upon_entry' => false, // if you want to mute participants when they join the meeting set true otherwise set false
                'waiting_room' => false, // if you want to use waiting room for participants set true otherwise set false
                'audio' => 'both', // values are 'both', 'telephony', 'voip'. default is both.
                'auto_recording' => 'local', // values are 'none', 'local', 'cloud'. default is none.
                'approval_type' => $zoom_data['approval_type'], // 0 => Automatically Approve, 1 => Manually Approve, 2 => No Registration Required
            ],
        ]);

        return $meetings;
    }

    public function editMeeting($meetingId)
    {

        $meeting = Zoom::getMeeting($meetingId);
        dd($meeting);
    }


    public function updateMeeting()
    {

        $meeting = Zoom::updateMeeting($meetingId, [
            "agenda" => 'your agenda',
            "topic" => 'your topic',
            "type" => 2, // 1 => instant, 2 => scheduled, 3 => recurring with no fixed time, 8 => recurring with fixed time
            "duration" => 60, // in minutes
            "timezone" => 'Asia/Dhaka', // set your timezone
            "password" => 'set your password',
            "start_time" => 'set your start time', // set your start time
            "template_id" => 'set your template id', // set your template id  Ex: "Dv4YdINdTk+Z5RToadh5ug==" from https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetingtemplates
            "pre_schedule" => false,  // set true if you want to create a pre-scheduled meeting
            "schedule_for" => 'set your schedule for profile email ', // set your schedule for
            "settings" => [
                'join_before_host' => false, // if you want to join before host set true otherwise set false
                'host_video' => false, // if you want to start video when host join set true otherwise set false
                'participant_video' => false, // if you want to start video when participants join set true otherwise set false
                'mute_upon_entry' => false, // if you want to mute participants when they join the meeting set true otherwise set false
                'waiting_room' => false, // if you want to use waiting room for participants set true otherwise set false
                'audio' => 'both', // values are 'both', 'telephony', 'voip'. default is both.
                'auto_recording' => 'none', // values are 'none', 'local', 'cloud'. default is none.
                'approval_type' => 0, // 0 => Automatically Approve, 1 => Manually Approve, 2 => No Registration Required
            ],

        ]);
    }
    
    public function deleteMeeting($meetingId)
    {
        $meeting = Zoom::deleteMeeting($meetingId);
        dd($meeting);
    }

    public function toZoomTimeFormat()
    {
        try {
            $date = now();
   
            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : ' . $e->getMessage());

            return '';
        }
    }
}
