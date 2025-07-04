@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Detail Karir - {{ $dataview->karir->judul_posisi }}" />
<meta property="og:description" content="Detail lowongan karir {{ $dataview->karir->judul_posisi }}" />
<meta property="og:image" content="{{ asset($dataview->karir->foto ?? 'themes/front/images/logo-hitam.png') }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />
@endpush

@section('content')
<section class="hero-section bg-primary py-4">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <h6 class="text-white mb-0">
                <a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a>
                <i class="mdi mdi-chevron-right"></i>
                <a href="{{ route('karir') }}" class="text-white">Karir</a>
                <i class="mdi mdi-chevron-right"></i>
                Detail
            </h6>
        </div>
    </div>
</section>

<section class="section py-5 bg-light">
    <div class="container">
        <div class="row gy-4">
            <!-- Konten Utama -->
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded mb-4">
                    <div class="card-body">
                        <h2 class="fw-bold text-primary">{{ $dataview->karir->judul_posisi }}</h2>
                        <div class="text-muted small d-flex flex-wrap gap-3 mb-3">
                            <span><i class="mdi mdi-calendar"></i> {{ tanggal_indo($dataview->karir->created_at, true) }}</span>
                            <span><i class="mdi mdi-map-marker"></i> {{ $dataview->karir->penempatan }}</span>
                            <span><i class="mdi mdi-office-building"></i> {{ $dataview->karir->divisi }}</span>
                        </div>
                        <span class="badge rounded-pill px-3 py-1 {{ $dataview->karir->status === 'Open' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $dataview->karir->status === 'Open' ? 'Menerima Lamaran' : 'Ditutup' }}
                        </span>
                    </div>
                </div>

                <!-- Gambar Karir -->
                @if($dataview->karir->foto)
                <div class="card shadow border-0 mb-4">
                    <img src="{{ asset($dataview->karir->foto) }}" class="img-fluid rounded" style="object-fit: cover; width: 100%; max-height: 320px;">
                </div>
                @endif

                <!-- Deskripsi -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold text-primary"><i class="mdi mdi-text-box-outline me-1"></i> Deskripsi</h5>
                        <hr>
                        <div class="mt-2">{!! $dataview->karir->deskripsi !!}</div>
                    </div>
                </div>

                <!-- Kualifikasi -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold text-primary"><i class="mdi mdi-check-decagram me-1"></i> Kualifikasi</h5>
                        <hr>
                        <div class="mt-2">{!! $dataview->karir->kualifikasi !!}</div>
                    </div>
                </div>

                <!-- Benefit -->
                @if($dataview->karir->benefit)
                <div class="card shadow border-0 mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold text-primary"><i class="mdi mdi-gift-outline me-1"></i> Benefit</h5>
                        <hr>
                        <div class="mt-2">{!! $dataview->karir->benefit !!}</div>
                    </div>
                </div>
                @endif

                <!-- Tombol Aksi -->
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-4">
                    <a href="{{ route('karir') }}" class="btn btn-outline-secondary">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                    <div class="d-flex flex-wrap gap-2">
                        @if($dataview->karir->status === 'Open')
                        <a href="{{ route('lamaran.create', ['id_karir' => $dataview->karir->id_karir]) }}" class="btn btn-primary">
                            <i class="mdi mdi-send"></i> Lamar Sekarang
                        </a>
                        <form id="form-lamaran-email" onsubmit="return validateRecaptcha()" class="d-flex align-items-center gap-2">
                            <input type="hidden" id="emailTo" value="{{ getKontak()->email }}">
                            <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-paper-plane me-1"></i> Lamar via Email
                            </button>
                        </form>
                        @endif

                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="mdi mdi-share-variant"></i> Bagikan
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank"><i class="mdi mdi-whatsapp text-success"></i> WhatsApp</a></li>
                                <li><a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"><i class="mdi mdi-facebook text-primary"></i> Facebook</a></li>
                                <li><a class="dropdown-item" href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank"><i class="mdi mdi-twitter text-info"></i> Twitter</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="mdi mdi-information-outline me-1"></i> Informasi Tambahan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush small">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <span><i class="mdi mdi-calendar me-1 text-muted"></i> Batas Lamar</span>
                                <span class="fw-semibold">{{ tanggal_indo($dataview->karir->batas_lamar) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <span><i class="mdi mdi-account-group-outline me-1 text-muted"></i> Kuota</span>
                                <span class="fw-semibold">{{ $dataview->karir->kuota }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <span><i class="mdi mdi-check-circle-outline me-1 text-muted"></i> Status</span>
                                <span class="fw-semibold">{{ $dataview->karir->status }}</span>
                            </li>
                            @if($dataview->karir->dokumen_syarat)
                            <li class="list-group-item">
                                <i class="mdi mdi-file-download-outline me-1 text-muted"></i> Dokumen Syarat:<br>
                                <a href="{{ asset($dataview->karir->dokumen_syarat) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2 w-100">
                                    <i class="mdi mdi-download"></i> Unduh
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="mdi mdi-star-outline me-1"></i> Layanan Kami</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($dataview->layanan as $item)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#detail{{ $item->id_layanan }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                {!! $item->icon !!}<span class="ms-2">{{ $item->nama_layanan }}</span>
                            </a>

                            <div class="modal fade" id="detail{{ $item->id_layanan }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">{!! $item->icon !!} {{ $item->nama_layanan }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $item->deskripsi }}
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('script')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
function validateRecaptcha() {
    const response = grecaptcha.getResponse();
    if (response.length === 0) {
        alert('Silakan centang reCAPTCHA terlebih dahulu.');
        return false;
    }

    const email = document.getElementById("emailTo").value;
    const subject = encodeURIComponent("Lamaran Pekerjaan {{ $dataview->karir->judul_posisi }}");
    const body = encodeURIComponent(`Halo,%0D%0A%0D%0ASaya ingin melamar untuk posisi:%0D%0A- Posisi: {{ $dataview->karir->judul_posisi }}%0D%0A- Divisi: {{ $dataview->karir->divisi }}%0D%0A- Penempatan: {{ $dataview->karir->penempatan }}%0D%0A%0D%0AMohon informasi lebih lanjut mengenai proses rekrutmen.%0D%0A%0D%0ATerima kasih.`);

    const mailto = `https://mail.google.com/mail/?view=cm&to=${email}&su=${subject}&body=${body}`;
    window.open(mailto, '_blank');
    return false;
}
</script>
@endpush
