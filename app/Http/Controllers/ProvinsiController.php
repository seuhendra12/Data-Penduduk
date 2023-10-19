<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function index()
    {
        $provinsis = Provinsi::paginate(10);
        return view('provinsi.index', compact('provinsis'));
    }

    public function create()
    {
        return view('provinsi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ], [
            'nama.required' => 'Kolom nama provinsi wajib diisi'
        ]);

        Provinsi::create([
            'nama' => $request->input('nama')
        ]);

        return redirect('provinsi')->with('success', 'Data berhasil ditambah');
    }

    public function edit(string $id)
    {
        $provinsi = Provinsi::findOrFail($id);
        return view('provinsi.edit', compact('provinsi'));
    }

    public function update(Request $request, string $id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $request->validate([
            'nama' => 'required'
        ]);

        $provinsi->update([
            'nama' => $request->input('nama')
        ]);

        return redirect('provinsi')->with('success', 'Data berhasil diubah');
    }

    public function destroy(string $id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function trash()
    {
        $provinsis = Provinsi::onlyTrashed()->paginate(10);
        return view('provinsi.trash', compact('provinsis'));
    }

    public function restore($id)
    {
      $provinsi = Provinsi::withTrashed()->find($id); // Mengambil data yang dihapus secara lembut
      $provinsi->restore();
  
      return redirect('provinsi')->with('success', 'Data berhasil dipulihkan');
    }
  
    public function forceDelete($id)
    {
      $provinsi = Provinsi::withTrashed()->where('id', $id)->first();
      $provinsi->forceDelete();
  
      return redirect()->back()->with('success', 'Data berhasil dihapus secara permanen');
    }
}
