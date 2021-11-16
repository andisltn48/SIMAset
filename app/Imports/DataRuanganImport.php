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

class DataRuanganImport implements ToModel,WithValidation , WithHeadingRow, SkipsEmptyRows, SkipsOnFailure, SkipsOnError
{
    /**
    * @param Collection $collection
    */
    use Importable, SkipsFailures, SkipsErrors;
    public function collection(Collection $collection)
    {

    }

    public function headingRow(): int
    {
        return 4;
    }

    public function rules(): array
    {

        return [
            "*.nama_barang" => ['required'],
            "*.kode_barang" => ['required', 'numeric'],
        ];
    }
}
