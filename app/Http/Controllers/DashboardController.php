<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Layanan;
use App\Models\Mitra;
use App\Models\Event;
use App\Models\Artikel;
use App\Models\VisiMisi;
use App\Models\Sejarah;
use App\Models\Karir;
use App\Models\Regulasi;
use App\Models\Faq;
use App\Models\Dokumentasi;
use App\Models\Kontak;
use App\Models\Contact;
use App\Models\Manfaat;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Dashboard | ' . getTitle();
        $dataview->data_admin = Auth::guard('admin')->user();

        $dataview->jum_slider = Slider::count();
        $dataview->jum_team = Team::count();
        $dataview->jum_layanan = Layanan::count();
        $dataview->jum_mitra = Mitra::count();
        $dataview->jum_event = Event::count();
        $dataview->jum_artikel = Artikel::count();
        $dataview->jum_visimisi = VisiMisi::count();
        $dataview->jum_sejarah = Sejarah::count();
        $dataview->jum_karir = Karir::count();
        $dataview->jum_regulasi = Regulasi::count();
        $dataview->jum_faq = Faq::count();
        $dataview->jum_dokumentasi = Dokumentasi::count();
        $dataview->jum_kontak = Kontak::count();
        $dataview->jum_pesan = Contact::count();
        $dataview->jum_manfaat = Manfaat::count();


        return view('pages/admin/dashboard', compact('dataview'));
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
        //
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
