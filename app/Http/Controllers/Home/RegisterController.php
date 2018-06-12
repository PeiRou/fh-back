<?php

namespace App\Http\Controllers\Home;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'username' => 'required|string|min:6|max:15|unique:users',
            'fullName' => 'required|string|min:2|max:10|unique:users',
            'password' => 'required|string|min:6|max:100',
        ]);
        if($validator->fails()) {
            return response()->json(['code'=>$validator->errors()],200);
        }

        if(!preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$request->input('fullName'))){
            return response()->json(['code'=>['fullName'=>'真实姓名必须是汉字']],200);
        }

        $user = new User();
        $user->fullName = $request->fullName;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->email = 0;
        $user->agent = 1;
        $save = $user->save();
        if($save == 1){
            return response()->json(['success'],200);
        } else {
            return response()->json(['error'],500);
        }

        //return $request->all();
        //event(new Registered($user = $this->create($requestData->all())));
        //$this->guard()->login($user);
    }


    protected function validator(array $data)
    {
        $validator = \Validator::make($data, [
            'username' => 'required|string|min:6|max:15',
            'fullName' => 'required|string|min:2|max:10',
            'password' => 'required|string|min:6|max:15',
        ]);
        if($validator->fails()) {
            return $validator->errors();
        }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'fullName' =>  $data['fullName'],
            'email' =>'',
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

}
