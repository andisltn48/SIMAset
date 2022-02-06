<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\AktivitasSistem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class ManajemenProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('profile.index',compact('user'));
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
        $user = User::find($id);
        if ($request->password) {
          $validator = Validator::make($request->all(), [
              'password' => ['min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/','confirmed'],
              'password_confirmation' => ['required'],
          ],
          [
              'password.regex' => 'Must contain at least one uppercase/lowercase letters and one number'
          ]);

          if ($validator->fails()) {
              return redirect()->back()->withErrors($validator->errors());
          }

          $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
          ]);

          $activity = AktivitasSistem::create([
              'user_id' => Auth::user()->id,
              'user_activity' => Auth::user()->name.' melakukan update data akun',

              'user_role' => session('role'),
          ]);


          return redirect()->back()->with('success', 'Berhasil melakukan update data akun');
        } else {
          $user->update([
            'name' => $request->name,
          ]);

          $activity = AktivitasSistem::create([
              'user_id' => Auth::user()->id,
              'user_activity' => Auth::user()->name.' melakukan update data akun',

              'user_role' => session('role'),
          ]);


          return redirect()->back()->with('success', 'Berhasil melakukan update data akun');
        }
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
