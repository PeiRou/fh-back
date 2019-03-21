<?php
/* 游戏api对接 */
namespace App\Http\Controllers\GamesApi;

use App\GamesList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\GamesApiConfig;
use App\GamesApi;
use Yajra\DataTables\Facades\DataTables;

class GamesApiRechargesController extends Controller
{

    public function list(Request $request)
    {
        $model = DB::table('jq_recharges')->where(function($sql) use($request){
            if(isset($request->code)){
                if($request->code >= 0)
                    $sql->where('code', $request->code);
                elseif($request->code == -1)
                    $sql->where('code', '>', 0);
            }
        });

        if(isset($request->start, $request->length))
            $model->skip($request->start)->take($request->length);

        $resCount = $model->count();
        $res = $model->orderBy('id', 'asc')->get();

        return DataTables::of($res)
            ->editColumn('control',function ($res){
                return '';
            })
            ->setTotalRecords($resCount)
            ->rawColumns(['sort','control'])
            ->skipPaging()
            ->make();
    }

}
