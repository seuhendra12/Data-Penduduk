<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Penduduk;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PendudukController extends Controller
{
  public function index(Request $request)
  {
    $provinsis = Provinsi::all();
    $kabupatens = Kabupaten::all();

    $provinsiId = $request->input('provinsi');
    $kabupatenId = $request->input('kabupaten');

    $query = Penduduk::query();

    if ($provinsiId) {
      $query->where('provinsi_id', $provinsiId);
    }

    if ($kabupatenId) {
      $query->where('kabupaten_id', $kabupatenId);
    }

    $search = $request->input('search');

    if ($search) {
      $query->where(function ($query) use ($search) {
        $query->where('nama', 'LIKE', "%$search%")
          ->orWhere('nik', 'LIKE', "%$search%");
      });
    }

    $penduduks = $query->paginate(10);
    return view('penduduk.index', compact('provinsis', 'kabupatens', 'penduduks'));
  }

  public function create()
  {
    $provinsis = Provinsi::get();
    $kabupatens = Kabupaten::get();
    return view('penduduk.create', compact('provinsis', 'kabupatens'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'nik' => 'required|min:16|max:18|unique:penduduks',
      'nama' => 'required',
      'jenis_kelamin' => 'required',
      'tanggal_lahir' => 'required',
      'alamat' => 'required',
      'provinsi' => 'required',
      'kabupaten' => 'required'
    ], [
      'nik.required' => 'Kolom nik wajib diisi',
      'nik.min' => 'Minimal 16 Karakter',
      'nik.max' => 'Maksimal hanya boleh 18 karakter',
      'nik.unique' => 'Data tersebut sudah ada',
      'nama.required' => 'Kolom nama wajib diisi',
      'jenis_kelamin.required' => 'Kolom jenis kelamin wajib diisi',
      'tanggal_lahir.required' => 'Kolom tanggal lahir wajib diisi',
      'alamat.required' => 'Kolom alamat wajib diisi',
      'provinsi.required' => 'Kolom provinsi wajib diisi',
      'kabupaten.required' => 'Kolom kabupaten wajib diisi',
    ]);

    Penduduk::create([
      'nik' => $request->input('nik'),
      'nama' => $request->input('nama'),
      'jenis_kelamin' => $request->input('jenis_kelamin'),
      'tanggal_lahir' => $request->input('tanggal_lahir'),
      'alamat' => $request->input('alamat'),
      'provinsi_id' => $request->input('provinsi'),
      'kabupaten_id' => $request->input('kabupaten'),
    ]);

    return redirect('/')->with('success', 'Data berhasil ditambah');
  }

  public function edit($id)
  {
    $penduduk = Penduduk::findOrFail($id);
    $provinsis = Provinsi::get();
    $kabupatens = Kabupaten::get();
    return view('penduduk.edit', compact('penduduk', 'provinsis', 'kabupatens'));
  }

  public function update(Request $request, $id)
  {
    $penduduk = Penduduk::findOrFail($id);
    $request->validate([
      'nik' => "required|min:16|max:18|unique:penduduks,nik,$id",
      'nama' => 'required',
      'jenis_kelamin' => 'required',
      'tanggal_lahir' => 'required',
      'alamat' => 'required',
      'provinsi' => 'required',
      'kabupaten' => 'required'
    ], [
      'nik.min' => 'Minimal 16 Karakter',
    ]);

    $penduduk->update([
      'nik' => $request->input('nik'),
      'nama' => $request->input('nama'),
      'jenis_kelamin' => $request->input('jenis_kelamin'),
      'tanggal_lahir' => $request->input('tanggal_lahir'),
      'alamat' => $request->input('alamat'),
      'provinsi_id' => $request->input('provinsi'),
      'kabupaten_id' => $request->input('kabupaten'),
    ]);

    return redirect('/')->with('success', 'Data berhasil diubah');
  }

  public function destroy($id)
  {
    $penduduk = Penduduk::findOrFail($id);
    $penduduk->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus.');
  }

  public function trash()
  {
    $penduduks = Penduduk::onlyTrashed()->paginate(10);
    return view('penduduk.trash', compact('penduduks'));
  }

  public function restore($id)
  {
    $penduduk = Penduduk::withTrashed()->find($id); // Mengambil data yang dihapus secara lembut
    $penduduk->restore();

    return redirect('/')->with('success', 'Data berhasil dipulihkan');
  }

  public function forceDelete($id)
  {
    $penduduk = Penduduk::withTrashed()->where('id', $id)->first();
    $penduduk->forceDelete();

    return redirect()->back()->with('success', 'Data berhasil dihapus secara permanen');
  }
}
