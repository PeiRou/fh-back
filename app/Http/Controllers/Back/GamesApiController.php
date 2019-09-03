<?php
/* 游戏api对接 */
namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\GamesApiConfig;
use App\GamesApi;
use Yajra\DataTables\Facades\DataTables;

class GamesApiController extends Controller
{

    //验证器数据
    private function verifyData($data, $CallbackArr, $message)
    {
        $validator = Validator::make($data, $CallbackArr, $message);
        return ['stauts' => $validator->fails(), 'msg' => $validator->errors()->first()];
    }

//组合验证数据
    private function validateParam($data = [])
    {
        return $this->verifyData($data, [
            'name' => ['required'],
            'description' => ['required'],
            'alias' => ['required'],
            'type' => ['required',function($attribute, $value, $fail){
                if((int)$value <= 0)
                    return $fail('游戏类型不对');
            }],
            'paramValue' => ['required', function ($attribute, $value, $fail) {
                if (!count($value)) {
                    return $fail($attribute . ' is invalid.');
                }
                if (count($value) == 1 && in_array('', $value)) {
                    return $fail($attribute . ' is invalid.');
                }
            }],
            'paramDescribes' => ['required', function ($attribute, $value, $fail) {
                if (!count($value)) {
                    return $fail($attribute . ' is invalid.');
                }
                if (count($value) == 1 && in_array('', $value)) {
                    return $fail($attribute . ' is invalid.');
                }
            }],
            'paramKey' => ['required', function ($attribute, $value, $fail) {
                if (!count($value)) {
                    return $fail($attribute . ' is invalid.');
                }
                if (count($value) == 1 && in_array('', $value)) {
                    return $fail($attribute . ' is invalid.');
                }
            }],
            'class_name' => ['required'],
        ], [
//            'name.required' => '',
//            'description.required' => '提款密码暂未设置，请先设置提款密码',
        ]);
    }

    public function edit(Request $request)
    {
        $param = $request->all();
        $id = $request->id ?? 0;
        //验证
        $data = $this->validateParam($param);
        if ($data['stauts']) {
            return show(1, $data['msg']);
        }
        $paramKey = $param['paramKey'];
        $paramValue = $param['paramValue'];
        $paramDescribes = $param['paramDescribes'];
        try{
            $GamesApi = new GamesApi;
            $data = [
                'g_id' => $param['g_id'],
                'type_id' => $param['type_id'],
                'name' => $param['name'],
                'description' => $param['description'],
                'type' => (int)$param['type'],
                'status' => isset($param['status']) ? 1 : 0,
                'class_name' => $param['class_name'],
                'alias' => $param['alias'],
    //            'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            if($id){
                $GamesApi->where('id', $id)->update($data);
            }else{
                if ($GamesApi->where('name', $param['name'])->exists()) {
                    return show(1, '游戏名字重复');
                }
                $data['created_at'] =  date('Y-m-d H:i:s');
                $id= $GamesApi->insertGetId($data);
            }
            if (!$id) {
                return show(1, '配置添加失败');
            }
            //清除原先的配置
            $GamesApiConfig = new GamesApiConfig;
            $GamesApiConfig->where('g_id', $param['g_id'])->delete();
            $data = [];
            foreach ($paramKey as $k => $v) {
                if (empty($v)) {
                    continue;
                }
                $data[] = [
                    'g_id' => $param['g_id'],
                    'key' => $paramKey[$k],
                    'value' => $paramValue[$k] ?? '',
                    'description' => $paramDescribes[$k]
                ];
            }
            if ($c_id = $GamesApiConfig->insert($data)) {
                return show(0);
            }
            return show(3, '参数添加失败');
        }catch (\Exception $e){
            return show(1, 'server error');
        }
    }

    //获取列表
    public function GameApiList(Request $request)
    {
        $start = $request->get('start');
        $length = $request->get('length');
        $GamesApi = new GamesApi;
        $resCount = $GamesApi->count();
        $res = $GamesApi
            ->skip($start)->take($length)
            ->orderBy('sort', 'asc')
            ->orderBy('g_id', 'desc')
            ->get();
        $statusArr = $GamesApi->statusArr;
        return DataTables::of($res)
            ->editColumn('type_id',function ($res) use ($statusArr){
                return $statusArr[$res->type] ?? '';
            })
            ->editColumn('sort',function ($res) use ($statusArr){
                $sort = $res->sort ?? 99;
                return '<input type="text" class="sort" data-id="'.$res->g_id.'" style="width: 30px; height:20px;" oninput="this.value=value.replace(/[^\d]/g,\'\')"  value="'.$sort.'">';
            })
            ->setTotalRecords($resCount)
            ->rawColumns(['sort'])
            ->skipPaging()
            ->make();
    }

    //删除
    public function del(Request $request)
    {
        if(!($id = $request->get('id'))){
            return show(2);
        }
        GamesApiConfig::where('g_id',$id)->delete();
        GamesApi::where('g_id',$id)->delete();
        return show(0);
    }
    //修改gameApi表参数
    public function editParameter(Request $request){
        if(!($id = $request->get('id'))){
            return show(2);
        }
        $data['status'] = $request->get('status');
        if($data['status'] == 1){
            $data['open'] = 1;
        }
        if(GamesApi::where('g_id',$id)->update($data)){
            return show(0);
        }
        return show(3, 'error');
    }

    //排序
    public function sort (Request $request)
    {
        $arr = [];
        $str = [];
        foreach ($request->sort as $k=>$v){
            if(isset($v['g_id'], $v['val'])){
                array_push($arr, "when g_id = {$v['g_id']} then {$v['val']}");
                array_push($str, $v['g_id']);
            }
        }
        if(count($arr)){
            $sql = "
                update games_api set 
                sort = 
                case 
                    ".implode('   ',$arr)."
                end
                where g_id in(".implode(',', $str).")
            ";
            DB::select($sql);
        }
        return show(0);
    }

    public function getWEB_INTRANET_IP()
    {
        return explode(',', env('WEB_INTRANET_IP'))[0] ?? '';
    }

    public function allDown(Request $request)
    {
        $url = $this->getWEB_INTRANET_IP();
        if(empty($url)){
            return '';
        }
        $url .= '/api/GamesApi/allDown?user_id='.$request->user_id;
        $res = file_get_contents($url);
        echo $res;
    }

    public function UserGamesApi(Request $request)
    {
        $param = http_build_query($request->all());
        $url = $this->getWEB_INTRANET_IP().'/api/GamesApi/UserGamesApi'.'?'.$param;
        $res = @file_get_contents($url);

        if($res = json_decode($res, 1)){
            if(isset($res['code']) && $res['code'] == 0)
                return show(0, '', $res['data']);
        }
        return show(1, $res['msg'] ?? '');
    }

}
