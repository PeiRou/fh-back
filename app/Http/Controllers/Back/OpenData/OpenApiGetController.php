<?php

namespace App\Http\Controllers\Back\OpenData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpenApiGetController extends Controller
{
    public function lhc($issue = '')
    {
        return response()->json([
            'issue'=> $issue
        ]);
    }
}
