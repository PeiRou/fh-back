<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/3/23
 * Time: 下午10:14
 */

namespace App\Http\Proxy;


use App\Http\Controllers\Mobile\Classes\PAY_XINGPU_handle_RSA;
use App\PayOnline;
use App\PayType;
use App\Recharges;

class PayJump
{
    public function go($payOnlineId,$amount,$userInfo)
    {
        $findPayOnlineData = PayOnline::where('id',$payOnlineId)->first();
        $findPayTypeData = PayType::where('id',$findPayOnlineData->payType)->first();
        $orderNum = $this->orderNumber();
        $now = date('Y-m-d H:i:s');
        $payType = $findPayOnlineData->rechType;
        if($payType == 'onlinePayment'){
            $operation_id = null;
            $operation_account = null;
            $shou_info = "商户号：$findPayOnlineData->apiId<br>$findPayTypeData->rechName";
            $ru_info = "入款人：$userInfo->username <br> 充值银行：$findPayTypeData->rechName <br> 充值时间：$now";
            $status = 4;
            $rechargeType = 1;
        } else {
            $rechargeType = 0;
        }
        //存入订单数据
        $saveTo = new Recharges();
        $saveTo->userId = $userInfo->id;
        $saveTo->username = $userInfo->username;
        $saveTo->pay_online_id = $payOnlineId;
        $saveTo->orderNum = $orderNum;
        $saveTo->payType = $payType;
        $saveTo->operation_id = $operation_id;
        $saveTo->operation_account = $operation_account;
        $saveTo->shou_info = $shou_info;
        $saveTo->ru_info = $ru_info;
        $saveTo->rechargeType = $rechargeType;
        $saveTo->amount = $amount;
        $saveTo->status = $status;
        $save = $saveTo->save();
        if($save == 1){
            switch ($findPayTypeData->company){
                case 'RENXIN':
                    return $this->renXin($findPayTypeData->code,$findPayOnlineData,$amount,$orderNum);
                    break;
                case 'XINEFU':
                    return $this->xinEfu($findPayTypeData->code,$findPayOnlineData,$amount,$orderNum);
                    break;
                case 'HUIFUBAO':
                    return $this->huifubao($findPayTypeData->code,$findPayOnlineData,$amount,$orderNum);
                    break;
                case 'XINGPU':
                    return $this->xingpu($findPayTypeData->code,$findPayOnlineData,$amount,$orderNum);
                    break;
            }
        } else {
            return '呵呵';
        }
    }

    function orderNumber(){
        $c = "PAY";
        $date = date('YmdHis');
        $randnum = rand(10000000,99999999);
        return $c.$date.$randnum;
    }

