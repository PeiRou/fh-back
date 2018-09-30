<?php

namespace App\Http\Controllers\Back;

use App\ActivityCondition;
use App\Article;
use App\Feedback;
use App\FeedbackMessage;
use App\SystemSetting;
use App\Whitelist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SystemSettingController extends Controller
{
    public function editSystemSetting(Request $request)
    {
        $id = $request->id;
        $data = $request->data;
        if($request){
            $update = SystemSetting::where('id',1)
                ->update([
                    $id => $data
                ]);
            if($update == 1){
                $saveToFile = $this->saveConfigToFile();
                if($saveToFile == 1){
                    return response()->json([
                        'status' => true
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'msg' => '保存配置文件出错，请联系技术支持！'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => '没有更改任何值，此次保存不生效！'
                ]);
            }
        }
    }

    function saveConfigToFile(){
        $data = SystemSetting::where('id',1)->first();
        $content = 'var CONFIG_MAP = { agentZxkfUrl: "'.$data->agent_vip_service_url.'", testAccountMoney: "'.$data->test_account_money.'", lhc_jin_num: "'.$data->lhc_jin_num.'", lhc_mu_num: "'.$data->lhc_mu_num.'", lhc_shui_num: "'.$data->lhc_shui_num.'", lhc_huo_num: "'.$data->lhc_huo_num.'", lhc_tu_num: "'.$data->lhc_tu_num.'", online_service_url: "'.$data->online_service_url.'", default_skin: "'.$data->default_skin.'", index_qq_url: "'.$data->index_qq_url.'", index_wechat_url: "'.$data->index_wechat_url.'", index_phone_url: "'.$data->index_phone_url.'", index_service_qq_url: "'.$data->index_service_qq_url.'", index_agent_qq_url: "'.$data->index_agent_qq_url.'", index_agent_email_url: "'.$data->index_agent_email_url.'", reg_ip_black_list: "'.$data->reg_ip_black_list.'", open_site_url: "'.$data->open_site_url.'", allow_same_fullname_reg: "'.$data->allow_same_fullname_reg.'",noallow_bet_8_num: "'.$data->noallow_bet_8_num.'",drawing_time:"'.$data->drawing_time.'",web_captcha: "'.$data->web_captcha.'",kfb_auto_savecode:"'.$data->kfb_auto_savecode.'",allow_user_register:"'.$data->allow_user_register.'",activity_money_admin:"'.$data->activity_money_admin.'",low_recharge_money:"'.$data->low_recharge_money.'",drawing_way:"'.$data->drawing_way.'",app_domain:"'.$data->app_domain.'",pc_app_download_url:"'.$data->pc_app_download_url.'",mobile_app_download_url:"'.$data->mobile_app_download_url.'",app_domain_open:"'.$data->app_domain_open.'",open_login_google_captcha:"'.$data->open_login_google_captcha.'",user_reg_qq_input:"'.$data->user_reg_qq_input.'",user_reg_email_input:"'.$data->user_reg_email_input.'",user_reg_mobile_input:"'.$data->user_reg_mobile_input.'",agent_vip_domain:"'.$data->agent_vip_domain.'",drawing_money_limit:"'.$data->drawing_money_limit.'",user_reg_message_info:"'.$data->user_reg_message_info.'",game_nobet_time:"'.$data->game_nobet_time.'",agent_vip_service_url:"'.$data->agent_vip_service_url.'",native_app_domain:"'.$data->native_app_domain.'" }';
        $write = Storage::disk('static')->put('sysconfig.js',$content);
        if($write == 1){
            return 1;
        }
    }

    public function addArticle(Request $request)
    {
        $title = $request->input('title');
        $type = $request->input('type');
        $up = $request->input('up');
        $content = $request->input('container');
        $userid = Session::get('account_id');

        $article = new Article();
        $article->title = $title;
        $article->type = $type;
        $article->up = $up;
        $article->content = $content;
        $article->addUserId = $userid;
        $save = $article->save();
        if($save == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => '插入失败，请稍后再试！'
            ]);
        }
    }

    public function editArticle(Request $request)
    {
        $title = $request->input('title');
        $type = $request->input('type');
        $up = $request->input('up');
        $content = $request->input('container');
        $id = $request->id;

        $update = Article::where('id',$id)->update([
            'title' => $title,
            'type' => $type,
            'up' => $up,
            'content' => $content
        ]);

        if($update == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => '修改失败，请稍后再试！'
            ]);
        }
    }


    public function delArticle(Request $request)
    {
        $id = $request->get('id');
        $del = Article::where('id',$id)->delete();
        if($del == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => '删除失败，请稍后再试！'
            ]);
        }
    }

    //添加ip白名单
    public function addWhitelist(Request $request){
        $params = $request->post();
        $validator = Validator::make($params,Whitelist::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        $data = [];
        $data['ip'] = $params['ip'];
        $data['content'] = $params['content'];
        $data['admin_id'] = Session::get('account_id');
        $data['admin_account'] = Session::get('account');
        if(Whitelist::insert($data)){
            return response()->json([
                'status' => true
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => '添加失败，请稍后再试！'
            ]);
        }
    }

    //删除ip白名单
    public function delWhitelist(Request $request){
        $params = $request->post();
        if(!isset($params['id']) && array_key_exists('id',$params)){
            return response()->json([
                'status' => false,
                'msg' => '参数错误'
            ]);
        }
        if(Whitelist::where('id','=',$params['id'])->delete()){
            return response()->json([
                'status' => true
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => '删除失败，请稍后再试！'
            ]);
        }
    }

    //修改ip白名单
    public function editWhitelist(Request $request){
        $params = $request->post();
        $validator = Validator::make($params,Whitelist::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        if(!isset($params['id']) && array_key_exists('id',$params)){
            return response()->json([
                'status' => false,
                'msg' => '参数错误'
            ]);
        }
        $data = [];
        $data['ip'] = $params['ip'];
        $data['content'] = $params['content'];
        $data['admin_id'] = Session::get('account_id');
        $data['admin_account'] = Session::get('account');
        if(Whitelist::where('id','=',$params['id'])->update($data)){
            return response()->json([
                'status' => true
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => '修改失败，请稍后再试！'
            ]);
        }
    }

    //问题回复
    public function replyFeedback(Request $request){
        $params = $request->post();
        $validator = Validator::make($params,FeedbackMessage::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        $data = [];
        $data['content'] = $params['content'];
        $data['feedback_id'] = $params['feedback_id'];
        $data['type'] = 2;
        $data['admin_id'] = Session::get('account_id');
        $data['name'] = Session::get('account_name');
        $data['account'] = Session::get('account');
        DB::beginTransaction();
        $result1 = FeedbackMessage::insert($data);
        $result2 = Feedback::where('id','=',$params['feedback_id'])->update(['status'=>2]);
        if($result1 && $result2){
            DB::commit();
            return response()->json([
                'status' => true
            ]);
        }else{
            DB::rollBack();
            return response()->json([
                'status' => false,
                'msg' => '回复失败，请稍后再试！'
            ]);
        }
    }
}
