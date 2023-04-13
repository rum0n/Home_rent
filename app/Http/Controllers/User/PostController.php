<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\Post;
use App\User;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminNewPost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;

        $posts = Post::where('user_id',$id)
                    ->orderby('id','DESC')
                    ->paginate(6);

        $post_approve = Post::where('user_id',$id)->where('is_approved',2)->get();

        $pending_post = Post::where('user_id',$id)->where('is_approved',1)->get();

        $rejected_post = Post::where('user_id',$id)->where('is_approved',0)->get();

        return view('user.post.index',compact('posts','post_approve','pending_post','rejected_post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('user.post.add_post', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'mobile_no' => 'required|numeric',
            'file' => 'required',
            'file.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'created_at' => Carbon::now()
        ]);

        $images = array();
        $files = $request->file('file');
        $count = 1;

        foreach($files as $x){
            $picName = $x->getClientOriginalName();
            $fileName = time().$count.$picName;
            $destinationPath = public_path('frontEnd/thumbnail');

            //     $fileName = 'frontEnd/postPic'.$fileName;

            $img = Image::make($x->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileName);

            $x->move(public_path('frontEnd/postPic'),$fileName);

            $count++;
            $images[]=$fileName;
        }
        $user_id = Auth::user()->id;

        $last_insert_id = Post::insertGetId([
            'user_id' => $user_id,
            'post_title' => $request->post_title,
            'category_id' => $request->category_id,
            'bedrooms' => $request->bedrooms,
            'batherooms' => $request->batherooms,
            'balconies' => $request->balconies,
            'monthly_rent' => $request->monthly_rent,
            'address' => $request->address,
            'lat' => $request->lat,
            'lon' => $request->lon,
            'description' => $request->description,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'post_picture' => implode("|",$images),
            'created_at' => Carbon::now()
        ]);



        $last_post = Post::findOrFail($last_insert_id);
        $all_user = User::where('role_id',1);
        $total_admin = $all_user->count();
        
        if($total_admin > 0){
            foreach ($all_user as $all_admin) {
                
                $admin_email = $all_admin->email;
                 Notification::route('mail',$admin_email)->notify(new AdminNewPost($last_post));
               
            }
        }

        Toastr::success('Successfully Added !' ,'Post');
        return redirect('/user/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('user.post.show',compact('post'));
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
        return view('user.post.edit',compact('post','categories'));
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
//        dd($request->all());
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

        if($post->is_approved == 0){
            $post->is_approved = 1;
        }

        $images = array();
        $files = $request->file('post_picture');
        $count = 1;

        $pic = $post->post_picture;

        if ($pic != ""){
            foreach(explode('|', $pic) as $x){
                $images[] = $x;
            }
        }

        if ($request->hasFile('post_picture')) {
            foreach ($files as $x) {
                $picName = $x->getClientOriginalName();
                $fileName = time() . $count . $picName;
                $destinationPath = public_path('frontEnd/thumbnail');

                $img = Image::make($x->getRealPath());
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$fileName);

                $x->move(public_path('frontEnd/postPic'),$fileName);

                $count++;
                $images[] = $fileName;
            }
        }
//        dd($images);

        $post->post_picture = implode("|",$images);
        $post->save();

        Toastr::success('Successfully Updated !' ,'Post');
        return redirect()->route('user.post.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
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

        Toastr::success('Successfully Deleted !' ,'Post');
        return redirect()->route('user.post.index');
    }


    // =============Single Picture Delete =============
    public function deletePic($id, $pic_name)
    {
//        dd($id,$pic_name);

        $post = Post::find($id);
        $pic = $post->post_picture;
        $images = array();
        if ($pic != ""){
            foreach(explode('|', $pic) as $x){
                $images[]=$x;
            }
        }
//        $count = count($images);

        $new_images=array();

        foreach( $images as $x){

            if($x != $pic_name ){
                $new_images[] = $x;
            }
            elseif($x == $pic_name){
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

        $pics = implode("|", $new_images);
//        dd($pic_name,$new_images);

        $post->post_picture = $pics ;
        $post->save();

        Toastr::success('Successfully Deleted !' ,'Image');
        return back();
    }


}
