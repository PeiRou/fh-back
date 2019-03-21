<?php
/**
 * Created by PhpStorm.
 * User: ashen
 * Date: 18-11-8
 * Time: 下午5:13
 */

namespace App\Http\Controllers\Common;

include (base_path('/sameClass/Vender/QrCode/phpqrcode.php'));


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function show(Request $request){
        $value = urldecode($request->input('content'));
        $errorCorrectionLevel = 'L';
        $matrixPointSize = 6;
        \QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);
    }
}