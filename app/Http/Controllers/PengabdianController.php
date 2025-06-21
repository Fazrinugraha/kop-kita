<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Pengabdian;

class PengabdianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Pengabdian | '.getTitle();
        $dataview->page_title = 'Pengabdian';
        $dataview->data_admin = Auth::guard('admin')->user();
        
        $dataview->pengabdian = Pengabdian::get()->map(function ($item) {
            $item->preview = Str::words($item->deskripsi, 20, '...'); // Ambil 20 kata pertama
            return $item;
        });
        
        return view('pages/admin/pengabdian', compact('dataview'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'bulan' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
        ], [
            'file_gambar.required' => 'File gambar wajib diunggah.',
            'file_gambar.image' => 'File harus berupa gambar.',
            'file_gambar.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'nama_kegiatan.required' => 'Nama kegiatan tidak boleh kosong',
            'lokasi.required' => 'Lokasi tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
        ]);

        $pengabdian = new Pengabdian();

        if ($request->hasFile('file_gambar')) {
            // Dapatkan file dari request
            $file = $request->file('file_gambar');
    
            // Tentukan nama file unik
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Tentukan lokasi penyimpanan
            $destinationPath = public_path('storage/pengabdian');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $filename);
    
            // Simpan nama file ke database
            $pengabdian->file_gambar = 'storage/pengabdian/' . $filename;
        }

        $pengabdian->bulan = $request->bulan;
        $pengabdian->nama_kegiatan = $request->nama_kegiatan;
        $pengabdian->lokasi = $request->lokasi;
        $pengabdian->deskripsi = $request->deskripsi;
        
        if($pengabdian->save()){
            return redirect()->back()->with('success', 'Berhasil disimpan.');
        } else {
            return redirect()->back()->with('failed', 'Gagal disimpan.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bulan' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
        ], [
            'file_gambar.required' => 'File gambar wajib diunggah.',
            'file_gambar.image' => 'File harus berupa gambar.',
            'file_gambar.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'nama_kegiatan.required' => 'Nama kegiatan tidak boleh kosong',
            'lokasi.required' => 'Lokasi tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
        ]);
    
        // Cari data berdasarkan ID
        $pengabdian = Pengabdian::find($id);
    
        if (!$pengabdian) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Proses file gambar (jika ada)
        if ($request->hasFile('file_gambar')) {
            // Hapus file lama jika ada
            if ($pengabdian->file_gambar && file_exists(public_path($pengabdian->file_gambar))) {
                unlink(public_path($pengabdian->file_gambar));
            }
            
    
            // Simpan file baru
            $file = $request->file('file_gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/pengabdian');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            $file->move($destinationPath, $filename);
    
            // Update path file gambar di database
            $pengabdian->file_gambar = 'storage/pengabdian/' . $filename;
        }
    
        // Update data lainnya
        $pengabdian->bulan = $request->bulan;
        $pengabdian->nama_kegiatan = $request->nama_kegiatan;
        $pengabdian->lokasi = $request->lokasi;
        $pengabdian->deskripsi = $request->deskripsi;
    
        // Simpan data
        if ($pengabdian->save()) {
            return redirect()->back()->with('success', 'Berhasil diperbaharui.');
        } else {
            return redirect()->back()->with('failed', 'Gagal diperbaharui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengabdian = Pengabdian::find($id);

        if (!$pengabdian) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Proses hapus file gambar jika ada
        $filePath = public_path($pengabdian->file_gambar); // Path lengkap file
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file
        }

        // Hapus data dari database
        if ($pengabdian->delete()) {
            return redirect()->back()->with('success', 'Berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal dihapus.');
        }
    }
}
