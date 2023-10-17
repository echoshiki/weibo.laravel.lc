<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home() {
        return view('static_pages/home');
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
