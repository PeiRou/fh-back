<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class CaptchaController extends Controller
{
   public static function makeCaptcha(){
       $phraseBuilder   = new PhraseBuilder(4, '0123456789');
       $captcha         = new CaptchaBuilder(null, $phraseBuilder);
       $captcha->build();
       session(['captcha'=>$captcha->getPhrase()]);
       return $captcha;
   }

   public function getCaptcha(){
       $captcha = self::makeCaptcha();
       return response()->json([$captcha->inline()],200);
   }
}
