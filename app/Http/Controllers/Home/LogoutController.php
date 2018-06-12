<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout()
    {
        Session::flush();
        return response()->json([
           'logout'=>true
        ]);
    }
}
