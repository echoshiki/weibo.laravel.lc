<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function __construct() {
        # 十分钟只能发送三次重置密码邮件
        $this->middleware('throttle:3,10', [
            'only' => ['sendResetLinkEmail']
        ]);
    }

    public function showLinkRequestForm() {
        # 忘记密码页面
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request) {
        # 1. 验证邮箱格式以及是否存在
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $email = $request->email;
        
        # 2. 验证邮箱是否存在
        $user = User::where('email', $email)->first();

        # 3. 如果不存在
        if (!$user) {
            session()->flash('danger', '邮箱地址不存在');
            return redirect()->back()->withInput();
        } 

        # 4. 邮箱存在生成 token
        $token = hash_hmac('sha256', Str::random(40), config('app.key'));

        # 5. 存储 token
        DB::table('password_reset_tokens')->updateOrInsert(['email'=>$email],[
            'email' => $email,
            'token' => Hash::make($token),
            'created_at' => new Carbon,
        ]);

        // 6. 将 Token 链接发送给用户
        Mail::send('emails.reset_link', compact('token'), function ($message) use ($email) {
            $message->to($email)->subject("忘记密码");
        });

        session()->flash('success', '重置邮件发送成功，请查收');
        return redirect()->back();
        
    }

    public function showResetForm(Request $request) {
        # 重置密码页面
        // $token = $request->route()->parameter('token');
        // return view('auth.passwords.reset', compact('token'));
        return view('auth.passwords.reset', ['token' => $request->token]);
    }

    public function reset(Request $request) {
        # 1. 验证数据是否合规
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);
        $token = $request->token;
        $email = $request->email;

        # 2. 找回密码链接的有效时间
        $expires = 60 * 100;

        # 3. 获取对应用户
        $user = User::where('email', $email)->first();

        # 4. 如果不存在
        if (!$user) {
            session()->flash('danger', '所输入的邮箱不存在！');
            return redirect()->back()->withInput();
        }
        
        # 5. 获取重置密码记录
        $record = (array)DB::table('password_reset_tokens')->where('email', $email)->first();
        if ($record) {
            # 5.1 使用 Carbon 类检查时间是否过期
            if (Carbon::parse($record['created_at'])->addSeconds($expires)->isPast()) {
                session()->flash('danger', '重置链接已过期，请重新发送');
                return redirect()->back();
            }

            # 5.2 通过 Hash 类检查 token 是否正确
            if (!Hash::check($token, $record['token'])) {
                session()->flash('danger', '令牌错误');
                return redirect()->back();
            }

            # 5.3 一切正常，修改更新密码
            $user->password = bcrypt($request->password);
            $user->save();

            # 5.4 提示更新成功，跳转登录页面
            session()->flash('success', '重置密码成功');
            return redirect()->route('login');
        }

        # 6. 未找到重置密码记录
        session()->flash('danger', '未找到重置密码记录');
        return redirect()->back();

    }
}
