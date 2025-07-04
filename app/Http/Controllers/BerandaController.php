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
use App\Models\Sejarah;
use App\Models\VisiMisi;
use App\Models\Regulasi;
use App\Models\Manfaat;
use App\Models\Dokumentasi;
use App\Models\DokumentasiFoto;
use App\Models\DokumentasiVideo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



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
        $dataview->title = 'Beranda | ' . getTitle();

        // Slider & Tentang
        $dataview->slider = Slider::where('status_aktif', 'Y')->orderBy('id_slider', 'DESC')->limit(3)->get();
        $dataview->tentang = Tentang::where('prefix', 'tentang')->first();

        // Layanan, Struktur Organisasi, Mitra
        $dataview->layanan = Layanan::all();
        $dataview->pengawas = Team::where('status_aktif', 'Y')->where('kategori', 'pengawas')->get();
        $dataview->pengurus = Team::where('status_aktif', 'Y')->where('kategori', 'pengurus')->get();
        $dataview->mitra = Mitra::all();

        // Artikel, Event, Portofolio
        $dataview->artikel_terbaru = Artikel::limit(3)->orderBy('tanggal', 'DESC')->get();
        $dataview->event_terkini = Event::first();

        // Regulasi & Manfaat
        $dataview->regulasi = Regulasi::all();
        $dataview->manfaat = Manfaat::orderBy('id_manfaat', 'DESC')->get();

        // Dokumentasi: Ringkasan (untuk bagian bawah / preview)
        $dataview->foto = Dokumentasi::whereHas('foto')
            ->with(['foto' => function ($q) {
                $q->limit(1);
            }])
            ->orderBy('tanggal', 'DESC')
            ->limit(4)
            ->get();

        $dataview->video = Dokumentasi::whereHas('video')
            ->with(['video' => function ($q) {
                $q->where('is_preview', 'Y');
            }])
            ->orderBy('tanggal', 'DESC')
            ->limit(4)
            ->get();

        // Dokumentasi: List mentah (untuk carousel galeri)
        $dataview->fotoList = DokumentasiFoto::with('dokumentasi')->latest()->limit(10)->get();
        $dataview->videoList = DokumentasiVideo::with('dokumentasi')->latest()->limit(10)->get();

        return view('pages.front.beranda', compact('dataview'));
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
        $dataview->visi = \App\Models\VisiMisi::where('jenis', 'Visi')->orderBy('urutan')->get();
        $dataview->misi = \App\Models\VisiMisi::where('jenis', 'Misi')->orderBy('urutan')->get();
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

        // Tambahkan data Visi & Misi
        $dataview->visi = \App\Models\VisiMisi::where('jenis', 'Visi')->orderBy('urutan')->get();
        $dataview->misi = \App\Models\VisiMisi::where('jenis', 'Misi')->orderBy('urutan')->get();
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

    // public function portofolio()
    // {
    //     $dataview = new \stdClass();
    //     $dataview->title = 'Portofolio ' . getTitle();
    //     $dataview->portofolio = Portofolio::join('profil_kop_jasa', 'jasa.id_jasa', '=', 'portofolio.id_jasa')->get();
    //     return view('pages/front/portofolio', compact('dataview'));
    // }

    // public function portofolio_detail($id)
    // {

    //     $dataview = new \stdClass();

    //     $portofolio = Portofolio::join('jasa', 'jasa.id_jasa', '=', 'portofolio.id_jasa')->find($id);

    //     if (!$portofolio) {
    //         abort(404);
    //     }


    //     $viewedPortotfolios = session()->get('viewed_portofolios', []);

    //     if (!in_array($id, $viewedPortotfolios)) {

    //         session()->push('viewed_portofolios', $id);


    //         $portofolio->view += 1;
    //         $portofolio->save();
    //     }


    //     $dataview->title = 'Portofolio | ' . $portofolio->nama_produk;
    //     $dataview->portofolio = $portofolio;

    //     $dataview->layanan = Layanan::all();
    //     return view('pages/front/detail_portofolio', compact('dataview'));
    // }

    public function artikel(Request $request)
    {
        $dataview = new \stdClass();
        $dataview->title = 'Artikel ' . getTitle();

        // Get services for sidebar
        $dataview->layanan = Layanan::all();

        // Base query
        $query = Artikel::query();

        // Apply search filter if present
        if ($request->has('cari') && !empty($request->cari)) {
            $this->searchArtikel($query, $request->cari);
        }

        // Apply date filter if present
        if ($request->filled('tanggal_mulai') || $request->filled('tanggal_selesai')) {
            try {
                $startDate = $request->tanggal_mulai ?: '1970-01-01';
                $endDate = $request->tanggal_selesai ?: now()->format('Y-m-d');
                $this->filterArtikelByDate($query, $startDate, $endDate);
            } catch (\Exception $e) {
                return redirect()->route('artikel')->with('error', 'Format tanggal tidak valid');
            }
        }

        // Order and paginate results
        $dataview->artikel = $query->orderBy('tanggal', 'DESC')
            ->paginate(5)
            ->appends($request->except('page'));

        return view('pages/front/artikel', compact('dataview'));
    }

    private function searchArtikel($query, $searchTerm)
    {
        $query->where(function ($q) use ($searchTerm) {
            $q->where('judul', 'like', '%' . $searchTerm . '%')
                ->orWhere('isi', 'like', '%' . $searchTerm . '%');
        });
    }

    private function filterArtikelByDate($query, $startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        // Ensure start date is before end date
        if ($startDate->gt($endDate)) {
            // Swap dates if they're in wrong order
            [$startDate, $endDate] = [$endDate, $startDate];
        }

        $query->whereBetween('tanggal', [$startDate, $endDate]);
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
        $dataview->layanan = \App\Models\Layanan::all();

        return view('pages/front/detail_karir', compact('dataview'));
    }
    public function dokumentasi(Request $request)
    {
        $tipe = $request->query('tipe');
        $dataview = new \stdClass();
        $dataview->title = 'Dokumentasi | ' . getTitle();

        if ($tipe === 'foto') {
            $dataview->dokumentasi = Dokumentasi::with('foto')->whereHas('foto')->orderBy('tanggal', 'DESC')->get();
        } elseif ($tipe === 'video') {
            $dataview->dokumentasi = Dokumentasi::with('video')->whereHas('video')->orderBy('tanggal', 'DESC')->get();
        } else {
            $dataview->dokumentasi = Dokumentasi::with(['foto', 'video'])->orderBy('tanggal', 'DESC')->get();
        }

        $dataview->tipe = $tipe;

        return view('pages/front/dokumentasi', compact('dataview'));
    }
}
