<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Intervention\Image\Facades\Image;
class AdminController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(7);

        $post_approve = Post::orderBy('id', 'DESC')->where('is_approved',1)->get();

        $pending_post = Post::orderBy('id', 'DESC')->where('is_approved',0)->get();
         $notification_post = Post::where('is_approved',1);
         $total_npost = $notification_post->count();
        // dd($total_npost);

        return view('admin.home.dashboard', compact('posts','post_approve','pending_post','total_npost'));
    }

     public function admin_profile()
     {
         $notification_post = Post::where('is_approved',1);
         $total_npost = $notification_post->count();
        return view('admin.home.admin_profile',compact('total_npost'));
     }

    public function profile_edit(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required',
            'about' => 'required',
            'email' => 'required|email',
        ]);
        User::find($request->user_id)->update([
            'name' => $request-> name,
            'username' => $request-> username,
            'about' => $request-> about,
            'email' => $request-> email
        ]);
         if($request->hasFile('pic')){

                $has_photo = User::find($request->user_id)->pic;

                if($has_photo=='default.jpg'){
                $upload_photo = $request->pic;
                $file_name = $request->user_id.".".$upload_photo->getClientOriginalExtension();
                
                Image::make($upload_photo)->resize(700,800)->save(base_path('public/frontEnd/admin_picture/'.$file_name));

                   User::find($request->user_id)->update([
                  'pic' => $file_name 
                ]);
            
                }
                else{
                    $delete=User::find($request->user_id)->pic;
                    
                    unlink(base_path('public/frontEnd/admin_picture/'.$delete));
                
                    $upload_photo = $request->pic;
                    $file_name = $request->user_id.".".$upload_photo->getClientOriginalExtension();
                
                    Image::make($upload_photo)->resize(400,450)->save(base_path('public/frontEnd/admin_picture/'.$file_name));

                   User::find($request->user_id)->update([
                  'pic' => $file_name 
                ]);
                }   
        }

        Toastr::success('Successfully Updated !' ,'Profile');

        return back();

    }

    //=============Ajax Search Ends=================
//    public function search(Request $request)
//    {
//        if($request->ajax())
//        {
//            $output="";
//            $products=Post::where('id','LIKE','%'.$request->search."%")
//                            ->orwhere('post_title','LIKE','%'.$request->search."%")
//                            ->orwhere('address','LIKE','%'.$request->search."%")
//                            ->orwhere('email','LIKE','%'.$request->search."%")
////                            ->orwhere('category_id','LIKE','%'.$request->search."%")
////                            ->orwhere('status','LIKE','%'.$request->search."%")
//                            ->orwhere('monthly_rent','LIKE','%'.$request->search."%")
//                            ->get();
//
//            $data = $products->count();
//            if($data > 0)
//            {
//                $i=1;
//                foreach ($products as $product) {
//                    $output.='<tr>'.
//
//                        '<td>'.$i++.'</td>'.
//                        '<td>'.$product->post_title.'</td>'.
////                        '<td>'.$product->category->category_name.'</td>'.
//                        '<td>'.$product->bedrooms.'</td>'.
//                        '<td>'.$product->batherooms.'</td>'.
//                        '<td>'.$product->balconies.'</td>'.
//                        '<td>'.$product->monthly_rent.'</td>'.
//                        '<td>'.$product->address.'</td>'.
//                        '<td>'.$product->email.'</td>'.
//                        '<td>'.$product->mobile_no.'</td>'.
//                            '<a href="'. route('admin.post.show'.','.$product->id ).'" class="btn btn-success btn-xs"><i class="fa fa-eye" title="View"></i></a>'.
//                        '<td>'.
//
//                    '</tr>';
//                }
//
//            }
//            else{
//                $output.='<tr>'.
//
//                    '<td>No data found</td>'.
//
//                    '</tr>';
//            }
//
//            return Response($output);
//        }
//
//    }
    //=============Ajax Search Ends=================

}
