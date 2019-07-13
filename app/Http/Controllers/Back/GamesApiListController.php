<?php
/* 游戏api对接 */
namespace App\Http\Controllers\Back;

use App\GamesList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\GamesApiConfig;
use App\GamesApi;
use Yajra\DataTables\Facades\DataTables;

class GamesApiListController extends Controller
{
    //获取列表
    public function GameApiGamesList(Request $request)
    {
        $model = DB::table('games_list')->where(function($sql) use($request){
            isset($request->pid) &&
                $sql->where('pid', $request->pid);
        });
        $apis = GamesApi::select('g_id', 'name')->pluck('name', 'g_id')->toArray();
        $pids = DB::table('games_list')->pluck('name', 'id')->toArray();

        if(isset($request->start, $request->length))
            $model->skip($request->start)->take($request->length);

        $resCount = $model->count();
        $res = $model->orderBy('sort', 'asc')->get();

        return DataTables::of($res)
            ->editColumn('open',function ($res){
                $str = '';
                if($res->open == 1)
                    $str .= '<span class="status-1"><i class="iconfont"></i> 开启</span>';
                else
                    $str .= '<span class="status-3"><i class="iconfont"></i> 关闭</span>';
                return $str;
            })
            ->editColumn('pid',function ($res)use($pids){
                return $pids[$res->pid] ?? '';
            })
            ->editColumn('g_id',function ($res)use($apis){
                return $apis[$res->g_id] ?? '';
            })
            ->editColumn('logo_pc',function ($res){
                return "<img src='".$res->logo_pc."' width='100px'>";
            })
            ->editColumn('logo_mobile',function ($res){
                return "<img src='".$res->logo_mobile."' width='100px'>";
            })
            ->editColumn('sort',function ($res){
                return '<input type="text" class="sort" data-id="'.$res->id.'" style="width: 30px; height:20px;" oninput="this.value=value.replace(/[^\d]/g,\'\')" value="'.$res->sort.'">';
            })
            ->editColumn('control',function ($res){

                $switch = $edit = '';
                if($res->open == 0)
                    $switch .= '<li onclick="editSwitch('.$res->id.',0)"><span class="status-1">开启</span></li>';
                else
                    $switch .= '<li onclick="editSwitch('.$res->id.',1)"><span class="status-3">关闭</span></li>';

//                if(Session::get('account') == 'admin')
                    $edit .= '<li onclick="edit('.$res->id.')">修改</li><li onclick="del('.$res->id.')">删除</li>';
                $str = '<ul class="control-menu">'.$switch.$edit.'</ul>';
                return $str;
            })
            ->setTotalRecords($resCount)
            ->rawColumns(['sort','control','open','logo_pc', 'logo_mobile'])
            ->skipPaging()
            ->make();
    }

    //删除
    public function del(Request $request)
    {
        if(!($id = $request->get('id'))){
            return show(2);
        }
        if(DB::table('games_list')->where('pid', $id)->first())
            return show(1, '当前分类下还有游戏');
        DB::table('games_list')->where('id',$id)->delete();
        return show(0);
    }

    //排序
    public function sort (Request $request)
    {
        $arr = [];
        $str = [];
        foreach ($request->sort as $k=>$v){
            if(isset($v['id'], $v['val'])){
                array_push($arr, "when id = {$v['id']} then {$v['val']}");
                array_push($str, $v['id']);
            }
        }
        if(count($arr)){
            $sql = "
                update games_list set 
                sort = 
                case 
                    ".implode('   ',$arr)."
                end
                where id in(".implode(',', $str).")
            ";
            DB::select($sql);
        }
        return show(0);
    }

    public function add(Request $request)
    {
        if($request->getMethod() == 'GET'){
            $data = [
                'p' => GamesList::getArr(),
                'apis' => GamesApi::select('g_id', 'name')->get()
            ];
            isset($request->id) &&
                $data['data'] = DB::table('games_list')->where('id', $request->id)->first();
            return view('back.gamesApi.games.add', $data);
        }
        if(!isset($request->pid,$request->name,$request->g_id)){
            return show(1, '参数错误');
        }
        $model = DB::table('games_list');
//        if(!$request->id && DB::table('games_list')->where('name', $request->name)->count())
//            return show(1, '游戏名称重复');
//        $keys = $request->paramKey;
//        $val = $request->paramValue;
//        $param = [];
//        if(count($val) && count($keys))
//            while ($keys)
//                $param[array_shift($keys)] = array_shift($val) ?? '';
        //ALTER TABLE `games_list` ADD `logo_pc` TEXT NULL AFTER `g_id`;
        //ALTER TABLE `games_list` ADD `logo_mobile` TEXT NULL AFTER `logo_pc`;
        $data = [
            'pid' => (int)$request->pid,
            'name' => $request->name,
            'g_id' => (int)$request->g_id,
            'game_id' => (int)$request->game_id,
//            'param' => json_encode($param, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'type' => (int)$request->type,
            'open' => $request->open == 'on' ? 1 : 0,
            'logo_pc' => $request->logo_pc??'',
            'logo_mobile' => $request->logo_mobile??'',
//            'sort' => 0,
        ];
        if(isset($request->id)){
            $res = $model->where('id', $request->id)->update($data);
        }else{
            $res = $model->insertGetId($data);
        }
        return show(0);
    }

    public function switch_(Request $request)
    {
        DB::table('games_list')->update(['open' => 0]);
        if(isset($request->list) && count($request->list) > 0){
            DB::table('games_list')->whereIn('game_id', explode(',',$request->list))->update(['open' => 1]);
        }
        return show(0);

//        if(!isset($request->id, $request->status))
//            return show(1, '参数错误');
//        DB::table('games_list')->where('id', $request->id)->update(['open' => $request->status]);
//        return show(0);
    }

}
