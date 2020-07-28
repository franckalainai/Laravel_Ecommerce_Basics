<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Validator;

class AdminController extends Controller
{
    public function login(Request $request){

        if($request->isMethod('post')){
            $data = $request->input();

            $validatedData = $request->validate([
                'email' => ['required', 'unique:users', 'max:255'],
                'password' => ['required'],
            ]);

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1'])){
                return redirect('/admin/dashboard');
            }else{
                return redirect('/admin')->with('flash_message_error','Invalid Email or Password');
            }
        }

        return view('admin.admin_login');
    }

    public function dashboard(){
        return view('admin.dashboard');
    }
}
