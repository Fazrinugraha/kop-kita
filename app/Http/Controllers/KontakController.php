<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Kontak;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Kontak | '.getTitle();
        $dataview->page_title = 'Kontak';
        
        $kontak = Kontak::where('id_kontak', '1')->first();

        return view('pages/admin/kontak', compact('dataview', 'kontak'));
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
        //
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
            'nama_instansi' => 'required|string',
            'alamat' => 'required|string',
            'telpon' => 'required|string',
            'email' => 'required|email',
            'sosmed_facebook' => 'required|string',
            'sosmed_instagram' => 'required|string',
            'sosmed_youtube' => 'required|string',
            'website' => 'required|string',
            'link_google_map' => 'required|url', // Validasi untuk link google map
        ], [
            'nama_instansi.required' => 'Nama lembaga tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'telpon.required' => 'Telepon tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus berformat email yang valid',
            'sosmed_facebook.required' => 'Sosmed Facebook tidak boleh kosong',
            'sosmed_instagram.required' => 'Sosmed Instagram tidak boleh kosong',
            'sosmed_youtube.required' => 'Sosmed Youtube tidak boleh kosong',
            'website.required' => 'Website tidak boleh kosong',
            'link_google_map.required' => 'Link Google Maps tidak boleh kosong',
            'link_google_map.url' => 'Link Google Maps harus berupa URL yang valid',
        ]);
    
        $kontak = Kontak::find($id);
    
        if (!$kontak) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }
    
        // Update data
        $kontak->nama_instansi = $request->nama_instansi;
        $kontak->alamat = $request->alamat;
        $kontak->telpon = $request->telpon;
        $kontak->email = $request->email;
        $kontak->sosmed_facebook = $request->sosmed_facebook;
        $kontak->sosmed_instagram = $request->sosmed_instagram;
        $kontak->sosmed_youtube = $request->sosmed_youtube;
        $kontak->website = $request->website;
        $kontak->link_google_map = $request->link_google_map; // Tambahan untuk google map
    
        // Simpan data
        if ($kontak->save()) {
            return redirect()->back()->with('success', 'Data Berhasil diperbaharui.');
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
        //
    }
}