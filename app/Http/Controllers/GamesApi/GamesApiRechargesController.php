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
            if(isset($request->code)){
                if($request->code >= 0)
                    $sql->where('code', $request->code);
                elseif($request->code == -1)
                    $sql->where('code', '>', 0);
                unset($request->code);
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
            ->editColumn('g_id',function ($res)use($g_ids){
                return $g_ids[$res->g_id] ?? '';
            })
            ->setTotalRecords($resCount)
            ->rawColumns(['sort','control'])
            ->skipPaging()
            ->make();
    }

}
