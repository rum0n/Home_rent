<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactMessage;
use Mail;

use Illuminate\Support\Facades\Notification;
use App\Notifications\PostAccept;
use App\Notifications\SubscriverPost;
use App\Notifications\PostRejected;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderBy('id','DESC')->paginate(5);
        $notification_post = Post::where('is_approved',1);
        $total_npost = $notification_post->count();
        // dd($total_npost);

        return view('admin.home.dashboard', compact('posts','total_npost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
         $notification_post = Post::where('is_approved',1);
         $total_npost = $notification_post->count();
        return view('admin.post.show',compact('post','total_npost'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Post $post)
    {
        $categories = Category::all();
        $notification_post = Post::where('is_approved',1);
         $total_npost = $notification_post->count();

        return view('admin.post.edit',compact('post','categories','total_npost'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Post $post)
    {

        $this->validate($request,[
            'post_title' => 'required',
            'category_id' => 'required',
            'bedrooms' => 'required|numeric',
            'batherooms' => 'required|numeric',
            'balconies' => 'required|numeric',
            'monthly_rent' => 'required|numeric',
            'description' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'mobile_no' => 'required',
            'post_picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $post->post_title = $request->post_title;
            $post->category_id = $request->category_id;
            $post->bedrooms = $request->bedrooms;
            $post->batherooms = $request->batherooms;
            $post->balconies = $request->balconies;
            $post->monthly_rent = $request->monthly_rent;
            $post->address = $request->address;
            $post->description = $request->description;
            $post->email = $request->email;
            $post->mobile_no = $request->mobile_no;

            $images = array();
            $files = $request->file('post_picture');
            $count = 1;

            if ($request->hasFile('post_picture')) {
                $pic=$post->post_picture;

                if ($pic != ""){
                    foreach(explode('|', $pic) as $x){

                        $pic_path = public_path().'/frontEnd/postPic/'.$x;

                        if (file_exists($pic_path)) {
                            unlink($pic_path);
                        }
                    }
                }
                foreach ($files as $x) {
                    $picName = $x->getClientOriginalName();
                    $fileName = time() . $count . $picName;
                    $x->move(public_path('frontEnd/postPic'), $fileName);
                    //     $fileName = 'frontEnd/postPic'.$fileName;
                    $count++;
                    $images[] = $fileName;
                }
                $post->post_picture = implode("|",$images);
            }

            $post->save();
            

            Toastr::success('Successfully Updated !' ,'Post');
            return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $pic=$post->post_picture;

        if ($pic != ""){
            foreach(explode('|', $pic) as $x){
                $pic_path = public_path().'/frontEnd/postPic/'.$x;
                if (file_exists($pic_path)) {
                    unlink($pic_path);
                }
            }
        }

        $post->delete();

        Toastr::success('Successfully Deleted !' ,'Post');
        return redirect()->route('admin.post.index');
    }


    //===========Accept Post=============

    public function accept_post($id)
    {
        $post = Post::find($id);

//        $status =(($post->is_approved == 0)? 1:0);
        $status = $post->is_approved;

        if($status == 1){
            $status = 2;
        }

        $post->is_approved = $status;
        $post->save();

        // Message send to Subscriber
        $subscriber = Subscriber::all();
        $total_sub = count($subscriber);
        
         // dd($subscriber_email);
        if($total_sub > 0){
            foreach ($subscriber as $sub) {
                $subscriber_email = $sub->email;
                 Notification::route('mail',$subscriber_email)->notify(new SubscriverPost($post));
               
            }
            
            
            // Notification::route('mail',$subscriber_email)->notify(new SubscriverPost($post));
            }
        $user_email = $post->email;
        Notification::route('mail',$user_email)->notify(new PostAccept($post));

        Toastr::success('has been accepted !' ,'Post');
        return redirect()->back();
    }


    //===========Reject Post=============
    public function reject_post($id)
    {
        $post = Post::find($id);

        $status = $post->is_approved;

        if($status == 1){
            $status = 0;
        }

        $post->is_approved = $status;
//        dd($status);
        $post->save();
        

        // Message send to User
         $user_email = $post->email;
         Notification::route('mail',$user_email)->notify(new PostRejected($post));

        Toastr::success('has been rejected !' ,'Post');
        return redirect()->back();
    }


    public function rejected_post()
    {
        $rejected_post = Post::where('is_approved',0)->orderBy('id','DESC')->paginate(7);
        $notification_post = Post::where('is_approved',1);
        $total_npost = $notification_post->count();

        return view('admin.post.rejected_post',compact('rejected_post','total_npost'));
    }


    public function deleted()
    {
        $deleted_post = Post::onlyTrashed()->get();
        $notification_post = Post::where('is_approved',1);
        $total_npost = $notification_post->count();

        return view('admin.post.deleted_post',compact('deleted_post','total_npost'));
    }


    public function restore($id)
    {
        Post::withTrashed()->find($id)->restore();

        Toastr::success('Restored Successfully !' ,'Post');
        return back();
    }

    public function permanent_delete($id)
    {
        $post=Post::withTrashed()->find($id);

        $pic=$post->post_picture;

        if ($pic != ""){
            foreach(explode('|', $pic) as $x){
                $pic_path = public_path().'/frontEnd/postPic/'.$x;

                $pic_path2 = public_path().'/frontEnd/thumbnail/'.$x;
                if (file_exists($pic_path)) {
                    unlink($pic_path);
                }
                if (file_exists($pic_path2)) {
                    unlink($pic_path2);
                }
            }
        }
        $post->forceDelete();

        Toastr::success('Permanently deleted !' ,'Post');
        return back();
    }

}
