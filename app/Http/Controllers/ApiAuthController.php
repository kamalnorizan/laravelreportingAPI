<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $userCheck = User::where('email',$request->email)->first();

        if($userCheck){

            if($userCheck->role=='admin'){
                $scope = ['show-posts','edit-post','create-post','delete-post'];
            }else{
                $scope = ['show-posts'];
            }
            $success['token'] = $userCheck->createToken('Aplikasi Mobil',['show-posts','edit-post','create-post'])->accessToken;
            $success['user']=$userCheck;
            $success['scope']=$scope;

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
