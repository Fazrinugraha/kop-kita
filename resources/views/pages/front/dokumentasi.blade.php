@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Dokumentasi L|KITA Bengkalis" />
<meta property="og:description" content="Lihat dokumentasi kegiatan kami" />
<meta property="og:image" content="{{ asset('themes/front/images/logo-hitam.png') }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />
@endpush

@section('content')

<!-- Hero section Start -->
<section class="hero-section bg-primary" id="home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <hr style="border: 1px solid white;">
                <div class="hero-wrapper pb-3">
                    <h6 class="text-white title">
                        <a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> 
                        <i class="mdi mdi-chevron-right"></i> Dokumentasi
                    </h6>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero section End -->

<!-- Dokumentasi Section Start -->
<section class="section">
    <div class="container-fluid">
        <!-- Filter Buttons -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="btn-group" role="group" aria-label="Filter Dokumentasi">
                    <a href="{{ url('dokumentasi?tipe=foto') }}" class="btn btn-outline-primary {{ request('tipe') == 'foto' ? 'active' : '' }}">
                        <i class="mdi mdi-image"></i> Foto
                    </a>
                    <a href="{{ url('dokumentasi?tipe=video') }}" class="btn btn-outline-primary {{ request('tipe') == 'video' ? 'active' : '' }}">
                        <i class="mdi mdi-video"></i> Video
                    </a>
                    <a href="{{ url('dokumentasi') }}" class="btn btn-outline-secondary {{ request('tipe') == null ? 'active' : '' }}">
                        <i class="mdi mdi-format-list-bulleted"></i> Semua
                    </a>
                </div>
            </div>
        </div>

        <!-- Konten Dokumentasi -->
        <div class="row">
            @forelse($dataview->dokumentasi as $item)
                <div class="col-md-12 mb-4">
                    <div class="card border">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="text-muted">{{ $item->tanggal }}</p>
                            <p>{{ $item->deskripsi }}</p>

                            <div class="row">
                                @foreach($item->media as $media)
                                    <div class="col-md-3 mb-3">
                                        @if($media->jenis_media === 'foto')
                                            <img src="{{ asset($media->media_path) }}" alt="Foto dokumentasi" class="img-fluid rounded">
                                        @elseif($media->jenis_media === 'video')
                                            <video controls width="100%" class="rounded">
                                                <source src="{{ asset($media->media_path) }}" type="video/mp4">
                                                Browser tidak mendukung video.
                                            </video>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <p class="text-muted text-center">Tidak ada dokumentasi tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- Dokumentasi Section End -->

@endsection

@push('script')
@endpush
