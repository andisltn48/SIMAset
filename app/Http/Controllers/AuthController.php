<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->first();
            $role = Roles::where('id',$user->role_id)->first();
            session(['role' => $role->name]);
            // dd($role->name);
            if ($role->name == 'Peminjam') {
                return redirect('form-peminjaman');
            }
            return redirect('data-aset');
        }
        return redirect('/')->with('error', 'Email atau Password anda salah!');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }

    public function register(Request $request){
        $request->validate(
            [
                'password' => ['min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
                'email' => ['unique:users,email']
            ],
            [
                'password.regex' => 'Must contain at least one uppercase/lowercase letters and one number'
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => \Str::random(50),
            'role_id' => '5',
        ]);

        return redirect('/')->with('success', 'Berhasil membuat akun');    }
}
