<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;



class StaticPagesController extends Controller
{
    public function home() { 
        $feed_items = [];
        if (Auth::check()) {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $feed_items =$user->feed()->paginate(30);
        }
        return view('static_pages/home', compact('feed_items'));
    }
    
    public function about() {
        return "关于页面";
    }

    public function contact() {
        return view('contact');
    }

    public function help() {
        return view('help');
    }

}
