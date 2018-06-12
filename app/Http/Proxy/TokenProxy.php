<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/1/22
 * Time: 下午6:08
 */

namespace App\Http\Proxy;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class TokenProxy
{
    /**
     * TokenProxy constructor.
     */
    public function __construct()
    {
        $this->user = new User();
    }

    public function proxy(array $data = [])
    {
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($data)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_email_or_password',
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }
        return response()->json([
            'response' => 'success',
            'result' => [
                'token' => $token,
            ],
        ]);
    }

    public function guestTokenProxy(array $data = [])
    {
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($data)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_email_or_password',
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }
        return $token;
    }
}