<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $nums = range(1,10);
        shuffle($nums);
        shuffle($nums);
        shuffle($nums);
        $opennums = $nums[0].','.$nums[1].','.$nums[2].','.$nums[3].','.$nums[4].','.$nums[5].','.$nums[6].','.$nums[7].','.$nums[8].','.$nums[9];
        return $opennums;
    }
}
