<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Jubaer\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ZoomController extends Controller
{

    public function zoomCredential(){
        $pageTitle = 'Zoom Credential Setup';
        $admin = auth('admin')->user();
        return view('admin.zoom.credential', compact('pageTitle','admin'));
    }

    public function zoomCredentialStore(Request $request){

        $request->validate([
            'zoom_account_id'=>'required|string',
            'zoom_client_id'=>'required|string',
            'zoom_secret_id'=>'required|string'
        ]);
        $admin = auth('admin')->user();
        $admin->zoom_account_id = $request->zoom_account_id;
        $admin->zoom_client_id = $request->zoom_client_id;
        $admin->zoom_secret_id = $request->zoom_secret_id;
        $admin->save();
        $notify[] = ['success', 'zoom credential setup successfully'];
        return back()->withNotify($notify);
    }


  
}
