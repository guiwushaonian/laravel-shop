<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Http\Request;
use Cache;
use League\Flysystem\Exception;

class EmailVerificationController extends Controller
{
    // 邮箱激活
    public function verify(Request $request)
    {
        $email = $request->input('email');
        $token = $request->input('token');

        if (!$email || !$token) {
            throw new InvalidRequestException('验证链接不正确');
        }

        if ($token != Cache::get('email_verification_' . $email)) {
            throw new InvalidRequestException('验证码已过期或不正确');
        }

        if (!$user = User::where('email', $email)->first()) {
            throw new InvalidRequestException('用户不存在');
        }

        Cache::forget('email_verification_' . $email);

        $user->email_verified = true;
        $user->save();

        return view('pages.success', ['msg' => '邮箱验证成功']);
    }

    // 重新发送激活邮件
    public function send(Request $request)
    {
        $user = $request->user();
        if ($user->email_verified) {
            throw new InvalidRequestException('您已经验证过邮箱了');
        }

        // 调用 notify() 方法用来发送我们定义好的通知类
        $user->notify(new EmailVerificationNotification());
        return view('pages.success', ['msg' => '邮件发送成功']);
    }
}
