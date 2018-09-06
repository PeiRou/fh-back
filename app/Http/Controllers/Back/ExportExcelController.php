<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExportExcelController extends Controller
{
    public function exportExcelForRecharges()
    {
        return response()->json([
            'status' => true
        ]);
    }
}
