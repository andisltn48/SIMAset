<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\AktivitasSistem;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        // echo $request->email , $request->password;
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } 

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

    public function registerSA(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'password' => ['min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/','confirmed','required'],
            'password_confirmation' => ['required'],
            'email' => ['unique:users,email','required']
        ],
        [
            'password.regex' => 'Must contain at least one uppercase/lowercase letters and one number'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => \Str::random(50),
            'role_id' => '1',
        ]);
        
        $activity = AktivitasSistem::create([
            'user_id' => $user->id,
            'user_activity' => $user->name.' melakukan registrasi ke dalam sistem',

            'user_role' => 'Super Admin',
        ]);

        if ($user) {
            return response()->json([
                'statusCode' => 201,
                'message' => 'create SA account successfully'
            ], 201);
        }
    }
}
