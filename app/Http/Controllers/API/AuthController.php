<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        // echo $request->email , $request->password;
        $validate = $request->only('email', 'password');

        if (Auth::attempt($validate)) {
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->first();
            // // dd($role->name);
            // if ($role->name == 'User') {
            //     return redirect(route('user.index'));
            // } else {
            //     return redirect(route('pesanan.index'));
            // }
            $token = $request->user()->createToken('token-name')->plainTextToken;
            return response()->json([
                'message' => 'Login Sukses',
                'data' => Auth::user(),
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 200);
        } else {
            return response()->json([
                'data' => $validate,
                'message' => 'Email atau Password salah'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        Auth::guard('web')->logout();
        return response()->json([
            'message' => 'Berhasil Logout'
        ], 200);
    }

    public function not_authenticated(Type $var = null)
    {
        return response()->json([
            'message' => 'Anda belum Login'
        ], 401);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
