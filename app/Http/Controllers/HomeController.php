<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $content = Content::first();
        return view('Admin.content',compact('content'));
    }

    public function setting(){
        return view('admin.setting');
    }
    public function redirect(){
        $home = '/4mediapanel';
        if(Auth::user()->user_type == 'user'){
            $home= '/';
        }
        return redirect($home);
    }
    public function show($id){
        $user = Auth::user();
        $notify = $user->notifications()->findOrFail($id);

        $notify->markAsRead();

        if(asset($notify->data['url']) && $notify->data['url']){
            return  redirect($notify->data['url']);
        }

        return redirect()->back();
    }
    public function showAll(){
        $user = Auth::user();
    }
}
