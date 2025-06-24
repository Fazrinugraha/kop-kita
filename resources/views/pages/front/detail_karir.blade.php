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
    <!-- Hero section Start -->
    <section class="hero-section bg-primary" id="home">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <hr style="border: 1px solid white;">
                    <div class="hero-wrapper pb-3">
                        <h6 class="text-white title">
                            <a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> 
                            <i class="mdi mdi-chevron-right"></i> 
                            <a href="{{ route('karir') }}" class="text-white">Karir</a>
                            <i class="mdi mdi-chevron-right"></i> 
                            Detail
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero section End -->

    <section class="section">
        <div class="container">
            <div class="card mb-3">
                @if($dataview->karir->foto)
                <img src="{{ asset($dataview->karir->foto) }}" alt="{{ $dataview->karir->judul_posisi }}" class="card-img-top img-fluid" style="max-height: 300px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h3 class="card-title">{{ $dataview->karir->judul_posisi }}</h3>
                    <p><strong>Divisi:</strong> {{ $dataview->karir->divisi }}</p>
                    <p><strong>Penempatan:</strong> {{ $dataview->karir->penempatan }}</p>
                    <p><strong>Deskripsi:</strong></p>
                    <p>{!! $dataview->karir->deskripsi !!}</p>
                    <p><strong>Kualifikasi:</strong></p>
                    <p>{!! $dataview->karir->kualifikasi !!}</p>
                    @if($dataview->karir->benefit)
                    <p><strong>Benefit:</strong></p>
                    <p>{!! $dataview->karir->benefit !!}</p>
                    @endif
                    <p><strong>Batas Lamar:</strong> {{ $dataview->karir->batas_lamar ? tanggal_indo($dataview->karir->batas_lamar) : '-' }}</p>
                    <p><strong>Kuota:</strong> {{ $dataview->karir->kuota }}</p>
                    <p><strong>Status:</strong> {{ $dataview->karir->status }}</p>
                    @if($dataview->karir->dokumen_syarat)
                    <a href="{{ asset($dataview->karir->dokumen_syarat) }}" target="_blank" class="btn btn-primary btn-sm mb-2">Lihat Dokumen Syarat</a>
                    @endif
                    <br>
                    <a href="{{ route('karir') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar Karir</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')

@endpush
