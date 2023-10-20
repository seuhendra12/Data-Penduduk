<?php

namespace App\Exports;

use App\Models\Kabupaten;
use App\Models\Penduduk;
use App\Models\Provinsi;
use Maatwebsite\Excel\Concerns\FromCollection;

class PendudukExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Penduduk::select('id', 'nik', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'provinsi_id', 'kabupaten_id')
            ->get()
            ->map(function ($penduduk) {
                $provinsi = Provinsi::find($penduduk->provinsi_id);
                $kabupaten = Kabupaten::find($penduduk->kabupaten_id);

                $filteredData = $penduduk->only(['id', 'nik', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'alamat']);
                $filteredData['provinsi'] = $provinsi ? $provinsi->nama : 'N/A';
                $filteredData['kabupaten'] = $kabupaten ? $kabupaten->nama : 'N/A';

                return $filteredData;
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIK',
            'Nama',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Alamat',
            'Provinsi',
            'Kabupaten'
        ];
    }
}
