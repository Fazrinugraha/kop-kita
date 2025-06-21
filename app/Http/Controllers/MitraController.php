<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Mitra;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Mitra | '.getTitle();
        $dataview->page_title = 'Mitra';
        $dataview->data_admin = Auth::guard('admin')->user();
        
        $dataview->mitra = Mitra::all();
        
        return view('pages/admin/mitra', compact('dataview'));
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
            'file_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string',
        ], [
            'file_logo.required' => 'File logo wajib diunggah.',
            'file_logo.image' => 'File harus berupa gambar.',
            'file_logo.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_logo.max' => 'Ukuran gambar maksimal 2MB.',
            'nama.required' => 'Nama tidak boleh kosong',
        ]);

        $mitra = new Mitra();
        
        if ($request->hasFile('file_logo')) {
            // Dapatkan file dari request
            $file = $request->file('file_logo');
    
            // Tentukan nama file unik
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Tentukan lokasi penyimpanan
            $destinationPath = public_path('storage/mitra');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $filename);
    
            // Simpan nama file ke database
            $mitra->file_logo = 'storage/mitra/' . $filename;
        }
        
        $mitra->nama = $request->nama;
        $mitra->status_aktif = $request->status_aktif;
        
        if($mitra->save()){
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
            'file_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar opsional
            'nama' => 'required|string',
        ], [
            'file_logo.image' => 'File harus berupa gambar.',
            'file_logo.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_logo.max' => 'Ukuran gambar maksimal 2MB.',
            'nama.required' => 'Nama tidak boleh kosong',
        ]);
    
        // Cari data berdasarkan ID
        $mitra = Mitra::find($id);
    
        if (!$mitra) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }
    
        // Proses file gambar (jika ada)
        if ($request->hasFile('file_logo')) {
            // Hapus file lama jika ada
            if ($mitra->file_logo && file_exists(public_path($mitra->file_logo))) {
                unlink(public_path($mitra->file_logo));
            }
            
    
            // Simpan file baru
            $file = $request->file('file_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/mitra');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            $file->move($destinationPath, $filename);
    
            // Update path file gambar di database
            $mitra->file_logo = 'storage/mitra/' . $filename;
        }
    
        // Update data lainnya
        $mitra->nama = $request->nama;
        $mitra->status_aktif = $request->status_aktif;
    
        // Simpan data
        if ($mitra->save()) {
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
        $mitra = Mitra::find($id);

        if (!$mitra) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Proses hapus file gambar jika ada
        $filePath = public_path($mitra->file_logo); // Path lengkap file
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file
        }

        // Hapus data dari database
        if ($mitra->delete()) {
            return redirect()->back()->with('success', 'Berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal dihapus.');
        }
    }
}
