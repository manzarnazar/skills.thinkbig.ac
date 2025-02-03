<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function categories(Request $request)
    {
        $pageTitle = 'Categories';
        $emptyMessage = 'No data found';
        $categories = new Category();
        
        if($request->search){
            $categories = $categories->where('name','like',"%$request->search%")->paginate(getPaginate());
        }else{
            $categories = $categories->paginate(getPaginate());
        }
      
        return view('admin.categories.log', compact('pageTitle', 'categories'));
    }

    public function categoryStore(CategoryRequest $request)
    {
        $pageTitle = 'Create Category';
        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        if ($request->hasFile('image')) {
            try {
                $category->image = fileUploader($request->image, getFilePath('category') , getFileSize('category'));
            } catch (Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $category->save();
        $notify[] = ['success', 'Category create successfully'];
        return to_route('admin.category.all')->withNotify($notify);
    }

    
    public function categoryUpdate(CategoryRequest $request, Category $category)
    {

        $pageTitle = 'Category Update';
        $category->name = $request->name;
        $category->status = $request->status;
        if ($request->hasFile('image')) {
            try {
                $old_image = $category->thumb_image;
                $category->image = fileUploader($request->image, getFilePath('category') , getFileSize('category'), $old_image);
            } catch (Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $category->save();
        $notify[] = ['success', 'Category Update successfully'];
        return to_route('admin.category.all')->withNotify($notify);
    }

}
