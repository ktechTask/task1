<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function pageLogin(){
        return view('admin.component.login');
    }
    public function login(Request $request){
        $dataLogin = [  
            'email' => $request->email,
            'password' => $request->password,
        ];


        $status = Auth::attempt($dataLogin, $request->remember == 1 ? true : false);

        if ($status) {
            return redirect()->route('admin.index');
        } else {
            return  redirect()->back();
        }
    }
}