    public function xingpu($code,$data,$amount,$orderNum){
        if($code == 'WX'){
            $str='MIICdQIBADANBgkqhkiG9w0BAQEFAASCAl8wggJbAgEAAoGBAM4NTZsNvoPSucKslw4HZCWwgQj0Cu85CVqIahwSOINWD9hNWLeBjKhR/SHieMf4lu5+xfao4VWkqtG4n5bYgEw+fE+hGLwBNEPpCpCI1SIWk2zgJXJEFJr910fnEZomR1J1Q20/gu7YMFHaM2T5c0TV15xI8X6efHnJ+PlFLjTFAgMBAAECgYBuY0YeOUDFkpEeMCREycTnRCX8y/FHs8DFFavzGffYtLSMZvOObAMU8cew7YlTaGRDpPsdZ+BAZ5V0AXrN73Lbb5gRxOoDcWs6C0yu5tfqVYPbt2dvuJ0qLPtqWb3ivnLC7qYP6K2GRTHmaWwzLD6O4WX/iswVrwO7QoNh478pwQJBAO+OkSwn5ThJ5n1awbyC4FYr1SPnUgYReYYiZ0bjvOS5Y3xIir5JOzr6mSlYoX51digML5er8314q3wmoXIjRDkCQQDcMf7vO7RFiOIa7Bdk+2h1VNDVBmHsKtzpvx6QkutL/BTZJzoRmUFh21rmS7tTUFKnKuuKu3EA1cQjVmMHwGztAkBKwg8D3J9n5YgMbpovHhisS5mETtgGFMX72hiowsFcD47AZlMF9wyI51OM15/uOvHYpZTknECsU1AQum1/lQnhAkAWJs1vwcDb8e5VKQUdepFCpHqxw4ecW5+HwFtRzgXvyfdK9UBJPvKt5oRZgKriscTu3kl91meC3v5xU6J4yCntAkA5a/h4d/1mHuUlrf6Enpplcl71e9eE54kVFRa1CUz62bR/3PlIm58B9C1/qghKi4Swwmlsj+y+2xl/+KHhjw0a';
            $str  = chunk_split($str, 64, "\n");
            $keys = "-----BEGIN RSA PRIVATE KEY-----\n$str-----END RSA PRIVATE KEY-----\n";
            $url = $data->req_url;
            $param = [
                'p1_charset' => 1,
                'p2_merCode' => $data->apiId,
                'p10_returnUrl' => $data->res_url,
                'p9_notifyUrl' => $data->res_url,
                'p3_orderNo' => $orderNum,
                'p4_orderAmount' => $amount*100,
                'p5_orderCurrency' => 156,
                'p6_orderTime' => date('YmdHis'),
                'p7_subject' => 'SS500',
                'p8_body' => 'SS500',
                'signType' => 1,
                'extraCommonParam' => 0,
                'p12_payType' => 'WX',
                'p11_payScene' => 'PC'
            ];
            unset($param['signType']);
            $signArr = array();
            foreach ($param as $key=>$value) {
                $signArr[] = $key;
            }
            sort($signArr);
            $signStr = '';
            foreach ($signArr as $i=>$paramKey) {
                if($i!=0){
                    $signStr = $signStr.'&'.$paramKey.'='.$param[$paramKey];
                }else{
                    $signStr = $paramKey.'='.$param[$paramKey];
                }
            }
            $rsa = new PAY_XINGPU_handle_RSA();
            $signMsg[] =  $rsa->get_sign($signStr,$keys);
            $htmlStr = '<form id="yilianpaysubmit" name="yilianpaysubmit" method="post" action="'.$url.'">';
            foreach($signMsg as $key => $val){
                $htmlStr.="<input type='hidden' name='".$key."' value='".$val."'>";
            }
            $htmlStr.='<input type="submit"/>';
            $htmlStr.='</form>';
            $htmlStr.='<script>document.forms["yilianpaysubmit"].submit();</script>';
            echo $htmlStr;
        }
    }

    public function huifubao($code,$data,$amount,$orderNum)
    {
        switch ($code){
            case "WY":
                $type = 19;
                break;
            case "ZFB":
                $type = 22;
                break;
        }
        //获取ip
        $user_ip = "";
        if(isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $user_ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }
        //获取项目URL
        $url = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $version = 1;
        $agent_id = $data->apiId;
        $agent_bill_id = $orderNum;
        $agent_bill_time = date('YmdHis', time());
        $pay_type = $type;
        $pay_amt = $amount;
        $pay_code = ""; //char型，空字符串 //支付宝专用
        $notify_url = $data->res_url;
        $return_url = $data->res_url;
        $goods_name = 'SS500';
        $goods_num = 1;
        $goods_note = 'SS500';
        $remark = 'SS500';
        $sign_key = $data->apiKey; //签名密钥，需要商户使用为自己的真实KEY
        $sign_str = '';
        $sign_str  = $sign_str . 'version=' . $version;
        $sign_str  = $sign_str . '&agent_id=' . $agent_id;
        $sign_str  = $sign_str . '&agent_bill_id=' . $agent_bill_id;
        $sign_str  = $sign_str . '&agent_bill_time=' . $agent_bill_time;
        $sign_str  = $sign_str . '&pay_type=' . $pay_type;
        $sign_str  = $sign_str . '&pay_amt=' . $pay_amt;
        $sign_str  = $sign_str .  '&notify_url=' . $notify_url;
        $sign_str  = $sign_str . '&return_url=' . $return_url;
        $sign_str  = $sign_str . '&user_ip=' . $user_ip;
        $sign_str = $sign_str . '&key=' . $sign_key;
        $sign = md5($sign_str); //计算签名值
        echo '<form id="frmSubmit" method="post" name="frmSubmit" action="'.$data->req_url.'">
            <input type="hidden" name="version" value="'.$version.'" />
            <input type="hidden" name="agent_id" value="'.$agent_id.'" />
            <input type="hidden" name="agent_bill_id" value="'.$agent_bill_id.'" />
            <input type="hidden" name="agent_bill_time" value="'.$agent_bill_time.'" />
            <input type="hidden" name="pay_type" value="'.$pay_type.'" />
            <input type="hidden" name="pay_code" value="'.$pay_code.'" />
            <input type="hidden" name="pay_amt" value="'.$pay_amt.'" />
            <input type="hidden" name="notify_url" value="'.$notify_url.'" />
            <input type="hidden" name="return_url" value="'.$return_url.'" />
            <input type="hidden" name="user_ip" value="'.$user_ip.'" />
            <input type="hidden" name="goods_name" value="'.urlencode($goods_name).'" />
            <input type="hidden" name="goods_num" value="'.urlencode($goods_num).'" />
            <input type="hidden" name="goods_note" value="'.urlencode($goods_note).'" />
            <input type="hidden" name="remark" value="'.urlencode($remark).'" />
            <input type="hidden" name="sign" value="'.$sign.'" />
            <input type="button">
            </form>
             <script type="text/javascript">
                    document.forms[0].submit();
             </script>';
    }

