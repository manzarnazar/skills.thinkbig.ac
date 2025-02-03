<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Rules\FileTypeValidate;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index() {
        $pageTitle = "Ad List";
        $ads = Ad::latest()->get();
        return view('admin.ad.index',compact('pageTitle','ads'));
    }

    public function edit($id){
        $pageTitle = 'Update';
        $ad = Ad::findOrFail($id);
        return view('admin.ad.edit',compact('pageTitle','ad'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'link'=>'required',
            'width'=>'required',
            'height'=>'required',
            'image' => ['nullable','image',new FileTypeValidate(['jpg','jpeg','png','gif'])]
        ]);

        $ad = Ad::findOrFail($id);
        $ad->name = $request->name;
        $ad->link = $request->link;
        $ad->width = $request->width;
        $ad->height = $request->height;

        if ($request->file('image')) {
            $width = Image::make($request->image)->width();
            $height = Image::make($request->image)->height();
        
            if ($ad->width != $width || $ad->height != $height) {
                $notify[] = ['error', 'Image resolution must be ' . $ad->width . 'x' . $ad->height . 'px'];
                return back()->withNotify($notify);
            } else {
                $old = $ad->image;
                $ad->image = fileUploader($request->image, getFilePath('ads'),'',$old);
            }
        }
        $ad->save();
        $notify[] = ['success','Ad has been updated successfully'];
        return back()->withNotify($notify);

    }
}
