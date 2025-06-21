<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Event | '.getTitle();
        $dataview->page_title = 'Event';
        $dataview->data_admin = Auth::guard('admin')->user();
        
        $dataview->event = Event::all();
        
        return view('pages/admin/event', compact('dataview'));
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
            'bidang_kegiatan' => 'required|string',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
        ], [
            'file_gambar.required' => 'File gambar wajib diunggah.',
            'file_gambar.image' => 'File harus berupa gambar.',
            'file_gambar.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date' => 'Tanggal harus dalam format yang valid.',
            'nama_kegiatan.required' => 'Nama kegiatan tidak boleh kosong',
            'bidang_kegiatan.required' => 'Bidang kegiatan tidak boleh kosong',
            'lokasi.required' => 'Telepon tidak boleh kosong',
            'deskripsi.required' => 'Sosmed Facebook tidak boleh kosong',
        ]);

        $event = new Event();

        if ($request->hasFile('file_gambar')) {
            // Dapatkan file dari request
            $file = $request->file('file_gambar');
    
            // Tentukan nama file unik
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Tentukan lokasi penyimpanan
            $destinationPath = public_path('storage/event');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $filename);
    
            // Simpan nama file ke database
            $event->file_gambar = 'storage/event/' . $filename;
        }

        $event->tanggal = $request->tanggal;
        $event->nama_kegiatan = $request->nama_kegiatan;
        $event->bidang_kegiatan = $request->bidang_kegiatan;
        $event->lokasi = $request->lokasi;
        $event->link = $request->link;
        $event->nama_link = $request->nama_link;
        $event->deskripsi = $request->deskripsi;
        
        if($event->save()){
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
            'bidang_kegiatan' => 'required|string',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
        ], [
            'file_gambar.required' => 'File gambar wajib diunggah.',
            'file_gambar.image' => 'File harus berupa gambar.',
            'file_gambar.mimes' => 'Format gambar harus: jpeg, jpg, atau png.',
            'file_gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date' => 'Tanggal harus dalam format yang valid.',
            'nama_kegiatan.required' => 'Nama kegiatan tidak boleh kosong',
            'bidang_kegiatan.required' => 'Bidang kegiatan tidak boleh kosong',
            'lokasi.required' => 'Telepon tidak boleh kosong',
            'deskripsi.required' => 'Sosmed Facebook tidak boleh kosong',
        ]);
    
        // Cari data berdasarkan ID
        $event = Event::find($id);
    
        if (!$event) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Proses file gambar (jika ada)
        if ($request->hasFile('file_gambar')) {
            // Hapus file lama jika ada
            if ($event->file_gambar && file_exists(public_path($event->file_gambar))) {
                unlink(public_path($event->file_gambar));
            }
            
    
            // Simpan file baru
            $file = $request->file('file_gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/event');
    
            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            $file->move($destinationPath, $filename);
    
            // Update path file gambar di database
            $event->file_gambar = 'storage/event/' . $filename;
        }
    
        // Update data lainnya
        $event->tanggal = $request->tanggal;
        $event->nama_kegiatan = $request->nama_kegiatan;
        $event->bidang_kegiatan = $request->bidang_kegiatan;
        $event->lokasi = $request->lokasi;
        $event->link = $request->link;
        $event->nama_link = $request->nama_link;
        $event->deskripsi = $request->deskripsi;
    
        // Simpan data
        if ($event->save()) {
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
        $event = Event::find($id);

        if (!$event) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Proses hapus file gambar jika ada
        $filePath = public_path($event->file_gambar); // Path lengkap file
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file
        }

        // Hapus data dari database
        if ($event->delete()) {
            return redirect()->back()->with('success', 'Berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal dihapus.');
        }
    }
}
