<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\DataRuangan;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DataRuanganImport implements ToModel , WithHeadingRow, SkipsEmptyRows, SkipsOnFailure, SkipsOnError,WithValidation
{
    /**
    * @param Collection $collection
    */
    use Importable, SkipsFailures, SkipsErrors;
    public function model(array $row)
    {
      DataRuangan::create([
        'kode_ruangan' => $row["kode"],
        'nama_ruangan' => $row["nama_ruang"],
        'pj' => $row["penanggungjawab_ruangan"],
        'nip' => $row["nip"],
        'kode_gedung' => $row["kode_gedung"],
      ]);
      // dd($row);
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function rules(): array
    {
        return [
            "*.kode" => 'required|unique:data_ruangan,kode_ruangan',
            "*.nama_ruang" => 'required',
            "*.penanggungjawab_ruangan" => 'required',
            "*.nip" => 'required', 'numeric',
            "*.kode_gedung" => 'required|numeric',
        ];
    }
}
