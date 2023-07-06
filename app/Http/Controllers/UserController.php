<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function view_login(){
        if (session()->get('user')){
            return redirect('dashboard');
        }

        return view('login');
    }

    public function login(Request $request){
        if(Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
            $user = Auth::user();

            request()->session()->put('user', Auth::user());
        } else {
            return redirect()->back()->with('error', 'Email Atau Password Anda Salah');
        }
        $id = session()->get('user')->id;

        Log::channel('process')->info("User dengan id {id} telah login", ['id' => $id]);
        return redirect('dashboard');
    }

    public function logout(){
        $id = session()->get('user')->id;
        request()->session()->forget('user');
        Auth::logout();
        Log::channel('process')->info("User dengan id {id} telah logout", ['id' => $id]);
        return redirect('user/login')->with('message', 'Sukses Melakukan Logout');
    }
}