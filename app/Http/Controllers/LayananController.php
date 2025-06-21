<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Layanan;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Layanan | '.getTitle();
        $dataview->page_title = 'Layanan';
        $dataview->data_admin = Auth::guard('admin')->user();
        
        $dataview->layanan = Layanan::all();
        
        return view('pages/admin/layanan', compact('dataview'));
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
            'nama_layanan' => 'required|string',
            'deskripsi' => 'required|string',     
            'link_url' => 'nullable|url',
        ], [
            'nama_layanan.required' => 'Nama layanan tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'link_url.url' => 'URL tidak valid.',
        ]);

        $layanan = new Layanan();
        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->deskripsi = $request->deskripsi;
        $layanan->link_url = $request->link_url; // <-- Tambahan penting

        if ($layanan->save()) {
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
            'nama_layanan' => 'required|string',
            'deskripsi' => 'required|string',
            'link_url' => 'nullable|url',
        ], [
            'nama_layanan.required' => 'Nama layanan tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
             'link_url.url' => 'URL tidak valid.',
        ]);
    
        // Cari data berdasarkan ID
        $layanan = Layanan::find($id);
    
        if (!$layanan) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }
    
        // Update data lainnya
       $layanan->nama_layanan = $request->nama_layanan;
        $layanan->deskripsi = $request->deskripsi;
        $layanan->link_url = $request->link_url; // <-- Tambahan penting

    
        // Simpan data
        if ($layanan->save()) {
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
        $layanan = Layanan::find($id);

        if (!$layanan) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Hapus data dari database
        if ($layanan->delete()) {
            return redirect()->back()->with('success', 'Berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal dihapus.');
        }
    }
}
