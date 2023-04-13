<?php

namespace App\Http\Controllers\User;

use App\Post;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
class UserController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        
        $posts = Post::where('user_id',$id)->get();

        $post_approve = Post::where('user_id',$id)->where('is_approved',1)->get();

        $pending_post = Post::where('user_id',$id)->where('is_approved',0)->get();


        return view('user.dashboard',compact('posts','post_approve','pending_post'));
    }
    public function profile_edit(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'required',
    		'username' => 'required',
    		'email' => 'required|email',
    	]);
    	 User::find($request->user_id)->update([
    		'name' => $request-> name,
    		'username' => $request-> username,
    		'about' => $request-> about,
    		'email' => $request-> email,
            
    	]);
         if($request->hasFile('pic')){

                $has_photo = User::find($request->user_id)->pic;

                if($has_photo=='default.jpg'){
                $upload_photo = $request->pic;
                $file_name = $request->user_id.".".$upload_photo->getClientOriginalExtension();
                
                Image::make($upload_photo)->resize(700,800)->save(base_path('public/frontEnd/user_picture/'.$file_name));

                   User::find($request->user_id)->update([
                  'pic' => $file_name 
                ]);
            
                }
                else{
                    $delete=User::find($request->user_id)->pic;
                    
                    unlink(base_path('public/frontEnd/user_picture/'.$delete));
                
                    $upload_photo = $request->pic;
                    $file_name = $request->user_id.".".$upload_photo->getClientOriginalExtension();
                
                    Image::make($upload_photo)->resize(400,450)->save(base_path('public/frontEnd/user_picture/'.$file_name));

                   User::find($request->user_id)->update([
                  'pic' => $file_name 
                ]);
                }   
    	}

        Toastr::success('Successfully Updated !' ,'Profile');

    	return back();
    	
    }
   public function user_profile()
     {
        return view('user.user_profile');
     }


}
