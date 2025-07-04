<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Manfaat;

class ManfaatController extends Controller
{
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Manfaat | ' . getTitle();
        $dataview->page_title = 'Manfaat Koperasi';
        $dataview->data_admin = Auth::guard('admin')->user();

        $dataview->manfaat = Manfaat::orderBy('id_manfaat', 'DESC')->get();

        return view('pages/admin/manfaat', compact('dataview'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:5048',
        ]);

        $manfaat = new Manfaat();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('storage/manfaat');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $manfaat->img = 'storage/manfaat/' . $filename;
        }

        $manfaat->judul = $request->judul;
        $manfaat->deskripsi = $request->deskripsi;

        if ($manfaat->save()) {
            return redirect()->back()->with('success', 'Manfaat berhasil disimpan.');
        } else {
            return redirect()->back()->with('failed', 'Gagal menyimpan manfaat.');
        }
    }

    public function update(Request $request, $id_manfaat)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:5048',
        ]);

        $manfaat = Manfaat::find($id_manfaat);
        if (!$manfaat) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        if ($request->hasFile('img')) {
            if ($manfaat->img && file_exists(public_path($manfaat->img))) {
                unlink(public_path($manfaat->img));
            }

            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('storage/manfaat');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $manfaat->img = 'storage/manfaat/' . $filename;
        }

        $manfaat->judul = $request->judul;
        $manfaat->deskripsi = $request->deskripsi;

        if ($manfaat->save()) {
            return redirect()->back()->with('success', 'Manfaat berhasil diperbarui.');
        } else {
            return redirect()->back()->with('failed', 'Gagal memperbarui manfaat.');
        }
    }

    public function destroy($id_manfaat)
    {
        $manfaat = Manfaat::find($id_manfaat);
        if (!$manfaat) {
            return redirect()->back()->with('failed', 'Data tidak ditemukan.');
        }

        if ($manfaat->img && file_exists(public_path($manfaat->img))) {
            unlink(public_path($manfaat->img));
        }

        if ($manfaat->delete()) {
            return redirect()->back()->with('success', 'Manfaat berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus manfaat.');
        }
    }
}
