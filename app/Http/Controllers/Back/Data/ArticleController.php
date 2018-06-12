<?php

namespace App\Http\Controllers\Back\Data;

use App\Article;
use App\SubAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ArticleController extends Controller
{
    public function article()
    {
        $article = Article::all();
        return DataTables::of($article)
            ->editColumn('type',function ($article){
                if($article->type == 1){
                    return "新闻";
                }
                if($article->type == 2){
                    return "公告";
                }
                if($article->type == 3){
                    return "经验";
                }
            })
            ->editColumn('up',function ($article){
                if($article->up == 1){
                    return "置顶中";
                }
                if($article->up == 0){
                    return "否";
                }
            })
            ->editColumn('addUser',function ($article){
                $findAdmin = SubAccount::where('sa_id',$article->addUserId)->first();
                return $findAdmin->name;
            })
            ->editColumn('control',function ($article){
                return '<span class="edit-link" onclick="edit(\''.$article->id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> | 
                        <span class="edit-link" onclick="del(\''.$article->id.'\')"><i class="iconfont">&#xe66d;</i> 删除</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }
}
