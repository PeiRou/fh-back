<?php

namespace App\Http\Controllers\Back;

use App\Agent;
use App\AgentReport;
use App\AgentReportBase;
use App\AgentReportReview;
use App\Bets;
use App\Http\Proxy\GetDate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AgentSettleController extends Controller
{
    //代理结算审核-手动结算
    public function settlement(){
        Artisan::call('AgentSettle:Settlement');
        return response()->json([
            'status'=>true,
            'msg'=>'结算成功'
        ]);
    }

    //代理结算报表-提交审核
    public function submitReview(Request $request){
        $params = $request->post();
        if(!isset($params['agent_report_idx']) && !array_key_exists('agent_report_idx',$params)){
            return response()->json(['status'=>false,'msg'=>'修改id为空']);
        }
        //开启事务
        DB::beginTransaction();
        $resultOne = AgentReport::where('agent_report_idx','=',$params['agent_report_idx'])->update(['status'=>2]);
        $reportInfo = AgentReport::where('agent_report_idx','=',$params['agent_report_idx'])->first();
        if(empty($reportInfo)){
            DB::rollBack();
            return response()->json(['status'=>false,'msg'=>'数据错误']);
        }
        $data = json_decode(json_encode($reportInfo),true);
        $data['report_id'] = $data['agent_report_idx'];
        $data['updated_at'] = date('Y-m-d H:i:s',time());
        unset($data['agent_report_idx']);
        $resultTwo = AgentReportReview::insert($data);
        if($resultTwo && $resultOne){
            Agent::where('a_id','=',$reportInfo->a_id)->increment('balance',$reportInfo->commission);
            DB::commit();
            return response()->json(['status'=>true,'msg'=>'提交审核成功']);
        }else{
            DB::rollBack();
            return response()->json(['status'=>true,'msg'=>'提交审核失败']);
        }
    }

    //代理结算报表-提交结算
    public function submitSettle(Request $request){
        $params = $request->post();
        if(!isset($params['agent_report_idx']) && !array_key_exists('agent_report_idx',$params)){
            return response()->json(['status'=>false,'msg'=>'修改id为空']);
        }
        //开启事务
        DB::beginTransaction();
        $resultOne = AgentReportReview::where('agent_report_idx','=',$params['agent_report_idx'])->update(['status'=>1]);
        $reportInfo = AgentReportReview::where('agent_report_idx','=',$params['agent_report_idx'])->first();
        if(empty($reportInfo)){
            DB::rollBack();
            return response()->json(['status'=>false,'msg'=>'数据错误']);
        }
        $resultTwo = AgentReport::where('agent_report_idx','=',$reportInfo->report_id)->update(['status'=>1]);
        if($resultTwo && $resultOne){
            DB::commit();
            return response()->json(['status'=>true,'msg'=>'提交结算成功']);
        }else{
            DB::rollBack();
            return response()->json(['status'=>true,'msg'=>'提交结算失败']);
        }
    }

    //代理结算报表-提交驳回
    public function submitTurnDown(Request $request){
        $params = $request->post();
        if(!isset($params['agent_report_idx']) && !array_key_exists('agent_report_idx',$params)){
            return response()->json(['status'=>false,'msg'=>'修改id为空']);
        }
        //开启事务
        DB::beginTransaction();
        $resultOne = AgentReportReview::where('agent_report_idx','=',$params['agent_report_idx'])->update(['status'=>3]);
        $reportInfo = AgentReportReview::where('agent_report_idx','=',$params['agent_report_idx'])->first();
        if(empty($reportInfo)){
            DB::rollBack();
            return response()->json(['status'=>false,'msg'=>'数据错误']);
        }
        $resultTwo = AgentReport::where('agent_report_idx','=',$reportInfo->report_id)->update(['status'=>3]);
        if($resultTwo && $resultOne){
            DB::commit();
            return response()->json(['status'=>true,'msg'=>'提交结算成功']);
        }else{
            DB::rollBack();
            return response()->json(['status'=>true,'msg'=>'提交结算失败']);
        }
    }

    //代理结算审核-修改审核
    public function editReview(Request $request){
        $params = $request->post();
        $data = [];
        if(!isset($params['agent_report_idx']) && !array_key_exists('agent_report_idx',$params)){
            return response()->json(['status'=>false,'msg'=>'修改id为空']);
        }
        if(isset($params['base_fee_prop']) && array_key_exists('base_fee_prop',$params)){
            $data['base_fee_prop'] = $params['base_fee_prop'];
        }
        if(isset($params['month3_fee_bunko']) && array_key_exists('month3_fee_bunko',$params)){
            $data['month3_fee_bunko'] = $params['month3_fee_bunko'];
        }
        if(isset($params['fenhong_prop']) && array_key_exists('fenhong_prop',$params)){
            $data['fenhong_prop'] = $params['fenhong_prop'];
        }
        if(isset($params['month3_commission']) && array_key_exists('month3_commission',$params)){
            $data['month3_commission'] = $params['month3_commission'];
        }
        $data['updated_at'] = date('Y-m-d H;i;s');
        $data['sa_id'] = Session::get('account_id');
        $data['sa_account'] = Session::get('account');
        if(AgentReportReview::where('agent_report_idx','=',$params['agent_report_idx'])->update($data)){
            return response()->json([
                'status'=>true,
                'msg'=>'修改成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'修改失败'
            ]);
        }
    }

    //代理结算报表-修改报表
    public function editReport(Request $request){
        $params = $request->post();
        $data = [];
        if(!isset($params['agent_report_idx']) && !array_key_exists('agent_report_idx',$params)){
            return response()->json(['status'=>false,'msg'=>'修改id为空']);
        }
        if(isset($params['base_fee_prop']) && array_key_exists('base_fee_prop',$params)){
            $data['base_fee_prop'] = $params['base_fee_prop'];
        }
        if(isset($params['month3_fee_bunko']) && array_key_exists('month3_fee_bunko',$params)){
            $data['month3_fee_bunko'] = $params['month3_fee_bunko'];
        }
        if(isset($params['fenhong_prop']) && array_key_exists('fenhong_prop',$params)){
            $data['fenhong_prop'] = $params['fenhong_prop'];
        }
        if(isset($params['month3_commission']) && array_key_exists('month3_commission',$params)){
            $data['month3_commission'] = $params['month3_commission'];
        }
        if(isset($params['real_bunko']) && array_key_exists('real_bunko',$params)){
            $data['real_bunko'] = $params['real_bunko'];
        }
        if(isset($params['fee_bunko']) && array_key_exists('fee_bunko',$params)){
            $data['fee_bunko'] = $params['fee_bunko'];
        }
        if(isset($params['commission']) && array_key_exists('commission',$params)){
            $data['commission'] = $params['commission'];
        }
        $data['updated_at'] = date('Y-m-d H;i;s');
        $data['sa_id'] = Session::get('account_id');
        $data['sa_account'] = Session::get('account');
        if(AgentReport::where('agent_report_idx','=',$params['agent_report_idx'])->update($data)){
            return response()->json([
                'status'=>true,
                'msg'=>'修改成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'修改失败'
            ]);
        }
    }

    //代理结算配置-修改配置
    public function editConfig(Request $request){
        $params = $request->post();
        $data = [];
        if(isset($params['valid_member']) && array_key_exists('valid_member',$params)){
            $data['valid_member'] = $params['valid_member'];
        }
        if(isset($params['incre_member']) && array_key_exists('incre_member',$params)){
            $data['incre_member'] = $params['incre_member'];
        }
        if(isset($params['feesProp']) && array_key_exists('feesProp',$params)){
            $data['feesProp'] = $params['feesProp'];
        }
        if(isset($params['gold_agent']) && array_key_exists('gold_agent',$params)){
            $data['gold_agent'] = $params['gold_agent'];
        }
        if(isset($params['noNeed_agent']) && array_key_exists('noNeed_agent',$params)){
            $data['noNeed_agent'] = $params['noNeed_agent'];
        }
        if(isset($params['effective_bet']) && array_key_exists('effective_bet',$params)){
            $data['effective_bet'] = $params['effective_bet'];
        }
        if(isset($params['effective_money']) && array_key_exists('effective_money',$params)){
            $data['effective_money'] = $params['effective_money'];
        }
        if(isset($params['platMoneyCost']) && array_key_exists('platMoneyCost',$params)){
            $data['platMoneyCost'] = $params['platMoneyCost'];
        }
        if(isset($params['platOperateCost']) && array_key_exists('platOperateCost',$params)){
            $data['platOperateCost'] = $params['platOperateCost'];
        }
        if(isset($params['agentRebateCost']) && array_key_exists('agentRebateCost',$params)){
            $data['agentRebateCost'] = $params['agentRebateCost'];
        }
        if(isset($params['profitStart']) && array_key_exists('profitStart',$params)){
            $validMember = [];
            foreach ($params['profitStart'] as $key => $value){
                if(isset($params['profitEnd'][$key]) && array_key_exists($key,$params['profitEnd']) && isset($params['proportion'][$key]) && array_key_exists($key,$params['proportion'])){
                    $validMember[$key]['profitStart'] = $value;
                    $validMember[$key]['profitEnd'] = $params['profitEnd'][$key];
                    $validMember[$key]['proportion'] = $params['proportion'][$key];
                }
            }
            $data['fenhong_rate'] = json_encode($validMember);
        }
        $data['sa_id'] = Session::get('account_id');
        $data['sa_account'] = Session::get('account');
        $data['updated_at'] = date('Y-m-d H:i:s');
        if(AgentReportBase::editAgentBaseInfo($data)){
            return response()->json([
                'status'=>true,
                'msg'=>'保存成功'
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'msg'=>'保存失败'
            ]);
        }
    }
    //添加代理专属域名
    public function addAgentSettleDomain(Request $request){
        if(!($url = $request->get('url')) || !($name = $request->get('name'))){
            return response()->json([
                'status'=>0,
                'msg'=>'参数错误'
            ]);
        }
        $AgentDomain = new \App\AgentDomain();
        if($AgentDomain->where('url',$url)->first()){
            return response()->json([
                'status'=>0,
                'msg'=>'域名重复'
            ]);
        }
        $res = $AgentDomain->insert([
            'url' => $url,
            'name' => $name,
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        if($res){
            return response()->json([
                'status'=>1,
                'msg'=>''
            ]);
        }
        return response()->json([
            'status'=>0,
            'msg'=>''
        ]);
    }
    //修改代理专属域名
    public function editAgentSettleDomain(Request $request){
        if(!($url = $request->get('url')) || !($name = $request->get('name')) || !($id = $request->get('agent_domain_id'))){
            return response()->json([
                'status'=>0,
                'msg'=>'参数错误'
            ]);
        }
        $AgentDomain = new \App\AgentDomain();
        $data = [
            'name' => $name,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $AgentDomain->where('id',$id)->update($data);
        return response()->json([
            'status'=>1,
            'msg'=>''
        ]);
    }
    //删除代理域名
    public function delAgentSettleDomain(Request $request){
        if(!($id = $request->get('agent_domain_id'))){
            return response()->json([
                'status'=>0,
                'msg'=>'参数错误'
            ]);
        }
        $AgentDomain = new \App\AgentDomain();
        if($AgentDomain->where('id',$id)->delete()){
            return response()->json([
                'status'=>1,
                'msg'=>''
            ]);
        }
        return response()->json([
            'status'=>0,
            'msg'=>'删除失败'
        ]);
    }
}
