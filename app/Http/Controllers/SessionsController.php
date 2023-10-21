<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials, $request->has('remember'))) {
            # 验证通过
            session()->flash('success', '欢迎回来!');
            # 成功后返回跳转登陆前的页面，没有就返回默认值
            $fallback = route('users.show', [Auth::user()]);
            return redirect()->intended($fallback);
        } else {
            # 验证失败
            session()->flash('danger', '很抱歉,您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出!');
        return redirect()->route('login');
    }
}
