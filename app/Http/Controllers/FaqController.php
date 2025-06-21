<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the FAQ.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'FAQ | ' . getTitle();
        $dataview->page_title = 'Frequently Asked Questions';

        // Mengambil semua FAQ yang statusnya 'active'
        $dataview->faq = Faq::where('status', 'active')->get();

        return view('pages/admin/faq', compact('dataview'));
    }

    /**
     * Show the form for creating a new FAQ.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/admin/create_faq');
    }

    /**
     * Store a newly created FAQ in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            // 'status' => 'required|in:active,inactive', // Tambahkan validasi untuk status
        ], [
            'question.required' => 'Pertanyaan tidak boleh kosong',
            'answer.required' => 'Jawaban tidak boleh kosong',
            // 'status.required' => 'Status tidak boleh kosong', // Pesan error untuk status
            // 'status.in' => 'Status tidak valid', // Pesan error jika status tidak sesuai
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        // $faq->status = $request->status; // Simpan status

        if ($faq->save()) {
            return redirect()->back()->with('success', 'FAQ berhasil disimpan.');
        } else {
            return redirect()->back()->with('failed', 'FAQ gagal disimpan.');
        }
    }

    /**
     * Show the form for editing the specified FAQ.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::find($id);
        if (!$faq) {
            return redirect()->back()->with('failed', 'FAQ tidak ditemukan.');
        }

        return view('pages/admin/edit_faq', compact('faq'));
    }

    /**
     * Update the specified FAQ in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            // 'status' => 'required|in:active,inactive',
        ], [
            'question.required' => 'Pertanyaan tidak boleh kosong',
            'answer.required' => 'Jawaban tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            // 'status.in' => 'Status tidak valid',
        ]);

        $faq = Faq::find($id);
        if (!$faq) {
            return redirect()->back()->with('failed', 'FAQ tidak ditemukan.');
        }

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        // $faq->status = $request->status; // Update the status

        if ($faq->save()) {
            return redirect()->back()->with('success', 'FAQ berhasil diperbaharui.');
        } else {
            return redirect()->back()->with('failed', 'FAQ gagal diperbaharui.');
        }
    }

    /**
     * Remove the specified FAQ from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return redirect()->back()->with('failed', 'FAQ tidak ditemukan.');
        }

        // if ($faq->status == 'inactive') {
        //     return redirect()->back()->with('failed', 'FAQ yang berstatus inactive tidak dapat dihapus.');
        // }

        if ($faq->delete()) {
            return redirect()->back()->with('success', 'FAQ berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'FAQ gagal dihapus.');
        }
    }
}
