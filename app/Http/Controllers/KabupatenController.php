<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupatens = Kabupaten::orderBy('nama')
            ->paginate(10);
        return view('kabupaten.index', compact('kabupatens'));
    }

    public function create()
    {
        $provinsis = Provinsi::all();
        return view('kabupaten.create', compact('provinsis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'provinsi' => 'required',
            'nama' => 'required'
        ], [
            'provinsi.required' => 'Kolom provinsi wajib diisi',
            'nama.required' => 'Kolom nama wajib diisi'
        ]);

        Kabupaten::create([
            'provinsi_id' => $request->input('provinsi'),
            'nama' => $request->input('nama')
        ]);

        return redirect('/kabupaten')->with('success', 'Data berhasil ditambah');
    }

    public function edit(string $id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        $provinsis = Provinsi::all();
        return view('kabupaten.edit', compact('kabupaten','provinsis'));
    }

    public function update(Request $request, string $id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        $request->validate([
            'nama' => 'required'
        ],[
            'nama.required' => 'Kolom nama wajib diisi'
        ]);

        $kabupaten->update([
            'provinsi_id' => $request->input('provinsi'),
            'nama' => $request->input('nama')
        ]);

        return redirect('/kabupaten')->with('success', 'Data berhasil ubah');
    }

    public function destroy(string $id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        $kabupaten->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function trash()
    {
        $kabupatens = Kabupaten::onlyTrashed()->paginate(10);
        return view('kabupaten.trash', compact('kabupatens'));
    }

    public function restore($id)
    {
      $kabupaten = Kabupaten::withTrashed()->find($id); // Mengambil data yang dihapus secara lembut
      $kabupaten->restore();
  
      return redirect('/kabupaten')->with('success', 'Data berhasil dipulihkan');
    }
  
    public function forceDelete($id)
    {
      $kabupaten = Kabupaten::withTrashed()->where('id', $id)->first();
      $kabupaten->forceDelete();
  
      return redirect()->back()->with('success', 'Data berhasil dihapus secara permanen');
    }
}
