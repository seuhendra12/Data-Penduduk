<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinsiKabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $provinsi1 = Provinsi::create(['nama' => 'Jawa Barat']);
        $provinsi2 = Provinsi::create(['nama' => 'Sumatera Selatan']);

        $kabupatenData1 = [
            'Bandung',
            'Bandung Barat',
            'Bekasi',
            'Bogor',
            'Ciamis',
        ];
        $kabupatenData2 = [
            'Palembang',
            'Prabumulih',
            'Lubuklinggau',
            'Pagar Alam',
            'Baturaja',
        ];

        $this->createKabupaten($provinsi1, $kabupatenData1);
        $this->createKabupaten($provinsi2, $kabupatenData2);
    }

    private function createKabupaten($provinsi, $dataKabupaten)
    {
        foreach ($dataKabupaten as $namaKabupaten) {
            Kabupaten::create([
                'nama' => $namaKabupaten,
                'provinsi_id' => $provinsi->id,
            ]);
        }
    }
}
