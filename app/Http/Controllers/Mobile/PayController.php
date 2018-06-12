<?php

namespace App\Http\Controllers\Mobile;

use App\Banks;
use App\Http\Proxy\PayJump;
use App\PayOnline;
use App\PayType;
use App\Recharges;
use App\RechType;
use App\User;
use App\UserBank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use GuzzleHttp\Client;

class PayController extends Controller
{
    protected $payJump;
    /**
     * PayController constructor.
     */
    public function __construct(PayJump $payJump)
    {
        $this->payJump = $payJump;
    }

    public function getUserRechConfig()
    {
        $data = PayOnline::select('checkType','domain','id','levels','max_money as maxMoney','min_money as minMoney','payType as onlineType','pageDesc','paramId','payee','payeeName','prodName','qrCode','rebate_or_fee as rebateFee','rechName','rechType','remark','req_url as reqUrl','sort')
            ->where('status',1)->get();
        return response()->json([
            'rechCfgs' => $data
        ]);
    }

    public function bankSave(Request $request)
    {
        $cfgId = $request->get('cfgId');
        $rechMoney = $request->get('rechMoney');
        $realName = $request->get('realName');
        $rechTime = $request->get('rechTime');
        $authCode = $request->get('authCode');
        $payeeInfo = $request->get('payeeInfo');
        $user = JWTAuth::toUser($request->token);

        $getRechType = PayOnline::where('id',$cfgId)->first();
        $rechBank = Banks::where('bank_id',$getRechType->paramId)->first();

        if($getRechType->rechType == 'bankTransfer'){
            $shou_info = "收款人：$getRechType->payeeName<br> 收款银行：$rechBank->name<br> 账号：$getRechType->payee";
            $ru_info = "入款人：$realName<br> 入款时间：$rechTime";
        }
        if($getRechType->rechType == 'weixin'){
            $shou_info = "微信名称：$getRechType->payeeName<br> 微信账号：$getRechType->payee";
            $ru_info = "微信号：$realName<br> 转账时间：$rechTime";
        }
        if($getRechType->rechType == 'alipay'){
            $shou_info = "名称：$getRechType->payeeName<br> 支付宝账号：$getRechType->payee";
            $ru_info = "支付宝昵称：$realName<br> 转账时间：$rechTime<br> 认证姓名：$payeeInfo";
        }
        if($getRechType->rechType == 'cft'){
            $shou_info = "财付通名称：$getRechType->payeeName<br> 财付通账号：$getRechType->payee";
            $ru_info = "财付通号：$realName<br> 转账时间：$rechTime";
        }
        $recharges = new Recharges();
        $recharges->userId = $user->id;
        $recharges->username = $user->username;
        $recharges->pay_online_id = $cfgId;
        $recharges->orderNum = payOrderNumber();
        $recharges->payType = $getRechType->rechType;
        $recharges->amount = $rechMoney;
        $recharges->rechargeType = 0;
        $recharges->shou_info = $shou_info;
        $recharges->ru_info = $ru_info;
        $recharges->status = 1;
        $save = $recharges->save();
        if($save == 1){
            return response()->json([
                'status'=>true,
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'提交失败，请稍后再试！'
            ]);
        }
    }

    public function getAuthCode(Request $request)
    {
        $randCode = rand(0001,9999);
        return response()->json([
            'result' => (string)$randCode
        ]);
    }
    
    public function getOtherRechConfig()
    {
        $rechType = RechType::select('name','onlineType','rechType')->get();
        $otherRechTypeMap = [
            1 => 'WY',
            2 => 'ZFB',
            3 => 'WX',
            4 => 'QQ',
            5 => 'UW',
            6 => 'XYK',
            7 => 'BD',
            8 => 'JD',
            9 => 'YL'
        ];
        $onlineTypes = PayType::all();
        return response()->json([
            'bankMap'=>[],
            'otherRechTypeMap' => $otherRechTypeMap,
            'rechTypeSortList' => $rechType,
            'onlineTypes' => $onlineTypes
        ]);
    }
    
