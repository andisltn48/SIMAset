<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\AktivitasSistem;

class AktivitasSistemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function test(Request $request)
    {
        $input = $request->all();
        foreach ($request->a as $key => $value) {
            $arr[] = [
                'a' => $value,
                'b' => $input['b'][$key],
                'c' => $input['c'][$key],
                'd' => $input['d'][$key],
            ];
        }
        dd($arr);
    } 

    public function index()
    {
        return view('aktivitas-sistem.index');
    }

    public function get_aktivitas()
    {
        $aktivitas = AktivitasSistem::leftjoin('users','users.id','aktivitas_sistem.user_id')
        ->select('aktivitas_sistem.*','users.name');
        $datatables = Datatables::of($aktivitas);
        $datatables->orderColumn('created_at', function ($query, $order) {
            $query->orderBy('aktivitas_sistem.created_at', $order);
        });
        return $datatables->addIndexColumn()
        ->escapeColumns([])
        ->addColumn('action','aktivitas-sistem.action')
        ->toJson();
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
        $aktivitas = AktivitasSistem::find($id);
        $aktivitas->delete();
        return redirect()->back()->with('success','Berhasil menghapus aktivitas');
    }
}
