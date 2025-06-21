<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Artikel | '.getTitle();
        $dataview->page_title = 'Artikel';
        $dataview->data_admin = Auth::guard('admin')->user();
        
        $dataview->artikel = Artikel::orderBy('tanggal', 'DESC')->get()->map(function ($item) {
            $item->preview = Str::words($item->isi, 30, '...'); // Ambil 20 kata pertama
            return $item;
        });
        
        return view('pages/admin/artikel', compact('dataview'));
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
            'tanggal' => 'required|date',
            'judul' => 'required|string',
            'isi' => 'required|string',
            'editor' => 'required|string',
        ], [
            'file_gambar.required' => 'File gambar wajib diunggah.',
            'file_gambar.image' => 'File harus berupa gambar.',
            'file_gambar.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date' => 'Tanggal harus dalam format yang valid.',
            'judul.required' => 'Judul tidak boleh kosong',
            'isi.required' => 'Isi tidak boleh kosong',
            'editor.required' => 'Editor tidak boleh kosong',
        ]);

        $artikel = new Artikel();
        
        if ($request->hasFile('file_gambar')) {
            // Dapatkan file dari request
            $file = $request->file('file_gambar');
    
            // Tentukan nama file unik
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Tentukan lokasi penyimpanan
            $destinationPath = public_path('storage/artikel');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $filename);
    
            // Simpan nama file ke database
            $artikel->file_gambar = 'storage/artikel/' . $filename;
        }
        
        $artikel->judul = $request->judul;
        $artikel->tanggal = $request->tanggal;
        $artikel->ket_gambar = $request->ket_gambar;
        $artikel->isi = $request->isi;
        $artikel->sumber = $request->sumber;
        $artikel->editor = $request->editor;
        
        if($artikel->save()){
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
            'tanggal' => 'required|date',
            'judul' => 'required|string',
            'isi' => 'required|string',
            'editor' => 'required|string',
        ], [
            'file_gambar.required' => 'File gambar wajib diunggah.',
            'file_gambar.image' => 'File harus berupa gambar.',
            'file_gambar.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date' => 'Tanggal harus dalam format yang valid.',
            'judul.required' => 'Judul tidak boleh kosong',
            'isi.required' => 'Isi tidak boleh kosong',
            'editor.required' => 'Editor tidak boleh kosong',
        ]);
    
        // Cari data berdasarkan ID
        $artikel = Artikel::find($id);
    
        if (!$artikel) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }
    
        // Proses file gambar (jika ada)
        if ($request->hasFile('file_gambar')) {
            // Hapus file lama jika ada
            if ($artikel->file_gambar && file_exists(public_path($artikel->file_gambar))) {
                unlink(public_path($artikel->file_gambar));
            }
            
    
            // Simpan file baru
            $file = $request->file('file_gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/artikel');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            $file->move($destinationPath, $filename);
    
            // Update path file gambar di database
            $artikel->file_gambar = 'storage/artikel/' . $filename;
        }
    
        // Update data lainnya
        $artikel->judul = $request->judul;
        $artikel->tanggal = $request->tanggal;
        $artikel->ket_gambar = $request->ket_gambar;
        $artikel->isi = $request->isi;
        $artikel->sumber = $request->sumber;
        $artikel->editor = $request->editor;
    
        // Simpan data
        if ($artikel->save()) {
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
        $artikel = Artikel::find($id);

        if (!$artikel) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Proses hapus file gambar jika ada
        $filePath = public_path($artikel->file_gambar); // Path lengkap file
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file
        }

        // Hapus data dari database
        if ($artikel->delete()) {
            return redirect()->back()->with('success', 'Berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal dihapus.');
        }
    }
}
