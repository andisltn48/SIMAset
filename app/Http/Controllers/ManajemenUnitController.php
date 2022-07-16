<?php

namespace App\Http\Controllers;

use App\Unit;
use App\DataInventaris;
use App\Roles;
use Auth;
use App\AktivitasSistem;
use Yajra\Datatables\Datatables;

use App\Imports\DataUnitImport;
use Illuminate\Http\Request;

class ManajemenUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unit.index');
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
        $request->validate([
            'kode' => 'unique:units,kode_unit'
        ]);
        $storeunit = Unit::create([
            'nama_unit' => $request->nama,
            'kode_unit' => $request->kode
        ]);

        if ($storeunit) {
            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan tambah data unit',

                'user_role' => Roles::find(Auth::user()->role_id)->name,
            ]);
            return redirect()->back()->with('success', 'Data unit berhasil ditambahkan');
        }
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
        $unit = Unit::find($id);
        if ($unit) {
            $unit->update([
                'nama_unit' => $request->nama,
            ]);

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan update data unit',

                'user_role' => Roles::find(Auth::user()->role_id)->name,
            ]);

            return redirect()->back()->with('success', 'Data unit berhasil diupdate');
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
        $unit = Unit::find($id);
        $dataInventaris = DataInventaris::where('unit',$unit->kode_unit)->first();
        if (!$dataInventaris) {
            $unit->delete();

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan hapus data unit',

                'user_role' => Roles::find(Auth::user()->role_id)->name,
            ]);
            return redirect()->back()->with('success', 'Data unit berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Data unit sedang digunakan');
        }
    }

    public function get_data_unit(Request $request)
    {
        $unit = Unit::select('units.*');
        $datatables = Datatables::of($unit);
        if (isset($request->search['value'])) {
            $datatables->filter(function ($query) {
                    $keyword = request()->get('search')['value'];
                    $query->where('units.kode_unit', 'like', "%" . $keyword . "%");

        });}
        $datatables->orderColumn('units.kode_unit', function ($query, $order) {
            $query->orderBy('units.kode_unit', $order);
        });
        return $datatables->addIndexColumn()
        ->addColumn('action','unit.action')
        ->toJson();
    }

    public function importexcel(Request $request){
        $file = $request->file('fileimport')->getRealPath();
        $import = new DataUnitImport();
        $import->import($file);
        $main_array = [];
        $message = '';
        if ($import->failures()->isNotEmpty()) {
            foreach ($import->failures() as $rows) {
              $seccond_array = [
                'kode' => $rows->values()["kode_unit"],
                'nama' => $rows->values()["nama_unit"],
                'message' => $rows->errors()[0]
              ];

              $main_arrays[] = $seccond_array;
            //   array_push($main_arrays, $seccond_array);
              // var_dump($rows->values()["kode"]);
            }
        } else {
            $main_arrays = NULL;
        }

        $activity = AktivitasSistem::create([
            'user_id' => Auth::user()->id,
            'user_activity' => Auth::user()->name.' melakukan impor data unit',

            'user_role' => session('role'),
        ]);
    // $myJSON = json_encode($json_failed);
        if ($main_arrays != NULL) {
            return redirect()->back()->with('error',$main_arrays);
        } else {
            return redirect()->back()->with('success', 'berhasil melakukan import data ruangan');
        }

    }

    public function import_template(){
        $filepath = public_path('template-import-unit/template-impor-unit.xlsx');
        return response()->download($filepath);
    }
}