    function xinEfu($code,$data,$amount,$orderNum){
        if($code == 'WY'){
            $merchId=$data->apiId;//商户号
            $key=$data->apiKey;//密钥
            $notify_quick=$data->res_url;
            $returnUrl_quick=$data->res_url;
            $orderNo=$orderNum;//订单
            $xml = $_POST;
            if(!$xml){echo "数据掉了~";die();}
            $P_Price = $amount*100;//以分为单位
            //$bankCode=$_POST["bankCode"];
            $bankCode='';
            $signData="bankCode=".$bankCode."&ClientType=2&merchId=".$merchId."&notifyUrl=".$notify_quick."&orderNo=".$orderNo."&returnUrl=".$returnUrl_quick."&transAmt=".$P_Price."&key=".$key;
            $signMd5=md5(md5($signData)."&key=".$key);
            $motdata = [
                'bankCode' => $bankCode,
                'ClientType' => '2',
                'merchId' => $merchId, //商户ID
//                'notifyUrl' => $notify_quick,//需要使用服务器能访问的地址
                'notifyUrl' => 'http://pay.1111500w.com/online/callback/xinefu',//需要使用服务器能访问的地址
                'orderNo' => $orderNo,
//                'returnUrl' => $returnUrl_quick,
                'returnUrl' => 'http://pay.1111500w.com/online/callback/xinefu',
                'transAmt' => $P_Price,
                'sign'=>$signMd5,
            ];
            $mopost = json_encode($motdata); //数组转换成JSON
            $model = [  //定义一个是数组用于POST
                'merchId'=>$merchId,
                'encryptType' => 'md5',
                'msgId' =>$orderNo,
                'cipherData' => base64_encode($mopost),
                'reqTime'=> date("YmdHis"),
            ];
            //accountNo请上传会员帐号标识，方便查询某恶意投诉所有订单
            echo '<form  role="form" action="https://quick.newepay.online/quick/order/V2.0" name="save" id="save" method="post">
				<input type="hidden"  name="merchId" id="merchId" value="'.$model['merchId'].'" />
				<input type="hidden" name="msgId" id="msgId" value="'.$model['msgId'].'" />
				<input type="hidden" name="cipherData" id="cipherData" value="'.$model['cipherData'].'"   />
				<input type="hidden" name="reqTime" value="'.$model['reqTime'].'" />
				<input type="hidden" name="encryptType" value="'.$model['encryptType'].'" />
				<input type="hidden" name="accountNo" value="xxxx" />
		 </form>
		 <script type="text/javascript">
				document.forms[0].submit();
		 </script>';
        }

        if($code == 'WX' || $code == 'ZFB' || $code == 'QQ' || $code == 'BD' || $code == 'YL'){
            $url = $data->req_url;
            $key = $data->apiKey;
            $uid = $data->apiId;

            switch ($code){
                case 'WX':
                    $pay = 'weixin';
                    break;
                case 'ZFB':
                    $pay = 'alipay';
                    break;
                case 'QQ':
                    $pay = 'qqpay';
                    break;
                case 'BD':
                    $pay = 'bdpay';
                    break;
                case 'YL':
                    $pay = 'unionpay';
                    break;
            }

            $motdata = [
                'attach' => 'tttt',
                'curType' => 'CNY', //人民币
                'merchId' => $uid, //商户ID
                'notifyUrl' => $data->res_url,//需要使用服务器能访问的地址
                'orderId' => $orderNum, //订单号
                'payWay' => $pay, //支付方式 支付宝：alipay QQ钱包：qqpay  百度钱包：bdpay   微信：weixin
                'title' => 'test', //标题
                'totalAmt' => $amount*100, //金额 按分为单位。 100实际为1元
                'tranTime' => time().rand(100, 200), //自己订单号
            ];
            $mopost = json_encode($motdata); //数组转换成JSON
            $md5data = md5($mopost.$key); //MD5加密和KEY加密验证
            $model = [  //定义一个是数组用于POST
                'partner'=>$uid,
                'encryptType' => 'md5',
                'msgData' =>$mopost,
                'signData' => $md5data,
            ];
            echo '<form  role="form" action="'.$url.'" name="save" id="save" method="post">
				<input type="hidden" name="partner" id="partner" value="'.$model['partner'].'"/>
				<input type="hidden" name="encryptType" id="encryptType" value="md5"/>
				<input type="hidden" name="msgData" id="msgData" value="'.base64_encode($model['msgData']).'" />
				<input type="hidden" name="callBack" value="'.$motdata['notifyUrl'].'" />
                <input type="hidden" name="returnUrl" value="'.$motdata['notifyUrl'].'" />
				<input type="hidden" name="signData" id="signData" value="'.$model['signData'].'" />
                 </form>
                 <script type="text/javascript">
                        document.forms[0].submit();
                 </script>';
        }
    }

