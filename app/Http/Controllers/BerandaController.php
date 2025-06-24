<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Slider;
use App\Models\Tentang;
use App\Models\Layanan;
use App\Models\Team;
use App\Models\Mitra;
use App\Models\Artikel;
use App\Models\Event;
use App\Models\Portofolio;
use App\Models\Kegiatan;
use App\Models\Pengabdian;
use App\Models\Sejarah;
use App\Models\VisiMisi;
use App\Models\Regulasi;
use App\Models\Manfaat;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = getTitle();

        $dataview->slider = Slider::where('status_aktif', 'Y')->orderBy('id_slider', 'DESC')->limit(3)->get();
        $dataview->tentang = Tentang::where('prefix', 'tentang')->first();
        $dataview->layanan = Layanan::all();
        $dataview->team = Team::where('status_aktif', 'Y')->get();
        $dataview->mitra = Mitra::all();
        $dataview->artikel_terbaru = Artikel::limit(3)->orderBy('tanggal', 'DESC')->get();
        $dataview->event_terkini = Event::first();
        $dataview->portofolio = Portofolio::join('profil_kop_jasa', 'profil_kop_jasa.id_jasa', '=', 'profil_kop_portofolio.id_jasa')->orderBy('profil_kop_portofolio.created_at', 'DESC')->limit(8)->get();
        $dataview->regulasi = Regulasi::all();
        $dataview->manfaat = Manfaat::orderBy('id_manfaat', 'DESC')->get();

        return view('pages/front/beranda', compact('dataview'));
    }

    public function faq()
    {
        $dataview = new \stdClass();
        $dataview->title = 'FAQ | ' . getTitle();
        $dataview->page_title = 'Frequently Asked Questions';

        // Fetch all active FAQs
        $dataview->faq = \App\Models\Faq::where('status', 'active')->get();

        return view('pages/front/faq', compact('dataview'));
    }

    public function manfaat()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Manfaat | ' . getTitle();
        $dataview->page_title = 'Manfaat Koperasi';

        // Fetch all manfaat data
        $dataview->manfaat = \App\Models\Manfaat::orderBy('id_manfaat', 'DESC')->get();

        return view('pages/front/manfaat', compact('dataview'));
    }

    public function regulasi()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Regulasi ' . getTitle();

        // Get all regulations ordered by latest first
        $dataview->regulasi = Regulasi::orderBy('created_at', 'DESC')->get();

        // Include other necessary data for layout
        $dataview->layanan = Layanan::all();


        return view('pages/front/regulasi', compact('dataview'));
    }
    public function downloadRegulasi($id)
    {
        $regulasi = Regulasi::findOrFail($id);

        if (!file_exists(public_path($regulasi->file_dokumen))) {
            abort(404);
        }

        // Optional: Track downloads
        // $regulasi->increment('download_count');

        return response()->file(public_path($regulasi->file_dokumen));
    }
    public function tentang()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Tentang ' . getTitle();

        $dataview->tentang = Tentang::where('prefix', 'tentang')->first();
        $dataview->team = Team::where('status_aktif', 'Y')->get();
        // layanan
        $dataview->layanan = Layanan::all();

        // Fetch sejarah data ordered by tahun ascending
        $dataview->sejarahs = \App\Models\Sejarah::orderBy('tahun', 'asc')->get();

        return view('pages/front/sejarah', compact('dataview'));
    }



    public function team()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Team | ' . getTitle();

        // Ambil semua anggota tim yang status_aktif = 'Y'
        $dataview->team = Team::where('status_aktif', 'Y')->get();

        // Jika di layout/header kamu butuh data layanan atau data tentang:
        $dataview->layanan = Layanan::all();
        $dataview->tentang = Tentang::where('prefix', 'tentang')->first();

        return view('pages/front/team', compact('dataview'));
    }


    public function visiMisi()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Visi & Misi ' . getTitle();

        // Ambil data Visi & Misi, misalnya menggunakan model Tentang dengan prefix 'visi-misi'
        $dataview->visiMisi = Tentang::where('prefix', 'visi-misi')->first();

        // Jika ada data tambahan yang ingin di-include, misal layanan, team, dll
        $dataview->layanan = Layanan::all();
        $dataview->team = Team::where('status_aktif', 'Y')->get();

        // Render view blade untuk halaman visi misi
        return view('pages/front/visi_misi', compact('dataview'));
    }


    public function kontak()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Kontak ' . getTitle();
        $dataview->tentang = Tentang::where('prefix', 'tentang')->first();
        return view('pages/front/kontak', compact('dataview'));
    }

    public function event()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Event ' . getTitle();
        $dataview->event = Event::all();
        return view('pages/front/event', compact('dataview'));
    }

    public function event_detail($id)
    {

        $dataview = new \stdClass();

        $event = Event::find($id);
        // Jika konten tidak ditemukan, arahkan ke halaman 404
        if (!$event) {
            abort(404);
        }

        // Cek apakah konten sudah pernah dilihat di sesi ini
        $viewedEvents = session()->get('viewed_events', []);

        if (!in_array($id, $viewedEvents)) {
            // Tambahkan ID ke session
            session()->push('viewed_events', $id);

            // Tambahkan jumlah view di konten
            $event->view += 1;
            $event->save();
        }


        $dataview->title = 'Event | ' . $event->nama_kegiatan;
        $dataview->event = $event;
        // layanan
        $dataview->layanan = Layanan::all();
        return view('pages/front/detail_event', compact('dataview'));
    }

    public function portofolio()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Portofolio ' . getTitle();
        $dataview->portofolio = Portofolio::join('profil_kop_jasa', 'jasa.id_jasa', '=', 'portofolio.id_jasa')->get();
        return view('pages/front/portofolio', compact('dataview'));
    }

    public function portofolio_detail($id)
    {

        $dataview = new \stdClass();

        $portofolio = Portofolio::join('jasa', 'jasa.id_jasa', '=', 'portofolio.id_jasa')->find($id);
        // Jika konten tidak ditemukan, arahkan ke halaman 404
        if (!$portofolio) {
            abort(404);
        }

        // Cek apakah konten sudah pernah dilihat di sesi ini
        $viewedPortotfolios = session()->get('viewed_portofolios', []);

        if (!in_array($id, $viewedPortotfolios)) {
            // Tambahkan ID ke session
            session()->push('viewed_portofolios', $id);

            // Tambahkan jumlah view di konten
            $portofolio->view += 1;
            $portofolio->save();
        }


        $dataview->title = 'Portofolio | ' . $portofolio->nama_produk;
        $dataview->portofolio = $portofolio;
        // layanan
        $dataview->layanan = Layanan::all();
        return view('pages/front/detail_portofolio', compact('dataview'));
    }

    public function artikel()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Artikel ' . getTitle();

        $dataview->artikel = Artikel::orderBy('tanggal', 'DESC')->get();
        // layanan
        $dataview->layanan = Layanan::all();
        return view('pages/front/artikel', compact('dataview'));
    }

    public function artikel_detail($id)
    {

        $dataview = new \stdClass();

        $artikel = Artikel::find($id);
        // Jika artikel tidak ditemukan, arahkan ke halaman 404
        if (!$artikel) {
            abort(404);
        }

        // Cek apakah artikel sudah pernah dilihat di sesi ini
        $viewedArticles = session()->get('viewed_articles', []);

        if (!in_array($id, $viewedArticles)) {
            // Tambahkan ID artikel ke session
            session()->push('viewed_articles', $id);

            // Tambahkan jumlah view di artikel
            $artikel->view += 1;
            $artikel->save();
        }


        $dataview->title = 'Artikel | ' . $artikel->judul;
        $dataview->artikel = $artikel;
        // event
        $dataview->event_terkini = Event::first();
        // layanan
        $dataview->layanan = Layanan::all();
        return view('pages/front/detail_artikel', compact('dataview'));
    }

    public function kegiatan()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Kegiatan ' . getTitle();
        $dataview->kegiatan = Kegiatan::join('jasa', 'jasa.id_jasa', '=', 'kegiatan.id_jasa')->orderBy('tanggal', 'DESC')->get();
        return view('pages/front/kegiatan', compact('dataview'));
    }

    public function kegiatan_detail($id)
    {

        $dataview = new \stdClass();

        $kegiatan = Kegiatan::join('jasa', 'jasa.id_jasa', '=', 'kegiatan.id_jasa')->find($id);
        // Jika konten tidak ditemukan, arahkan ke halaman 404
        if (!$kegiatan) {
            abort(404);
        }

        // Cek apakah konten sudah pernah dilihat di sesi ini
        $viewedKegiatans = session()->get('viewed_kegiatans', []);

        if (!in_array($id, $viewedKegiatans)) {
            // Tambahkan ID ke session
            session()->push('viewed_kegiatans', $id);

            // Tambahkan jumlah view di konten
            $kegiatan->view += 1;
            $kegiatan->save();
        }


        $dataview->title = 'Kegiatan | ' . $kegiatan->nama_kegiatan;
        $dataview->kegiatan = $kegiatan;
        // event
        $dataview->event_terkini = Event::first();
        // layanan
        $dataview->layanan = Layanan::all();
        return view('pages/front/detail_kegiatan', compact('dataview'));
    }

    public function pengabdian()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Pengabdian ' . getTitle();
        $dataview->pengabdian = Pengabdian::orderBy('bulan', 'DESC')->get();
        return view('pages/front/pengabdian', compact('dataview'));
    }

    public function pengabdian_detail($id)
    {

        $dataview = new \stdClass();

        $pengabdian = Pengabdian::find($id);
        // Jika konten tidak ditemukan, arahkan ke halaman 404
        if (!$pengabdian) {
            abort(404);
        }

        // Cek apakah konten sudah pernah dilihat di sesi ini
        $viewedPengabdians = session()->get('viewed_pengabdians', []);

        if (!in_array($id, $viewedPengabdians)) {
            // Tambahkan ID ke session
            session()->push('viewed_pengabdians', $id);

            // Tambahkan jumlah view di konten
            $pengabdian->view += 1;
            $pengabdian->save();
        }


        $dataview->title = 'Pengabdian | ' . $pengabdian->nama_kegiatan;
        $dataview->pengabdian = $pengabdian;
        // event
        $dataview->event_terkini = Event::first();
        // layanan
        $dataview->layanan = Layanan::all();
        return view('pages/front/detail_pengabdian', compact('dataview'));
    }

    public function karir()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Karir ' . getTitle();
        $dataview->karir = \App\Models\Karir::orderBy('id_karir', 'DESC')->get();
        return view('pages/front/karir', compact('dataview'));
    }

    public function karir_detail($id, $slug)
    {
        $dataview = new \stdClass();

        $karir = \App\Models\Karir::find($id);
        if (!$karir) {
            abort(404);
        }

        // Optional: Track views if needed
        $viewedKarirs = session()->get('viewed_karirs', []);
        if (!in_array($id, $viewedKarirs)) {
            session()->push('viewed_karirs', $id);
            $karir->view = $karir->view + 1;
            $karir->save();
        }

        $dataview->title = 'Karir | ' . $karir->judul_posisi;
        $dataview->karir = $karir;
        return view('pages/front/detail_karir', compact('dataview'));
    }
}
