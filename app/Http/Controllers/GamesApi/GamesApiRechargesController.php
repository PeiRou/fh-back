<?php
/* 游戏api对接 */
namespace App\Http\Controllers\GamesApi;

use App\GamesList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\GamesApiConfig;
use App\GamesApi;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;

class GamesApiRechargesController extends Controller
{

    public function list(Request $request)
    {
        $model = DB::table('jq_recharges')->where(function($sql) use($request){
            $columns = Schema::getColumnListing($sql->from);
            if(isset($request->order_id) || isset($request->username)){
                unset($request->g_id);
                $request->offsetSet('g_id', null);
                unset($request->code);
                $request->offsetSet('code', null);
            }

            if(isset($request->code)){
                if($request->code >= 0){
                    $sql->where('code', (string)$request->code);
                }elseif($request->code == -1){
                    $sql->where('code', '>', '0');
                }elseif($request->code == '-2'){
                    $sql->whereRaw(' code = "500" AND (order_code = "" OR order_code = "500") ');
                }
                unset($request->code);
                $request->offsetSet('code', null);
            }
            foreach ($request->all() as $k=>$v){
                in_array($k, $columns) && !empty($v) && $sql->where($k, $v);
            }
        });
        $resCount = $model->count();
        if(isset($request->start, $request->length))
            $model->skip($request->start)->take($request->length);

        $res = $model->orderBy('id', 'desc')->get();
        $g_ids = GamesApi::pluck('name','g_id')->toArray();
        return DataTables::of($res)
            ->editColumn('control',function ($res){
                return '';
            })
            ->editColumn('type',function ($res){
                $str = '';
                $res->type == 'up' && $str = '上分';
                $res->type == 'down' && $str = '下分';
                return $str;
            })
            ->editColumn('g_id',function ($res)use($g_ids){
                return $g_ids[$res->g_id] ?? '';
            })
            ->editColumn('control',function ($res){
                $str = '';
                if($res->code == 500 && ($res->order_code === '' || $res->order_code == 500)){
                    $str .= '<ul class="control-menu">
                        <li onclick="checkOrder('.$res->id.')">检查订单</li>
                        </ul>';
                }
                return $str;
            })
            ->setTotalRecords($resCount)
            ->rawColumns(['sort','control'])
            ->skipPaging()
            ->make();
    }

}