    function renXin($code,$data,$amount,$orderNum){
        switch ($code) {
            case 'WX':
                $bank ='WEIXIN';
                break;
            case 'ZFB':
                $bank ='ALIPAY';
                break;
            case 'QQ':
                $bank ='QQ';
                break;
            case 'JD':
                $bank ='JD';
                break;
            case 'JDWAP':
                $bank ='JDWAP';
                break;
            case 'ALIPAYWAP':
                $bank ='ALIPAYWAP';
                break;
        }
        $apiUrl = $data->req_url; //接口请求地址
        $version = '3.0'; //接口版本号,目前固定值为3.0
        $method = 'Rx.online.pay'; //接口名称: Rx.online.pay
        $partner = $data->apiId; // 商户ID
        $banktype = $bank; //银行类型 default为跳转到接口进行选择支付
        $paymoney = $amount; //单位元（人民币）,两位小数点
        $ordernumber = $orderNum; //商户系统订单号，该订单号将作为接口的返回数据。该值需在商户系统内唯一
        $callbackurl = $data->res_url; //下行异步通知的地址，需要以http://开头且没有任何参数
        $hrefbackurl = $data->res_url; //下行同步通知过程的返回地址(在支付完成后接口将会跳转到的商户系统连接地址)
        $goodsname = 'SS500-OnlinePay'; //商品名称。若该值包含中文，请注意编码
        $attach = 'SS500'; //备注信息，下行中会原样返回。若该值包含中文，请注意编码
        $isshow= '1';//该参数为支付宝扫码、微信、QQ钱包专用，默认为1，跳转到网关页面进行扫码，如设为0，则网关只返回二维码图片地址供用户自行调用
        $key = $data->apiKey;//商户Key,由API分配
        $signSource = sprintf("version=%s&method=%s&partner=%s&banktype=%s&paymoney=%s&ordernumber=%s&callbackurl=%s%s", $version,$method,$partner, $banktype, $paymoney, $ordernumber, $callbackurl, $key);
        $sign = md5($signSource);//32位小写MD5签名值，UTF-8编码
        $postUrl = $apiUrl. "?version=".$version;
        $postUrl.="&method=".$method;
        $postUrl.="&partner=".$partner;
        $postUrl.="&banktype=".$banktype;
        $postUrl.="&paymoney=".$paymoney;
        $postUrl.="&ordernumber=".$ordernumber;
        $postUrl.="&callbackurl=".$callbackurl;
        $postUrl.="&hrefbackurl=".$hrefbackurl;
        $postUrl.="&goodsname=".$goodsname;
        $postUrl.="&attach=".$attach;
        $postUrl.="&isshow=".$isshow;
        $postUrl.="&sign=".$sign;
        header ("location:$postUrl");
    }
}