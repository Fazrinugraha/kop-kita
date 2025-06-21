<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisiMisi;

class VisiMisiController extends Controller
{
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->page_title = 'Manajemen Visi & Misi';

        $visiMisis = VisiMisi::all();
        return view('pages.admin.visi_misi', compact('visiMisis', 'dataview'));
    }

    public function create()
    {
        return view('pages.admin.visi_misi_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Visi,Misi',
            'isi' => 'required|string',
            'urutan' => 'nullable|integer',
        ]);

        VisiMisi::create($request->all());

        return redirect()->route('visi_misi.index')->with('success', 'Visi Misi berhasil ditambahkan.');
    }

    // Dalam metode edit
    public function edit($id)
    {
        $dataview = new \stdClass();
        $dataview->page_title = 'Edit Visi & Misi';

        $visiMisi = VisiMisi::findOrFail($id);
        return view('pages.admin.visi_misi', compact('visiMisi', 'dataview'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|in:Visi,Misi',
            'isi' => 'required|string',
            'urutan' => 'nullable|integer',
        ]);

        $visiMisi = VisiMisi::findOrFail($id);
        $visiMisi->update($request->all());

        return redirect()->route('visi_misi.index')->with('success', 'Visi Misi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $visiMisi = VisiMisi::findOrFail($id);
        $visiMisi->delete();

        return redirect()->route('visi_misi.index')->with('success', 'Visi Misi berhasil dihapus.');
    }
}
