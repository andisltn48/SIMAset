<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Unit;
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

class DataUnitImport implements ToModel , WithHeadingRow, SkipsEmptyRows, SkipsOnFailure, SkipsOnError,WithValidation
{
    /**
    * @param Collection $collection
    */
    use Importable, SkipsFailures, SkipsErrors;
    public function model(array $row)
    {
      Unit::create([
        'nama_unit' => $row["nama_unit"],
        'kode_unit' => $row["kode_unit"]
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
            "*.kode_unit" => 'required|unique:units,kode_unit',
            "*.nama_unit" => 'required',
        ];
    }
}
