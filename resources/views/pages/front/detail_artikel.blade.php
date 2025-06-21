@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Artikel | {{ $dataview->artikel->judul }}" />
<meta property="og:description" content="{{ strip_tags(getExcerpt($dataview->artikel->isi)) }}" />
<meta property="og:image" content="{{ asset($dataview->artikel->file_gambar) }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />
@endpush

@section('content')
    <!-- Hero section Start -->
    <section class="hero-section bg-primary" id="home">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{-- <div class="hero-wrapper text-center pb-3">
                        <h5 class="text-white text-center title">Artikel <i class="mdi mdi-chevron-right"></i> Pusat Informasi & Kegiatan {{ getTitle() }}</h5>
                    </div> --}}
                    <hr style="border: 1px solid white;">
                    <div class="hero-wrapper pb-3">
                        <h6 class="text-white title"><a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> <i class="mdi mdi-chevron-right"></i> Artikel <i class="mdi mdi-chevron-right"></i> Detail</h6>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Hero section End -->


    <section class="section" style="padding-top: 40px;">
        <div class="container-fluid">
            
            <!--<h5 class="mb-5 text-center title">Komite Olahraga Nasional Indonesia (KONI) Kota Dumai</h5>-->
            <h3 class="mb-4">{{ $dataview->artikel->judul }}</h3>

            <div class="row justify-content-start">
                <div class="col-lg-8">
                    
                    <p style="font-size: 14px;">
                        <i class="mdi mdi-account"></i> {{ $dataview->artikel->editor }}&nbsp;&nbsp;|&nbsp;&nbsp;<i class="mdi mdi-calendar"></i> {{ tanggalIndonesia($dataview->artikel->tanggal, true) }}&nbsp;&nbsp;|&nbsp;&nbsp;<i class="mdi mdi-eye"></i> Sudah {{ number_format($dataview->artikel->view) }}x Dibaca
                    </p>
                    <hr>
                    
                    <p>
                        <i class="mdi mdi-share"></i>
                        <span>Share:</span>
                        <a class="btn btn-sm btn-primary" 
                           href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                           target="_blank">
                            <i class="mdi mdi-facebook" style="color: white"></i>
                        </a>
                        <a class="btn btn-sm btn-info" 
                           href="http://twitter.com/share?text={{ urlencode($dataview->artikel->judul) }}&url={{ urlencode(url()->current()) }}" 
                           target="_blank">
                            <i class="mdi mdi-twitter" style="color: white"></i>
                        </a>
                        <a class="btn btn-sm btn-success" 
                           href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}" 
                           target="_blank">
                            <i class="mdi mdi-whatsapp" style="color: white"></i>
                        </a>
                    </p>
                    
                    <img class="card-img-top img-fluid" src="{{ asset($dataview->artikel->file_gambar) }}" alt="Gambar Artikel">
                    
                    <small><i>{{ $dataview->artikel->ket_gambar }}</i></small>
                    
                    <div class="mt-3 mb-5 text-dark" style="text-align: justify;">
                        
                        {!! $dataview->artikel->isi !!}
                        
                        <p>
                            <b>Sumber: {{ $dataview->artikel->sumber }}</b>
                            <br><b>Editor: {{ $dataview->artikel->editor }}</b>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
