<?php
/* 游戏api对接 */
namespace App\Http\Controllers\Back;

use App\GamesList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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

        });
        $apis = GamesApi::select('g_id', 'name')->pluck('name', 'g_id')->toArray();
        $pids = DB::table('games_list')->pluck('name', 'id')->toArray();

        if(isset($request->start, $request->length))
            $model->skip($request->start)->take($request->length);

        $resCount = $model->count();
        $res = $model->orderBy('sort', 'asc')->get();

        return DataTables::of($res)
            ->editColumn('g_id',function ($res)use($apis){
                return $apis[$res->g_id] ?? '';
            })
            ->editColumn('pid',function ($res)use($pids){
                return $pids[$res->pid] ?? '';
            })
            ->editColumn('sort',function ($res){
                return '<input type="text" class="sort" data-id="'.$res->id.'" style="width: 30px; height:20px;" oninput="this.value=value.replace(/[^\d]/g,\'\')" value="'.$res->sort.'">';
            })
            ->editColumn('control',function ($res){
                return '<ul class="control-menu">
                        <li onclick="edit('.$res->id.')">修改</li>
                        <li onclick="del('.$res->id.')">删除</li>
                        </ul>';
            })
            ->setTotalRecords($resCount)
            ->rawColumns(['sort','control'])
            ->skipPaging()
            ->make();
    }

    //删除
    public function del(Request $request)
    {
        if(!($id = $request->get('id'))){
            return show(2);
        }
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
        $keys = $request->paramKey;
        $val = $request->paramValue;
        $param = [];
        if(count($val) && count($keys))
            while ($keys)
                $param[array_shift($keys)] = array_shift($val) ?? '';
        $data = [
            'pid' => (int)$request->pid,
            'name' => $request->name,
            'g_id' => (int)$request->g_id,
            'param' => json_encode($param, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'type' => (int)$request->type,
            'open' => (int)$request->open,
            'sort' => 0,
        ];
        if(isset($request->id)){
            $res = $model->where('id', $request->id)->update($data);
        }else{
            $res = $model->insertGetId($data);
        }
        return show(0);
    }

}
