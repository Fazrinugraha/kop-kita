<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Portofolio;
use App\Models\Jasa;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Portofolio | '.getTitle();
        $dataview->page_title = 'Portofolio';
        $dataview->data_admin = Auth::guard('admin')->user();
        
        $dataview->jasa = Jasa::all();
        $dataview->portofolio = Portofolio::join('jasa', 'portofolio.id_jasa', '=', 'jasa.id_jasa')->orderBy('portofolio.created_at', 'DESC')->get();
        
        return view('pages/admin/portofolio', compact('dataview'));
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
            'file_icon' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'file_icon.required' => 'File icon wajib diunggah.',
            'file_icon.image' => 'File harus berupa gambar.',
            'file_icon.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_icon.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $portofolio = new Portofolio();
        
        if ($request->hasFile('file_icon')) {
            // Dapatkan file dari request
            $file = $request->file('file_icon');
    
            // Tentukan nama file unik
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Tentukan lokasi penyimpanan
            $destinationPath = public_path('storage/portofolio');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $filename);
    
            // Simpan nama file ke database
            $portofolio->file_icon = 'storage/portofolio/' . $filename;
        }
        
        $portofolio->nama_produk = $request->nama_produk;
        $portofolio->id_jasa = $request->id_jasa;
        $portofolio->link = $request->link;
        $portofolio->deskripsi = $request->deskripsi;
        $portofolio->kategori = $request->kategori;
        
        if($portofolio->save()){
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
            'file_icon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar opsional
        ], [
            'file_icon.image' => 'File harus berupa gambar.',
            'file_icon.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_icon.max' => 'Ukuran gambar maksimal 2MB.',
        ]);
    
        // Cari data berdasarkan ID
        $portofolio = Portofolio::find($id);
    
        if (!$portofolio) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }
    
        // Proses file gambar (jika ada)
        if ($request->hasFile('file_icon')) {
            // Hapus file lama jika ada
            if ($portofolio->file_icon && file_exists(public_path($portofolio->file_icon))) {
                unlink(public_path($portofolio->file_icon));
            }
            
    
            // Simpan file baru
            $file = $request->file('file_icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/portofolio');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            $file->move($destinationPath, $filename);
    
            // Update path file gambar di database
            $portofolio->file_icon = 'storage/portofolio/' . $filename;
        }
    
        // Update data lainnya
        $portofolio->nama_produk = $request->nama_produk;
        $portofolio->id_jasa = $request->id_jasa;
        $portofolio->link = $request->link;
        $portofolio->deskripsi = $request->deskripsi;
        $portofolio->kategori = $request->kategori;
    
        // Simpan data
        if ($portofolio->save()) {
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
        $portofolio = Portofolio::find($id);

        if (!$portofolio) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Proses hapus file gambar jika ada
        $filePath = public_path($portofolio->file_icon); // Path lengkap file
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file
        }

        // Hapus data dari database
        if ($portofolio->delete()) {
            return redirect()->back()->with('success', 'Berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal dihapus.');
        }
    }
}
