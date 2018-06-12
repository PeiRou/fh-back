<?php

namespace App\Http\Controllers\Chat\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index(){

        //dd(auth()->guard('chat')->logout());
        auth()->guard('chat')->logout();
        return view('chat.backend.index');

    }



}
