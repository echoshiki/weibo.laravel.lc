<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        // 未登录用户限制策略
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
        ]);

        $this->middleware('guest', [
            'only' => ['create', 'store']
        ]);

        # 限流 一个小时内只能提交 10 次注册请求；
        $this->middleware('throttle:10,60', [
            'only' => ['store']
        ]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');

        // 注册之后直接登录
        // Auth::login($user);
        // session()->flash('success', '欢迎,您将在这里开启一段新的旅程~');
        // return redirect(route('users.show', ['user' => $user]));

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        # 获取用户所有发布的微博
        $statuses = $user->statuses()->orderBy('created_at', 'desc')->paginate(10);

        return view('users.show', compact('user', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // 执行验证策略
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
        $data = [];
        $data['name'] = $request->name;
        # 值不为空时再赋值
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', '个人资料更新成功!');
        return redirect()->route('users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户!');
        return back();
    }

    public function sendEmailConfirmationTo(User $user) {
        $view = 'emails.confirm';
        // 邮件视图里会调用
        $data = compact('user');
        $to = $user->email;
        $subject = "感谢注册 Weibo 应用!请确认你的邮箱。";

        Mail::send($view, $data, function($message) use ($to, $subject) {
            $message->to($to)->subject($subject);   
        });

        // .env 文件中配置 log 的发送方式
        // $from = 'summer@qq.com';
        // $name = 'Summer';
        // Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
        //     $message->from($from, $name)->to($to)->subject($subject);
        // });       
    }

    // Request $token & $token 区别
    // 前者声明了参数为一个请求对象，需要用例如 $token->token 或者 $token->get('token') 这样的方式取值
    // 后者只是单纯的参数，无限制，直接 $token 使用即可
    public function confirmEmail(Request $request) {
        $user = User::where('activation_token', $request->token)->firstOrFail();
        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你,激活成功!');
        return redirect()->route('users.show', ['user' => $user]);
    }

    # 关注列表
    public function followings(User $user) {
        $users = $user->followings()->paginate(27);
        $title = $user->name . '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

    # 粉丝列表
    public function followers(User $user) {
        $users = $user->followers()->paginate(27);
        $title = $user->name . '的粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }
}
