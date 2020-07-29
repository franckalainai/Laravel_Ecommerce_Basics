<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Session;

class AdminController extends Controller
{
    public function login(Request $request){

        if($request->isMethod('post')){
            $data = $request->input();

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1'])){
                /*Session::put('adminSession', $data['email']);*/
                return redirect('/admin/dashboard');
            }else{
                return redirect('/admin')->with('flash_message_error','Invalid Email or Password');
            }
        }



        return view('admin.admin_login')->with('flash_message_success', 'Logged in Successfully');
    }

    public function dashboard(){
        /*if(Session::has('adminSession')){

        }else{
            return redirect('/admin')->with('flash_message_error', 'please login to access');
        }*/
        return view('admin.dashboard');
    }

    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged out Successfully');
    }

    public function settings(){
        return view('admin.settings');
    }
}
