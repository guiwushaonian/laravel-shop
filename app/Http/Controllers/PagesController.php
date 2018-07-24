<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // 主页
    public function root()
    {
        return view('pages.root');
    }

    // 邮箱未验证提示页面
    public function emailVerifyNotice(Request $request)
    {
        return view('pages.email_verify_notice');
    }
}
