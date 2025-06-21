<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regulasi;

class RegulasiController extends Controller
{
    public function index()
    {
        $regulasi = Regulasi::all();
        return view('pages.admin.regulasi.index', compact('regulasi'));
    }

    public function create()
    {
        return view('pages.admin.regulasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_regulasi' => 'required|string|max:255',
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $regulasi = new Regulasi();
        $regulasi->nama_regulasi = $request->nama_regulasi;

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/regulasi');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $regulasi->file_dokumen = 'storage/regulasi/' . $filename;
        }

        if ($regulasi->save()) {
            return redirect()->route('admin.manage-regulasi.index')->with('success', 'Regulasi berhasil disimpan.');
        } else {
            return redirect()->back()->with('failed', 'Regulasi gagal disimpan.');
        }
    }

    public function show($id)
    {
        $regulasi = Regulasi::find($id);
        if (!$regulasi) {
            return redirect()->route('admin.manage-regulasi.index')->with('failed', 'Regulasi tidak ditemukan.');
        }
        return view('pages.admin.regulasi.show', compact('regulasi'));
    }

    public function edit($id)
    {
        $regulasi = Regulasi::find($id);
        if (!$regulasi) {
            return redirect()->route('admin.manage-regulasi.index')->with('failed', 'Regulasi tidak ditemukan.');
        }
        return view('pages.admin.regulasi.edit', compact('regulasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_regulasi' => 'required|string|max:255',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $regulasi = Regulasi::find($id);
        if (!$regulasi) {
            return redirect()->route('manage-regulasi.index')->with('failed', 'Regulasi tidak ditemukan.');
        }

        $regulasi->nama_regulasi = $request->nama_regulasi;

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/regulasi'), $filename);
            $regulasi->file_dokumen = 'storage/regulasi/' . $filename;
        }

        if ($regulasi->save()) {
            return redirect()->route('admin.manage-regulasi.index')->with('success', 'Regulasi berhasil diperbaharui.');
        } else {
            return redirect()->back()->with('failed', 'Regulasi gagal diperbaharui.');
        }
    }

    public function destroy($id)
    {
        $regulasi = Regulasi::find($id);
        if (!$regulasi) {
            return redirect()->route('manage-regulasi.index')->with('failed', 'Regulasi tidak ditemukan.');
        }

        if ($regulasi->delete()) {
            return redirect()->route('admin.manage-regulasi.index')->with('success', 'Regulasi berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Regulasi gagal dihapus.');
        }
    }
}