    //在线支付-mobile
    public function onlinePay(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $amount = $request->amount;
        $rechId = $request->rechId;
        $backUrl = $request->backUrl;
        $payId = $request->payId;

        if($amount == "" || $amount <= 0){
            return response()->json([
                'success' => false,
                'msg' => '充值金额不正确'
            ],500);
        }
        if($rechId == ""){
            return response()->json([
                'success' => false,
                'msg' => '商户ID参数不正确'
            ],500);
        }
        return $this->payJump->go($rechId,$amount,$user);

//        return response()->json([
//            'userId' => $user->id,
//            'amount' => $amount,
//            'rechId' => $rechId
//        ]);
    }

    public function getUserBank(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $getBank = UserBank::where('user_id',$user->id)->first();
        if($getBank){
            return response()->json([
                'addTime' => $getBank->created_at,
                'bankName' => $getBank->bank_name,
                'cardNo' => '尾号'.substr($getBank->cardNo,-4),
                'subAddress' => $getBank->subAddress,
                'userId' => $user->id
            ]);
        }
        return $getBank;
    }
    
    //提现
    public function withdrawSubmit(Request $request)
    {
        $ip = $request->getClientIp();
        $user = JWTAuth::toUser($request->token);
        $amount = $request->amount;
        $fundPwd = $request->fundPwd;
        if($user->fundPwd == null){
            return response()->json([
                'success' => false,
                'code'=> 102,
                'msg' => '提款密码暂未设置，请先设置提款密码'
            ],500);
        } else {
            if(Hash::check($fundPwd,$user->fundPwd)){
                $http = new Client();
                $res = $http->request('GET',"http://ip-api.com/json/$ip?lang=zh-CN");
                $jsonIp = json_decode((string) $res->getBody(), true);

                $insert = DB::table('drawing')->insert([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'created_at' => date('Y-m-d H:i:s'),
                    'balance' => (int)$user->money-(int)$amount,
                    'total_bet' => 0,
                    'order_id' => $this->orderNumber(),
                    'amount' => $amount,
                    'ip' => $ip,
                    'ip_info' => $jsonIp['country'].$jsonIp['regionName'].$jsonIp['city'].'-'.$jsonIp['isp'],
                    'draw_type' => 1,
                    'status' => 0,
                    'platform' => 2
                ]);

                if($insert == 1){

                    $updateUserMoney = DB::table('users')->where('id',$user->id)->update([
                        'money' => (int)$user->money-(int)$amount
                    ]);

                    if($updateUserMoney == 1){
                        return response()->json([
                            'success' => true,
                            'msg' => '提款申请已提交，请等待客服审核'
                        ],200);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'code' => 103,
                        'msg' => '提款服务暂不可用，请稍后再试'
                    ],500);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'code' => 101,
                    'msg' => '输入的资金密码不正确; 请核对后再次尝试'
                ],500);
            }
        }

    }

    function orderNumber(){
        $c = "D";
        $date = date('YmdHis');
        $randnum = rand(10000000,99999999);
        return $c.$date.$randnum;
    }

    public function bankList()
    {
        $getBank = DB::table('bank')->where('status',1)->get();
        $data = [];
        foreach ($getBank as $item){
            $data[] = [
                'id'=>$item->bank_id,
                'name' => $item->name,
                'value' => $item->eng_name
            ];
        }
        return response()->json($data);
    }

    public function bindBank(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $bankid = $request->bankName;
        $cardNo = $request->cardNo;
        $subAddress = $request->subAddress;

        $getBankName = DB::table('bank')->where('bank_id',$bankid)->first();

        $checkUserBank = UserBank::where('user_id',$user->id)->count();
        if($checkUserBank > 0){
            $update = UserBank::where('user_id',$user->id)
                ->update([
                    'bank_name' => $getBankName->name,
                    'subAddress' => $subAddress,
                    'cardNo' => $cardNo,
                    'bank_id' => $bankid
                ]);
            if($update == 1){
                return response()->json([
                    'status'=>true
                ]);
            } else {
                return response()->json([
                    'status'=>false
                ]);
            }
        } else {
            $bank = new UserBank();
            $bank->user_id = $user->id;
            $bank->bank_name = $getBankName->name;
            $bank->bank_id = $bankid;
            $bank->subAddress = $subAddress;
            $bank->cardNo = $cardNo;
            $save = $bank->save();
            if($save == 1){
                return response()->json([
                    'status'=>true
                ]);
            } else {
                return response()->json([
                    'status'=>false
                ]);
            }
        }
    }
}
