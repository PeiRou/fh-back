<?php

namespace App\Http\Controllers\Obtain;

use App\Feedback;
use App\FeedbackMessage;

class FeedbackController extends BaseController
{
    //执行方法
    public function doAction($aParam){
        $feedback = Feedback::getAll($aParam)->toArray();
        $feedbackMessage = FeedbackMessage::getAll($aParam)->toArray();
        $data = [
            'feedback' => $feedback,
            'feedbackMessage' => $feedbackMessage
        ];
//        foreach ($feedback as $k=>$v){
//            $data[$k] = $this->userData($v);
//            foreach ($feedbackMessage as $kk=>$vv){
//                if($vv['feedback_id'] == $v['id']){
//                    $data[$k]['m'][] = $this->adminData($vv, $v);
//                    unset($feedbackMessage[$kk]);
//                }
//            }
//        }
        $this->show(0, $data);
    }
    private function adminData($mData, $fData){
        $data = [
            'first_id' => $mData['feedback_id'],
            'type' => $fData['type'],
            'reply_type' => $mData['type'],
            'content' => $mData['content'],
            'status' => 2,
            'created_at' => $mData['created_at'],
            'updated_at' => $mData['updated_at'],
            'user_id'=> '',
            'user_name'=> '',
            'user_account'=> '',
            'admin_id'=> '',
            'admin_name'=> '',
            'admin_account'=> '',
        ];
        switch ($mData['type']) {
            case 1:
                $data['user_id'] = $fData['user_id'];
                $data['user_name'] = $fData['user_name'];
                $data['user_account'] = $fData['user_account'];
                break;
            case 2:
                $data['admin_id'] = $mData['admin_id'];
                $data['admin_name'] = $mData['name'];
                $data['admin_account'] = $mData['account'];
                break;
        }
        return $data;
    }
    private function userData($fData){
        return [
            'first_id' => $fData['id'], //第一条留言id
            'type' => $fData['type'],
            'reply_type' => 0,
            'content' => $fData['content'],
            'user_id' => $fData['user_id'],
            'user_name' => $fData['user_name'],
            'user_account' => $fData['user_account'],
            'status' => $fData['status'],
            'created_at' => $fData['created_at'],
            'updated_at' => $fData['updated_at'],
            'admin_id'=> '',
            'admin_name'=> '',
            'admin_account'=> '',
        ];
    }
}
