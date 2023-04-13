<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id',2)->paginate(3);


         $notification_post = Post::where('is_approved',1);
         $total_npost = $notification_post->count();

        return view('admin.users.index', compact('users','total_npost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $user = User::where('id',$id)->first();
        $user = User::findOrFail($id);

        if (file_exists($user->pic)) {
            unlink($user->pic);
        }

        $user->delete();

        Toastr::success('Successfully Deleted !' ,'User');
        return redirect()->route('admin.users.index');
    }

//==========Block Unblock User=============
    public function blockUnblock($id)
    {
        $user = User::findOrFail($id);

        $status =(($user->is_approved == 1)? 0:1);

        $user->is_approved = $status;
        $user->save();

        Toastr::success('Action Done !' ,'Success');
        return redirect()->back();
    }

    //==========Promote Demote User=============
    public function promoteDemote($id)
    {
        $user = User::findOrFail($id);

        $status =(($user->role_id == 1)? 2:1);

        $user->role_id = $status;
        $user->save();

        Toastr::success('Action Done !' ,'Success');
        return redirect()->back();
    }



}
