<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Team | '.getTitle();
        $dataview->page_title = 'Team';
        $dataview->data_admin = Auth::guard('admin')->user();
        
        $dataview->team = Team::all();
        
        return view('pages/admin/team', compact('dataview'));
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
            'file_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string',
            'bidang' => 'required|string',
            'tentang_saya' => 'nullable|string',
        ], [
            'file_foto.required' => 'File foto wajib diunggah.',
            'file_foto.image' => 'File harus berupa gambar.',
            'file_foto.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_foto.max' => 'Ukuran gambar maksimal 2MB.',
            'nama.required' => 'Nama tidak boleh kosong',
            'bidang.required' => 'Nama tidak boleh kosong',
        ]);

        $team = new Team();
        
        if ($request->hasFile('file_foto')) {
            // Dapatkan file dari request
            $file = $request->file('file_foto');
    
            // Tentukan nama file unik
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Tentukan lokasi penyimpanan
            $destinationPath = public_path('storage/team');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $filename);
    
            // Simpan nama file ke database
            $team->file_foto = 'storage/team/' . $filename;
        }
        
        $team->nama = $request->nama;
        $team->bidang = $request->bidang;
        $team->status_aktif = $request->status_aktif;
        $team->tentang_saya = $request->tentang_saya;
        
        if($team->save()){
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
            'file_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar opsional
            'nama' => 'required|string',
            'bidang' => 'required|string',
             'tentang_saya' => 'nullable|string',
        ], [
            'file_foto.image' => 'File harus berupa gambar.',
            'file_foto.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_foto.max' => 'Ukuran gambar maksimal 2MB.',
            'nama.required' => 'Nama tidak boleh kosong',
            'bidang.required' => 'Bidang tidak boleh kosong',
        ]);
    
        // Cari data berdasarkan ID
        $team = Team::find($id);
    
        if (!$team) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }
    
        // Proses file gambar (jika ada)
        if ($request->hasFile('file_foto')) {
            // Hapus file lama jika ada
            if ($team->file_foto && file_exists(public_path($team->file_foto))) {
                unlink(public_path($team->file_foto));
            }
            
    
            // Simpan file baru
            $file = $request->file('file_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/team');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            $file->move($destinationPath, $filename);
    
            // Update path file gambar di database
            $team->file_foto = 'storage/team/' . $filename;
        }
    
        // Update data lainnya
        $team->nama = $request->nama;
        $team->bidang = $request->bidang;
        $team->status_aktif = $request->status_aktif;
        $team->tentang_saya = $request->tentang_saya;

    
        // Simpan data
        if ($team->save()) {
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
        $team = Team::find($id);

        if (!$team) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Proses hapus file gambar jika ada
        $filePath = public_path($team->file_foto); // Path lengkap file
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file
        }

        // Hapus data dari database
        if ($team->delete()) {
            return redirect()->back()->with('success', 'Berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal dihapus.');
        }
    }
}
