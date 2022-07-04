<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;
use App\AktivitasSistem;
use App\Roles;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManajemenUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::all();
        return view('manajemen-user.index', compact('roles'));
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
      $validator = Validator::make($request->all(), [
        'password' => ['min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/','confirmed'],
        'password_confirmation' => ['required'],
        'email' => ['unique:users,email']
      ],
      [
          'password.regex' => 'Must contain at least one uppercase/lowercase letters and one number'
      ]);

      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator->errors());
      }

      $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
          'remember_token' => \Str::random(50),
          'role_id' => $request->role,
      ]);

      $activity = AktivitasSistem::create([
          'user_id' => Auth::user()->id,
          'user_activity' => Auth::user()->name.' melakukan tambah akun',

          'user_role' => Roles::find(Auth::user()->role_id)->name,
      ]);

      return redirect()->back()->with('success', 'Berhasil membuat akun');
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
              'user_activity' => Auth::user()->name.' melakukan update user',

              'user_role' => Roles::find(Auth::user()->role_id)->name,
          ]);


          return redirect()->back()->with('success', 'Berhasil melakukan update user');
        } else {
          $user->update([
            'name' => $request->name,
          ]);

          $activity = AktivitasSistem::create([
              'user_id' => Auth::user()->id,
              'user_activity' => Auth::user()->name.' melakukan update user',

              'user_role' => Roles::find(Auth::user()->role_id)->name,
          ]);


          return redirect()->back()->with('success', 'Berhasil melakukan update user');
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
        $user = User::find($id);
        $user->delete();

        $activity = AktivitasSistem::create([
            'user_id' => Auth::user()->id,
            'user_activity' => Auth::user()->name.' melakukan delete user',

            'user_role' => Roles::find(Auth::user()->role_id)->name,
        ]);


        return redirect()->back()->with('success', 'Berhasil melakukan delete user');
    }

    public function get_superadmin(Request $request)
    {
      $user = User::where('role_id',1)
      ->select('users.*');
      $datatables = Datatables::of($user);
      if (isset($request->search['value'])) {
          $datatables->filter(function ($query) {
            $keyword = request()->get('search')['value'];
            $query->where('users.email', 'like', "%" . $keyword . "%");

      });}
      $datatables->orderColumn('updated_at', function ($query, $order) {
          $query->orderBy('users.updated_at', $order);
      });
      return $datatables->addIndexColumn()
      ->escapeColumns([])
      ->addColumn('action','manajemen-user.action')
      ->toJson();
    }

    public function get_admin(Request $request)
    {
      $user = User::where('role_id',2)
      ->select('users.*');
      $datatables = Datatables::of($user);
      if (isset($request->search['value'])) {
          $datatables->filter(function ($query) {
            $keyword = request()->get('search')['value'];
            $query->where('users.email', 'like', "%" . $keyword . "%");

      });}
      $datatables->orderColumn('updated_at', function ($query, $order) {
          $query->orderBy('users.updated_at', $order);
      });
      return $datatables->addIndexColumn()
      ->escapeColumns([])
      ->addColumn('action','manajemen-user.action')
      ->toJson();
    }

    

    public function get_sarpras(Request $request)
    {
      $user = User::where('role_id',3)
      ->select('users.*');
      $datatables = Datatables::of($user);
      if (isset($request->search['value'])) {
          $datatables->filter(function ($query) {
            $keyword = request()->get('search')['value'];
            $query->where('users.email', 'like', "%" . $keyword . "%");

      });}
      $datatables->orderColumn('updated_at', function ($query, $order) {
          $query->orderBy('users.updated_at', $order);
      });
      return $datatables->addIndexColumn()
      ->escapeColumns([])
      ->addColumn('action','manajemen-user.action')
      ->toJson();
    }

    public function get_peminjam(Request $request)
    {
      $user = User::where('role_id',4)
      ->select('users.*');
      $datatables = Datatables::of($user);
      if (isset($request->search['value'])) {
          $datatables->filter(function ($query) {
            $keyword = request()->get('search')['value'];
            $query->where('users.email', 'like', "%" . $keyword . "%");

      });}
      $datatables->orderColumn('updated_at', function ($query, $order) {
          $query->orderBy('users.updated_at', $order);
      });
      return $datatables->addIndexColumn()
      ->escapeColumns([])
      ->addColumn('action','manajemen-user.action')
      ->toJson();
    }


    public function get_pengaju(Request $request)
    {
      $user = User::where('role_id',5)
      ->select('users.*');
      $datatables = Datatables::of($user);
      if (isset($request->search['value'])) {
          $datatables->filter(function ($query) {
            $keyword = request()->get('search')['value'];
            $query->where('users.email', 'like', "%" . $keyword . "%");

      });}
      $datatables->orderColumn('updated_at', function ($query, $order) {
          $query->orderBy('users.updated_at', $order);
      });
      return $datatables->addIndexColumn()
      ->escapeColumns([])
      ->addColumn('action','manajemen-user.action')
      ->toJson();
    }
}
