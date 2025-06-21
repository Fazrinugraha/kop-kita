<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Jasa;

class JasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Jasa | '.getTitle();
        $dataview->page_title = 'Jasa';
        $dataview->data_admin = Auth::guard('admin')->user();
        
        $dataview->jasa = Jasa::all();
        
        return view('pages/admin/jasa', compact('dataview'));
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
            'nama_jasa' => 'required|string',
        ], [
            'nama_jasa.required' => 'Nama jasa tidak boleh kosong',
        ]);

        $jasa = new Jasa();

        $jasa->nama_jasa = $request->nama_jasa;
        
        if($jasa->save()){
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
            'nama_jasa' => 'required|string',
        ], [
            'nama_jasa.required' => 'Nama jasa tidak boleh kosong',
        ]);
    
        // Cari data berdasarkan ID
        $jasa = Jasa::find($id);
    
        if (!$jasa) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }
    
        // Update data lainnya
        $jasa->nama_jasa = $request->nama_jasa;
    
        // Simpan data
        if ($jasa->save()) {
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
        $jasa = Jasa::find($id);

        if (!$jasa) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        // Hapus data dari database
        if ($jasa->delete()) {
            return redirect()->back()->with('success', 'Berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal dihapus.');
        }
    }
}
