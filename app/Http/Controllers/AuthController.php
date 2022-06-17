<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AktivitasSistem;
use App\Roles;
use App\PasswordReset;
use App\EmailVerify;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::find(Auth::user()->id);
            $role = Roles::find($user->role_id);
            session(['role' => $role->name]);

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => $user->name.' melakukan login ke dalam sistem',

                'user_role' => session('role'),
            ]);

            if ($role->name == 'Peminjam') {
                return redirect('form-peminjaman');
            }
            if ($role->name == 'Unit') {
                return redirect('form-pengajuan');
            }
            return redirect('data-aset');
        }
        return redirect('/')->with('error', 'Email atau Password anda salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function register(Request $request){
        $request->validate(
            [
                'name' => ['required'],
                'password' => ['min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/','confirmed','required'],
                'password_confirmation' => ['required'],
                'email' => ['unique:users,email','required']
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

        $activity = AktivitasSistem::create([
            'user_id' => $user->id,
            'user_activity' => $user->name.' melakukan registrasi ke dalam sistem',

            'user_role' => 'Peminjam',
        ]);

        if ($user) {
            return redirect(route('register'))->with('success', 'Berhasil membuat akun');
        }
    }

    public function showForgetPasswordForm()
    {
        return view('forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        // DB::table('password_resets')->insert([
        //     'email' => $request->email,
        //     'token' => $token,
        //     'created_at' => Carbon::now()
        // ]);

        $cektable = PasswordReset::where('email', $request->email)->get();
        foreach ($cektable as $key => $value) {
          $value->delete();
        }

        $table = PasswordReset::create([
            'email' => $request->email,
            'token' => $token,
        ]);

        Mail::send('forgetPasswordView', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('success', 'Kami telah mengirimkan link reset password ke email anda');
    }

    public function showResetPasswordForm($token)
    {
        return view('forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirmation' => 'required'
        ],
        [
            'password.regex' => 'Must contain at least one uppercase/lowercase letters and one number'
        ]);

        $updatePassword = PasswordReset::where([
                              'email' => $request->email,
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Token tidak ditemukan!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        $currUser = User::where('email', $request->email)->first();
        $activity = AktivitasSistem::create([
            'user_id' => $currUser->id,
            'user_activity' => $currUser->name.' melakukan perubahan password',

            'user_role' => session('role'),
        ]);

        return redirect('/')->with('success', 'Anda telah berhasil mengubah password anda');
    }

    public function emailVerifyForm()
    {
        $user = User::find(Auth::user()->id);
        if ($user->email_verified_at != NULL) {
          return redirect('/')->with('error', 'Email anda sudah di verifikasi silahkan melakukan login ulang');
        }
        return view('emailVerify');
    }

    public function submitEmailVerifyForm(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email|exists:users',
        // ]);

        // dd(Auth::user()->email);
        $token = Str::random(64);

        // DB::table('password_resets')->insert([
        //     'email' => $request->email,
        //     'token' => $token,
        //     'created_at' => Carbon::now()
        // ]);

        $cektable = EmailVerify::where('email', Auth::user()->email)->get();
        foreach ($cektable as $key => $value) {
          $value->delete();
        }

        $table = EmailVerify::create([
            'email' => Auth::user()->email,
            'token' => $token,
        ]);

        Mail::send('emailVerifyView', ['token' => $token], function($message) use($request){
            $message->to(Auth::user()->email);
            $message->subject('Verifikasi Email');
        });

        return back()->with('success', 'Kami telah mengirim link verifikasi ke email anda');
    }

    public function submitEmailVerify($token)
    {
        $emailVerify = EmailVerify::where('token',$token)->first();

        if(!$emailVerify){
            return back()->withInput()->with('error', 'Token tidak ditemukan!');
        }

        $user = User::where('email', $emailVerify->email)
                    ->update(['email_verified_at' => Carbon::now()]);

        DB::table('email_verify')->where(['email'=> $emailVerify->email])->delete();

        $currUser = User::where('email', $emailVerify->email)->first();
        $activity = AktivitasSistem::create([
            'user_id' => $currUser->id,
            'user_activity' => $currUser->name.' melakukan verifikasi email',

            'user_role' => session('role'),
        ]);

        return redirect('/')->with('success', 'Anda telah berhasil melakukan verifikasi email anda');
    }
}
