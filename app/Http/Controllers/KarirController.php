<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karir;
use Illuminate\Support\Facades\Auth;

class KarirController extends Controller
{
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Karir | ' . getTitle();
        $dataview->page_title = 'Manajemen Karir';
        $dataview->data_admin = Auth::guard('admin')->user();

        $dataview->karir = Karir::orderBy('id_karir', 'DESC')->get();

        return view('pages/admin/karir', compact('dataview'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_posisi'    => 'required|string|max:255',
            'divisi'          => 'required|string|max:255',
            'penempatan'      => 'required|string',
            'deskripsi'       => 'required|string',
            'kualifikasi'     => 'required|string',
            'benefit'         => 'nullable|string',
            'batas_lamar'     => 'nullable|date',
            'kuota'           => 'required|integer|min:0',
            'status'          => 'required|in:Aktif,Non Aktif',
            'dokumen_syarat'  => 'nullable|file|mimes:pdf,doc,docx|max:5048',
            'foto'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $karir = new Karir($request->except(['dokumen_syarat', 'foto']));

        // Simpan dokumen syarat
        if ($request->hasFile('dokumen_syarat')) {
            $file = $request->file('dokumen_syarat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/karir/dokumen_syarat');
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);
            $file->move($destinationPath, $filename);
            $karir->dokumen_syarat = 'storage/karir/dokumen_syarat/' . $filename;
        }

        // Simpan foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/karir/foto_karir');
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);
            $file->move($destinationPath, $filename);
            $karir->foto = 'storage/karir/foto_karir/' . $filename;
        }

        if ($karir->save()) {
            return redirect()->back()->with('success', 'Lowongan berhasil disimpan.');
        } else {
            return redirect()->back()->with('failed', 'Gagal menyimpan data.');
        }
    }

    public function update(Request $request, $id)
    {
        $karir = Karir::findOrFail($id);

        $request->validate([
            'judul_posisi'    => 'required|string|max:255',
            'divisi'          => 'required|string|max:255',
            'penempatan'      => 'required|string',
            'deskripsi'       => 'required|string',
            'kualifikasi'     => 'required|string',
            'benefit'         => 'nullable|string',
            'batas_lamar'     => 'nullable|date',
            'kuota'           => 'required|integer|min:0',
            'status'          => 'required|in:Aktif,Non Aktif',
            'dokumen_syarat'  => 'nullable|file|mimes:pdf,doc,docx|max:5048',
            'foto'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $karir->fill($request->except(['dokumen_syarat', 'foto']));

        // Update dokumen syarat
        if ($request->hasFile('dokumen_syarat')) {
            if ($karir->dokumen_syarat && file_exists(public_path($karir->dokumen_syarat))) {
                unlink(public_path($karir->dokumen_syarat));
            }
            $file = $request->file('dokumen_syarat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/karir/dokumen_syarat');
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);
            $file->move($destinationPath, $filename);
            $karir->dokumen_syarat = 'storage/karir/dokumen_syarat/' . $filename;
        }

        // Update foto
        if ($request->hasFile('foto')) {
            if ($karir->foto && file_exists(public_path($karir->foto))) {
                unlink(public_path($karir->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/karir/foto_karir');
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);
            $file->move($destinationPath, $filename);
            $karir->foto = 'storage/karir/foto_karir/' . $filename;
        }

        if ($karir->save()) {
            return redirect()->back()->with('success', 'Lowongan berhasil diperbarui.');
        } else {
            return redirect()->back()->with('failed', 'Gagal memperbarui data.');
        }
    }

    public function destroy($id)
    {
        $karir = Karir::findOrFail($id);

        if ($karir->dokumen_syarat && file_exists(public_path($karir->dokumen_syarat))) {
            unlink(public_path($karir->dokumen_syarat));
        }

        if ($karir->foto && file_exists(public_path($karir->foto))) {
            unlink(public_path($karir->foto));
        }

        if ($karir->delete()) {
            return redirect()->back()->with('success', 'Lowongan berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus data.');
        }
    }
}
