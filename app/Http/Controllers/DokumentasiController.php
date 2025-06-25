<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokumentasi;
use App\Models\DokumentasiMedia;

class DokumentasiController extends Controller
{
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Dokumentasi | ' . getTitle();
        $dataview->page_title = 'Dokumentasi';
        $dataview->data_admin = Auth::guard('admin')->user();
        $dataview->dokumentasi = Dokumentasi::with('media')->orderBy('id', 'DESC')->get();

        return view('pages/admin/dokumentasi', compact('dataview'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'media_file' => 'required',
            'media_file.*' => 'file|mimes:jpg,jpeg,png,mp4|max:30120',
        ]);

        $dokumentasi = Dokumentasi::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('media_file')) {
            foreach ($request->file('media_file') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = 'storage/dokumentasi';
                $file->move(public_path($path), $filename);

                $jenis = in_array(strtolower($file->getClientOriginalExtension()), ['jpg', 'jpeg', 'png']) ? 'foto' : 'video';

                DokumentasiMedia::create([
                    'dokumentasi_id' => $dokumentasi->id,
                    'jenis_media' => $jenis,
                    'media_path' => $path . '/' . $filename,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Dokumentasi berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'media_file.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:30120',
        ]);

        $dokumentasi = Dokumentasi::find($id);
        if (!$dokumentasi) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        $dokumentasi->update([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('media_file')) {
            foreach ($request->file('media_file') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destination = public_path('storage/dokumentasi');

                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                $file->move($destination, $filename);

                $ext = strtolower($file->getClientOriginalExtension());
                $jenis = in_array($ext, ['jpg', 'jpeg', 'png']) ? 'foto' : 'video';

                DokumentasiMedia::create([
                    'dokumentasi_id' => $dokumentasi->id,
                    'jenis_media' => $jenis,
                    'media_path' => 'storage/dokumentasi/' . $filename,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Dokumentasi berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $dokumentasi = Dokumentasi::find($id);
        if (!$dokumentasi) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        foreach ($dokumentasi->media as $media) {
            if (file_exists(public_path($media->media_path))) {
                unlink(public_path($media->media_path));
            }
            $media->delete();
        }

        $dokumentasi->delete();
        return redirect()->back()->with('success', 'Dokumentasi berhasil dihapus.');
    }

    public function destroyMedia($id)
    {
        $media = DokumentasiMedia::find($id);
        if (!$media) {
            return redirect()->back()->with('failed', 'Media tidak ditemukan.');
        }

        if (file_exists(public_path($media->media_path))) {
            unlink(public_path($media->media_path));
        }

        $media->delete();
        return redirect()->back()->with('success', 'Media berhasil dihapus.');
    }
}