<div class="card mb-4" style="border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
    <div class="card-header" style="background: linear-gradient(135deg, #247ba0, #1a659e); color: white; padding: 20px;">
        <h5 class="mb-0" style="font-weight: 600;"><i class="mdi mdi-star-circle mr-2" style="color: #ffd166;"></i> Layanan Kami</h5>
    </div>
    <div class="card-body" style="padding: 0;">
        <ul class="list-group list-group-flush">
            @foreach ($dataview->layanan as $item)
            <a href="javascript:;" data-toggle="modal" data-target=".detail{{ $item->id_layanan }}" style="text-decoration: none;">
                <li class="list-group-item service-item" style="border-left: 4px solid #ffd166; padding: 15px 20px; transition: all 0.3s;">
                    <div class="d-flex align-items-center">
                        <div class="me-3 icon-wrapper" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                            @if($item->nama_layanan == 'Simpanan')
                                <i class="fas fa-wallet fa-lg" style="color: #247ba0;"></i>
                            @elseif($item->nama_layanan == 'Pinjaman')
                                <i class="fas fa-hand-holding-usd fa-lg" style="color: #2ecc71;"></i>
                            @elseif($item->nama_layanan == 'UKM')
                                <i class="fas fa-store fa-lg" style="color: #f39c12;"></i>
                            @elseif(!empty($item->icon))
                                <div class="custom-icon" style="font-size: 1.5rem;">{!! $item->icon !!}</div>
                            @else
                                <i class="fas fa-circle-notch fa-lg" style="color: #3498db;"></i>
                            @endif
                        </div>
                        <div>
                            <h6 class="mb-0" style="color: #247ba0; font-weight: 600;">{{ $item->nama_layanan }}</h6>
                            <small class="text-muted">Klik untuk detail</small>
                        </div>
                    </div>
                </li>
            </a>
            
            <div class="modal fade detail{{ $item->id_layanan }}" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
                        <div class="modal-header" style="background: linear-gradient(135deg, #247ba0, #1a659e); color: white;">
                            <h5 class="modal-title" id="serviceModalLabel">{{ $item->nama_layanan }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding: 25px;">
                            <div class="text-center mb-4">
                                <div style="width: 80px; height: 80px; background-color: rgba(36, 123, 160, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                    @if($item->nama_layanan == 'Simpanan')
                                        <i class="fas fa-wallet fa-2x" style="color: #247ba0;"></i>
                                    @elseif($item->nama_layanan == 'Pinjaman')
                                        <i class="fas fa-hand-holding-usd fa-2x" style="color: #2ecc71;"></i>
                                    @elseif($item->nama_layanan == 'UKM')
                                        <i class="fas fa-store fa-2x" style="color: #f39c12;"></i>
                                    @elseif(!empty($item->icon))
                                        <div class="custom-icon" style="font-size: 2rem;">{!! $item->icon !!}</div>
                                    @else
                                        <i class="fas fa-circle-notch fa-2x" style="color: #3498db;"></i>
                                    @endif
                                </div>
                            </div>
                            <p style="text-align: center;">{{ $item->deskripsi }}</p>
                        </div>
                        <div class="modal-footer" style="border-top: 1px solid #eee;">
                            <button type="button" class="btn" style="background-color: #ffd166; color: #333; font-weight: 500; border: none; border-radius: 30px; padding: 8px 20px;" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </ul>
    </div>
    {{-- <div class="card-footer text-center" style="background-color: #f8f9fa;">
        <a href="#" class="btn btn-sm" style="background-color: #247ba0; color: white; border-radius: 30px; font-weight: 500; padding: 5px 20px;">Lihat Semua Layanan</a>
    </div> --}}
</div>

<style>
    .service-item:hover {
        background-color: #f0f7fb !important;
        transform: translateX(5px);
    }
    
    .icon-wrapper {
        transition: transform 0.3s;
    }
    
    .service-item:hover .icon-wrapper {
        transform: scale(1.1);
    }
    
    .custom-icon svg {
        width: 1.5em;
        height: 1.5em;
    }
</style>
    				
                    
                    <p style="font-size: 14px;"><b>Latest Event</b></p>
                    <hr>
    				
    				<div class="card">
    					<img class="card-img-top img-fluid" src="{{ asset($dataview->event_terkini->file_gambar) }}" alt="{{ $dataview->event_terkini->judul }}">
    					<div class="card-body">
    						<h5 class="card-title">{{ $dataview->event_terkini->judul }}</h5>
    						<p class="card-text">{{ $dataview->event_terkini->deskripsi }}</p>
    					</div>
    					<ul class="list-group list-group-flush">
    						<li class="list-group-item"><i class="mdi mdi-calendar font-18 mr-2 align-middle"></i> <b>{{ tanggalIndonesia($dataview->event_terkini->tanggal) }}</b></li>
    						<li class="list-group-item"><i class="mdi mdi-map-marker-outline font-18 mr-2 align-middle"></i> {{ $dataview->event_terkini->lokasi }}</li>
    					</ul>
    					<div class="card-body">
    						<a href="{{ $dataview->event_terkini->link_event }}" target="_blank" class="card-link"><i class="mdi mdi-web font-18 mr-2 align-middle"></i> Official Website</a>
    					</div>
    				</div>
    				
    				
    				
                </div>
            </div>

            
        </div>

        </div>
        <!-- end container-fluid -->
    </section>
@endsection

@push('script')

@endpush