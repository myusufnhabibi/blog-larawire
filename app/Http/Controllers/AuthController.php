<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:8'
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/register')->with('success', 'Registrasi Berhasil, Silahkan Login!');
        } catch (\Exception $e) {
            return redirect('/register')->with('error', $e->getMessage());
        }
    }

    public function login()
    {
        return view('login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            $userCredentials = $request->only('email', 'password');

            if (Auth::attempt($userCredentials)) {
                if (auth()->user()->role == 1) { //here role is a column I added in users table
                    return redirect('user/home');
                } elseif (auth()->user()->role == 0) {
                    return redirect('admin/home');
                } else {
                    return redirect('/login')->with('error', 'Role tidak ditemukan');
                }
            } else {
                return redirect('/login')->with('error', 'Email/ Password Salah');
            }
        } catch (\Exception $th) {
            return redirect('/login')->with('error', $th->getMessage());
            //throw $th;
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

    public function load404()
    {
        return view('404');
    }
}
