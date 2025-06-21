<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\sejarah;

class sejarahController extends Controller
{
    public function index(Request $request)
    {
        $dataview = new \stdClass();
        $dataview->title = 'Sejarah | ' . getTitle();
        $dataview->page_title = 'Data Sejarah';

        $sejarahs = sejarah::orderBy('tahun', 'asc')->get();

        $edit = null;
        $sejarah = null;

        if ($request->has('edit')) {
            $edit = true;
            $sejarah = sejarah::findOrFail($request->edit);
        }

        return view('pages.admin.sejarah', compact('dataview', 'sejarahs', 'edit', 'sejarah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|numeric',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $sejarah = new sejarah();
        $sejarah->tahun = $request->tahun;
        $sejarah->judul = $request->judul;
        $sejarah->deskripsi = $request->deskripsi;

        if ($request->hasFile('file_gambar')) {
            $file = $request->file('file_gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('storage/images/sejarah');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $sejarah->file_gambar = 'storage/images/sejarah/' . $filename;
        }

        $sejarah->save();

        return redirect()->route('sejarah.index')->with('success', 'Data sejarah berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required|numeric',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $sejarah = sejarah::findOrFail($id);
        $sejarah->tahun = $request->tahun;
        $sejarah->judul = $request->judul;
        $sejarah->deskripsi = $request->deskripsi;

        if ($request->hasFile('file_gambar')) {
            if ($sejarah->file_gambar && file_exists(public_path($sejarah->file_gambar))) {
                unlink(public_path($sejarah->file_gambar));
            }

            $file = $request->file('file_gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('storage/images/sejarah');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $sejarah->file_gambar = 'storage/images/sejarah/' . $filename;
        }

        $sejarah->save();

        return redirect()->route('sejarah.index')->with('success', 'Data sejarah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sejarah = sejarah::findOrFail($id);
        if ($sejarah->file_gambar && file_exists(public_path($sejarah->file_gambar))) {
            unlink(public_path($sejarah->file_gambar));
        }

        $sejarah->delete();

        return redirect()->back()->with('success', 'Data sejarah berhasil dihapus.');
    }
}
