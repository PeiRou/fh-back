<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class test extends Controller
{
    public function plan(Request $request)
    {
        \Log::info($request->all());
    }
}
