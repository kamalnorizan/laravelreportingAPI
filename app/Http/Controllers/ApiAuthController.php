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
            $success['token'] = $user->createToken('Aplikasi Mobil')->accessToken;
            $success['user']=$user;

            return response()->json(['success'=>$success], 200);
        }
    }
}
