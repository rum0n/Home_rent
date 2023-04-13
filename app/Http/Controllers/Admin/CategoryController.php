<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    function category_form(){
        $all_category = Category::all();
         $notification_post = Post::where('is_approved',1);
         $total_npost = $notification_post->count();
        return view('admin.category.category_form',compact('all_category','total_npost'));
    }

    function category_insert(Request $request){
        $this->validate($request,[
            'category_name' => 'required|unique:categories,category_name',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
        ]);

        Toastr::success('Successfully Added !' ,'Category');
        return back();
    }

    function category_delete($id){
        Category::find($id)->delete();

        Toastr::success('Successfully Deleted !' ,'Category');
        return back();
    }

    function category_edit($id){
        $single_category = Category::findOrFail($id);

        return view('admin.category.category_edit',compact('single_category'));
    }

    function category_update(Request $request){
        Category::find($request->category_id)->update([
            'category_name' => $request->category_name,
        ]);

        Toastr::success('Successfully Updated !' ,'Category');
        return redirect('/admin/category');
    }
}
