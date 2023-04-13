<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
//        $posts = Post::latest()->get();

        $posts = Post::orderBy('id', 'DESC')
                ->where('is_approved',2)
                ->paginate(5);

        $recent_posts = Post::orderBy('id', 'DESC')
            ->where('is_approved',2)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('frontEnd.home.homeContent', compact('posts','recent_posts'));
    }

    public function single_post($id)
    {
        $post = Post::find($id);

        return view('frontEnd.home.singlePost', compact('post'));
    }


    //============= Search House =================
    public function search(Request $request)
    {
        $posts=Post::where('post_title','LIKE','%'.$request->search."%")
            ->orwhere('address','LIKE','%'.$request->search."%")
            ->orwhere('category_id','LIKE','%'.$request->search."%")
            ->orwhere('email','LIKE','%'.$request->search."%")
            ->orwhere('monthly_rent','LIKE','%'.$request->search."%")
            ->where('is_approved',2)
            ->orderBy('id','DESC')
            ->paginate(5);


        $rows = $posts->count();

        $message = $request->search;
//        $results = 'About '.$rows.'results found';

        return view('frontEnd.home.search', compact('posts','rows','message'));

    }

    public function filter(Request $request)
    {
        $posts=Post::where('monthly_rent','LIKE','%'.$request->monthly_rent."%")
            ->where('address','LIKE','%'.$request->address."%")
            ->where('is_approved',2)
            ->orderBy('id','DESC')
            ->paginate(5);

        return view('frontEnd.home.filter', compact('posts'));
    }





}
