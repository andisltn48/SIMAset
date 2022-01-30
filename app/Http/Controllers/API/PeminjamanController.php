<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataPeminjaman;

class PeminjamanController extends Controller
{
    public function peminjaman()
    {
        $datapeminjaman = DataPeminjaman::where('status_peminjaman', 'Dalam Peminjaman')->get();
        return response()->json([
            'message' => 'Success',
            'data' => $datapeminjaman   
        ], 200);
    }

    public function detail($id)
    {
        $datapeminjaman = DataPeminjaman::where('status_peminjaman', 'Dalam Peminjaman')->where('id', $id)->first();
        return response()->json([
            'message' => 'Success',
            'data' => $datapeminjaman   
        ], 200);
    }
}
