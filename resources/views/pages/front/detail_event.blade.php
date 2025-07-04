@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Event | {{ $dataview->event->nama_kegiatan }}" />
<meta property="og:description" content="{{ strip_tags(getExcerpt($dataview->event->deskripsi)) }}" />
<meta property="og:image" content="{{ asset($dataview->event->file_gambar) }}" />
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
                        <h6 class="text-white title"><a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> <i class="mdi mdi-chevron-right"></i> Event <i class="mdi mdi-chevron-right"></i> Detail</h6>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Hero section End -->


    <section class="section" style="padding-top: 40px;">
        <div class="container-fluid">
            
            <!--<h5 class="mb-5 text-center title">Komite Olahraga Nasional Indonesia (KONI) Kota Dumai</h5>-->
            <h3 class="mb-4">{{ $dataview->event->nama_kegiatan }}</h3>

            <div class="row justify-content-start">
                <div class="col-lg-8">
                    
                    <p style="font-size: 14px;">
                        <i class="mdi mdi-calendar"></i> {{ tanggalIndonesia($dataview->event->created_at, true) }}&nbsp;&nbsp;|&nbsp;&nbsp;<i class="mdi mdi-eye"></i> Sudah {{ number_format($dataview->event->view) }}x Dibaca
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
                           href="http://twitter.com/share?text={{ urlencode($dataview->event->nama_kegiatan) }}&url={{ urlencode(url()->current()) }}" 
                           target="_blank">
                            <i class="mdi mdi-twitter" style="color: white"></i>
                        </a>
                        <a class="btn btn-sm btn-success" 
                           href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}" 
                           target="_blank">
                            <i class="mdi mdi-whatsapp" style="color: white"></i>
                        </a>
                    </p>
                    
                    <img class="card-img-top img-fluid" src="{{ asset($dataview->event->file_gambar) }}" alt="Gambar Artikel">
                    
                    <small><i>{{ $dataview->event->ket_gambar }}</i></small>
                    
                    <div class="mt-3 mb-5 text-dark" style="text-align: justify;">
                        
                        {!! $dataview->event->deskripsi !!}
                        
                    </div>
                    
                    <ul class="list-group list-group-flush">
						<li class="list-group-item"><i class="mdi mdi-clipboard-text font-18 mr-2 align-middle"></i> <b>{{ $dataview->event->bidang_kegiatan }}</b></li>
						<li class="list-group-item"><i class="mdi mdi-calendar font-18 mr-2 align-middle"></i> <b>{{ tanggalIndonesia($dataview->event->tanggal) }}</b></li>
						<li class="list-group-item"><i class="mdi mdi-map-marker-outline font-18 mr-2 align-middle"></i> {{ $dataview->event->lokasi }}</li>
					</ul>
					<div class="card-body">
						<a href="{{ $dataview->event->link }}" target="_blank" class="card-link"><i class="mdi mdi-web font-18 mr-2 align-middle"></i> {{ $dataview->event->nama_link }}</a>
					</div>
					
                </div>
                    <!-- Kolom Kanan: Sidebar -->
      <div class="col-lg-4">
        <!-- Layanan Kami -->
        <div class="card shadow-sm border-0 mb-4">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="mdi mdi-star-outline me-1"></i> Layanan Kami</h5>
          </div>
          <div class="card-body">
            <div class="list-group">
              @foreach ($dataview->layanan as $item)
              <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#detail{{ $item->id_layanan }}" class="list-group-item list-group-item-action d-flex align-items-center hover-shadow-sm">
                {!! $item->icon !!}<span class="ms-2">{{ $item->nama_layanan }}</span>
              </a>

              <!-- Modal -->
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
        <!-- end container-fluid -->
    </section>
@endsection

@push('script')

@endpush