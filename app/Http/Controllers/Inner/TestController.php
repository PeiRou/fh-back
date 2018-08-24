<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $CombinList = ['A','B','C','D'];
        /* 计算C(a,1) * C(b, 1) * ... * C(n, 1)的值 */
        $CombineCount = 1;
        foreach($CombinList as $Key => $Value)
        {
            $CombineCount *= count($Value);
        }
        $RepeatTime = $CombineCount;
        foreach($CombinList as $ClassNo => $StudentList)
        {
            // $StudentList中的元素在拆分成组合后纵向出现的最大重复次数
            $RepeatTime = $RepeatTime / count($StudentList);
            $StartPosition = 1;
            // 开始对每个班级的学生进行循环
            foreach($StudentList as $Student)
            {
                $TempStartPosition = $StartPosition;
                $SpaceCount = $CombineCount / count($StudentList) / $RepeatTime;
                for($J = 1; $J <= $SpaceCount; $J ++)
                {
                    for($I = 0; $I < $RepeatTime; $I ++)
                    {
                        $Result[$TempStartPosition + $I][$ClassNo] = $Student;
                    }
                    $TempStartPosition += $RepeatTime * count($StudentList);
                }
                $StartPosition += $RepeatTime;
            }
        }
        /* 打印结果 */
        echo "<pre>";
        print_r($Result);
    }
}
