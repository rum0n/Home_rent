<?php

namespace App\Http\Controllers;


use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SubscriberController extends Controller
{
    public function subscribe(Request $request)
    {
    //  dd($request->all());

        $this->validate($request,[
            'email' => 'required|email|unique:subscribers'
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();


        return redirect()->back();
    }
}
