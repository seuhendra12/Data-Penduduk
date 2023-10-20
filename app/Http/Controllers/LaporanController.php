<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class LaporanController extends Controller
{
    public function index()
    {
        $provinsis = Provinsi::paginate(10);
        return view('Laporan.laporan-per-provinsi', compact('provinsis'));
    }

    public function pdfLaporanPerProvinsi()
    {
        $provinsis = Provinsi::all();
        $pdf = new Dompdf(); // Buat instance baru dari Dompdf

        // Kirim data tukarPoin ke view
        $pdf->loadHtml(view('laporan.cetak-per-provinsi',compact('provinsis')));

        // (Opsional) Set ukuran kertas dan orientasi
        $pdf->setPaper('A4', 'portrait');

        // Render PDF
        $pdf->render();

        // Tampilkan PDF yang dihasilkan langsung di browser
        $pdf->stream('Laporan_per_provinsi' . '.pdf');
    }
}