<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $credential = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if(Auth::attempt($credential)){
            $user = Auth::user();
            $success['token'] = $user->createToken('Aplikasi Mobil',['show-posts'])->accessToken;
            $success['user']=$user;

            return response()->json(['success'=>$success], 200);
        }else{
            return response()->json(['fail'=>'Wrong username / password'], 302);
        }
    }

    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json(['status'=>'success'], 200);
    }
}
