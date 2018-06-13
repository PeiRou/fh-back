<?php

namespace App\Http\Controllers\Home;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Notices;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index(){
        $backEndUrl = Config::get('website.backEndUrl');
        if($_SERVER['HTTP_HOST'] == $backEndUrl[0] || $_SERVER['HTTP_HOST'] == $backEndUrl[1]){
            return redirect()->route('back.login');
        }
        $captcha = CaptchaController::makeCaptcha();
        $articleUp = Article::where('up',1)->orderBy('created_at','desc')->take(2)->get();
        $article = Article::where('up',0)->orderBy('created_at','desc')->take(18)->get();

        $notice = Notices::where('type',3)->orderBy('created_at','desc')->first();

        $bets = $this->getBets()->shuffle();
        $data = [
            'mssc'      => $this->getMssc(),
            'msssc'     => $this->getMsssc(),
            'msft'      => $this->getMsft(),
            'cqssc'     => $this->getCqssc(),
            'bjpk10'    => $this->getBjpk10(),
            'notices'   => $this->getNotice(),
            'bets'      => $bets,
        ];
//        if($bets->count()>0){
//            $betsSix = $bets->random(2);
//            $_bets = $betsSix->map(function ($itme,$index){
//                $_arr = [
//                    'username' => user_substr($itme->username),
//                    'bunko'    => sprintf('%.2f',rand(10000,300000)),
//                ];
//                return $_arr;
//            })->sortByDesc('bunko')->toArray();
//            $_betsSix = array_values($_bets);
//            $data['_betsSix'] = $_betsSix;
//        }
        return view('home.homeIndex',compact('captcha','articleUp','article','notice','data')); //500万
//        return view('home.aicaipiao_views.homeIndex',compact('captcha')); //爱彩票
    }

    /**
     * @return mixed
     */
    public function getMssc(){
        $mssc = DB::table('game_mssc')->orderBy('id','DESC')->first();
        return $mssc;
    }

    /***
     * @return mixed
     */
    public function getMsssc(){
        $msssc = DB::table('game_msssc')->orderBy('id','DESC')->first();
        return $msssc;
    }

    /***
     * @return mixed
     */
    public function getMsft(){
        $msft = DB::table('game_msft')->orderBy('id','DESC')->first();
        return $msft;
    }

    /****
     * @return mixed
     */
    public function getCqssc(){
        $cqssc = DB::table('game_cqssc')->orderBy('id','DESC')->first();
        return $cqssc;
    }

    /****
     * @return mixed
     */
    public function getBjpk10(){
        $bjpk10 = DB::table('game_bjpk10')->orderBy('id','DESC')->first();
        return $bjpk10;
    }

    /***
     * @return mixed
     */
    public function getNotice(){
        //取推广公告
        $notices = Notices::where('type',3)->orderBy('id','DESC')->get(['title','content']);
        return $notices;
    }

    public function getBets(){
        $bets = DB::table('bet')
            ->join('users','bet.user_id','=','users.id')
            ->whereBetween('bet.created_at',[Carbon::today()->toDateTimeString(),Carbon::tomorrow()->toDateTimeString()])
            ->where('bet.bunko','>',0)
            ->where('bet.testFlag',0)
            ->offset(0)
            ->limit(100)
            ->get(['users.username','bet.bunko','bet.created_at','game_id']);  //['users.username','bet.bunko']
        return $bets;
    }

    public function getOpen(){
        $data = [
            'mssc'      => $this->getMssc(),
            'msssc'     => $this->getMsssc(),
            'msft'      => $this->getMsft(),
            'cqssc'     => $this->getCqssc(),
            'bjpk10'    => $this->getBjpk10(),
        ];
        return response()->json([$data],200);
    }
}
