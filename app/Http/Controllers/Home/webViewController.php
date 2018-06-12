<?php

namespace App\Http\Controllers\Home;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class webViewController extends Controller
{
    public function cooperation()
    {
        $captcha = CaptchaController::makeCaptcha();
        return view('home.500_views.cooperation',compact('captcha')); //500
        //return view('home.aicaipiao_views.cooperation',compact('captcha')); //爱彩票
    }

    public function article($id = "")
    {
        $article = Article::where('id',$id)->first();
        return view('home.500_views.article',compact('captcha','article')); //500
    }

    public function about()
    {
        $captcha = CaptchaController::makeCaptcha();
        return view('home.500_views.about',compact('captcha'));
    }

    public function contact()
    {
        $captcha = CaptchaController::makeCaptcha();
        return view('home.500_views.contact',compact('captcha'));
    }

    public function register()
    {
        $captcha = CaptchaController::makeCaptcha();
        return view('home.500_views.register',compact('captcha')); //500
        //return view('home.aicaipiao_views.register',compact('captcha')); //爱彩票
    }

    public function login()
    {
        $captcha = CaptchaController::makeCaptcha();
        return view('home.500_views.login',compact('captcha'));
    }

    public function deposit()
    {
        $captcha = CaptchaController::makeCaptcha();
        return view('home.500_views.deposit',compact('captcha')); //500
        //return view('home.aicaipiao_views.deposit'); //爱彩票
    }

    public function withdraw()
    {
        $captcha = CaptchaController::makeCaptcha();
        return view('home.500_views.withdraw',compact('captcha'));
    }

    public function questions()
    {
        $captcha = CaptchaController::makeCaptcha();
        return view('home.500_views.questions',compact('captcha')); //500
//        return view('home.aicaipiao_views.questions'); //爱彩票
    }

    public function promotions()
    {
        $captcha = CaptchaController::makeCaptcha();
        return view('home.500_views.promotions',compact('captcha')); //500
//        return view('home.aicaipiao_views.promotions'); //爱彩票
    }

    public function phone()
    {
        return view('home.aicaipiao_views.phone'); //爱彩票
    }
}
