<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Slider | '.getTitle();
        $dataview->page_title = 'Slider';
        $dataview->data_admin = Auth::guard('admin')->user();
        
        $dataview->slider = Slider::orderBy('id_slider', 'DESC')->get();
        
        return view('pages/admin/slider', compact('dataview'));
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
        ], [
            'file_gambar.required' => 'File gambar wajib diunggah.',
            'file_gambar.image' => 'File harus berupa gambar.',
            'file_gambar.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $slider = new Slider();
        
        if ($request->hasFile('file_gambar')) {
            // Dapatkan file dari request
            $file = $request->file('file_gambar');
    
            // Tentukan nama file unik
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Tentukan lokasi penyimpanan
            $destinationPath = public_path('storage/slider');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $filename);
    
            // Simpan nama file ke database
            $slider->file_gambar = 'storage/slider/' . $filename;
        }
        
        $slider->link = $request->link;
        $slider->status_aktif = $request->status_aktif;
        
        if($slider->save()){
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
            'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar opsional
        ], [
            'file_gambar.image' => 'File harus berupa gambar.',
            'file_gambar.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);
    
        // Cari slider berdasarkan ID
        $slider = Slider::find($id);
    
        if (!$slider) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }
    
        // Proses file gambar (jika ada)
        if ($request->hasFile('file_gambar')) {
            // Hapus file lama jika ada
            if ($slider->file_gambar && file_exists(public_path($slider->file_gambar))) {
                unlink(public_path($slider->file_gambar));
            }
            
    
            // Simpan file baru
            $file = $request->file('file_gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/slider');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            $file->move($destinationPath, $filename);
    
            // Update path file gambar di database
            $slider->file_gambar = 'storage/slider/' . $filename;
        }
    
        // Update data lainnya
        $slider->link = $request->link;
        $slider->status_aktif = $request->status_aktif;
    
        // Simpan data
        if ($slider->save()) {
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
        $slider = Slider::find($id);

        if (!$slider) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Proses hapus file gambar jika ada
        $filePath = public_path($slider->file_gambar); // Path lengkap file
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file
        }

        // Hapus data dari database
        if ($slider->delete()) {
            return redirect()->back()->with('success', 'Berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal dihapus.');
        }
    }
}
