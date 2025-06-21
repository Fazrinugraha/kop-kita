<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Kegiatan;
use App\Models\Jasa;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Kegiatan | '.getTitle();
        $dataview->page_title = 'Kegiatan';
        $dataview->data_admin = Auth::guard('admin')->user();
        
        $dataview->jasa = Jasa::all();

        // $dataview->kegiatan = Kegiatan::join('jasa')->get()->map(function ($item) {
        $dataview->kegiatan = Kegiatan::join('jasa', 'kegiatan.id_jasa', '=', 'jasa.id_jasa')->get()->map(function ($item) {
            $item->preview = Str::words($item->keterangan, 20, '...'); // Ambil 20 kata pertama
            return $item;
        });
        
        return view('pages/admin/kegiatan', compact('dataview'));
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
            'nama_kegiatan' => 'required|string',
            'keterangan' => 'required|string',
        ], [
            'file_gambar.required' => 'File gambar wajib diunggah.',
            'file_gambar.image' => 'File harus berupa gambar.',
            'file_gambar.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date' => 'Tanggal harus dalam format yang valid.',
            'nama_kegiatan.required' => 'Nama Kegiatan tidak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
        ]);

        $kegiatan = new Kegiatan();
        
        if ($request->hasFile('file_gambar')) {
            // Dapatkan file dari request
            $file = $request->file('file_gambar');
    
            // Tentukan nama file unik
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Tentukan lokasi penyimpanan
            $destinationPath = public_path('storage/kegiatan');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $filename);
    
            // Simpan nama file ke database
            $kegiatan->file_gambar = 'storage/kegiatan/' . $filename;
        }
        
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->id_jasa = $request->id_jasa;
        $kegiatan->tanggal = $request->tanggal;
        $kegiatan->keterangan = $request->keterangan;
        
        if($kegiatan->save()){
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
            'nama_kegiatan' => 'required|string',
            'keterangan' => 'required|string',
        ], [
            'file_gambar.required' => 'File gambar wajib diunggah.',
            'file_gambar.image' => 'File harus berupa gambar.',
            'file_gambar.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date' => 'Tanggal harus dalam format yang valid.',
            'nama_kegiatan.required' => 'Nama Kegiatan tidak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
        ]);
    
        // Cari data berdasarkan ID
        $kegiatan = Kegiatan::find($id);
    
        if (!$kegiatan) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }
    
        // Proses file gambar (jika ada)
        if ($request->hasFile('file_gambar')) {
            // Hapus file lama jika ada
            if ($kegiatan->file_gambar && file_exists(public_path($kegiatan->file_gambar))) {
                unlink(public_path($kegiatan->file_gambar));
            }
            
    
            // Simpan file baru
            $file = $request->file('file_gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/kegiatan');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            $file->move($destinationPath, $filename);
    
            // Update path file gambar di database
            $kegiatan->file_gambar = 'storage/kegiatan/' . $filename;
        }
    
        // Update data lainnya
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->id_jasa = $request->id_jasa;
        $kegiatan->tanggal = $request->tanggal;
        $kegiatan->keterangan = $request->keterangan;
    
        // Simpan data
        if ($kegiatan->save()) {
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
        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Proses hapus file gambar jika ada
        $filePath = public_path($kegiatan->file_gambar); // Path lengkap file
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file
        }

        // Hapus data dari database
        if ($kegiatan->delete()) {
            return redirect()->back()->with('success', 'Berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal dihapus.');
        }
    }
}
