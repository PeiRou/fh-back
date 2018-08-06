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
        return $nums;
    }
}
