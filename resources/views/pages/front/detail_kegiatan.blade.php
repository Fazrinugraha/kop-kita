@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Kegiatan | {{ $dataview->kegiatan->nama_kegiatan }}" />
<meta property="og:description" content="{{ strip_tags(getExcerpt($dataview->kegiatan->keterangan)) }}" />
<meta property="og:image" content="{{ asset($dataview->kegiatan->file_gambar) }}" />
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
                        <h6 class="text-white title"><a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> <i class="mdi mdi-chevron-right"></i> Portofolio <i class="mdi mdi-chevron-right"></i> Detail</h6>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Hero section End -->


    <section class="section" style="padding-top: 40px;">
        <div class="container-fluid">
            
            <!--<h5 class="mb-5 text-center title">Komite Olahraga Nasional Indonesia (KONI) Kota Dumai</h5>-->
            <h3 class="mb-4">{{ $dataview->kegiatan->nama_kegiatan }}</h3>

            <div class="row justify-content-start">
                <div class="col-lg-8">
                    
                    <p style="font-size: 14px;">
                        <i class="mdi mdi-calendar"></i> {{ tanggalIndonesia($dataview->kegiatan->created_at, true) }}&nbsp;&nbsp;|&nbsp;&nbsp;<i class="mdi mdi-eye"></i> Sudah {{ number_format($dataview->kegiatan->view) }}x Dibaca
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
                           href="http://twitter.com/share?text={{ urlencode($dataview->kegiatan->nama_kegiatan) }}&url={{ urlencode(url()->current()) }}" 
                           target="_blank">
                            <i class="mdi mdi-twitter" style="color: white"></i>
                        </a>
                        <a class="btn btn-sm btn-success" 
                           href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}" 
                           target="_blank">
                            <i class="mdi mdi-whatsapp" style="color: white"></i>
                        </a>
                    </p>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset($dataview->kegiatan->file_gambar) }}" class="img-fluid">
                                </td>
                            </tr>
                            <tr>
                                <td><i class="mdi mdi-calendar font-16 mr-1 align-middle"></i> <small><b>{{ tanggalIndonesia($dataview->kegiatan->tanggal) }}</b></small>&nbsp;&nbsp;<i class="mdi mdi-label font-16 mr-1 align-middle"></i> <small><b>{{ $dataview->kegiatan->nama_jasa }}</b></small></td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{ $dataview->kegiatan->nama_kegiatan }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>{!! $dataview->kegiatan->keterangan !!}</td>
                            </tr>
                        </table>
                    </div>
					
                </div>
                <div class="col-lg-4">
                    
                    <p style="font-size: 14px;"><b>Layanan Kami</b></p>
    				<hr>
    				<div class="card">
    					<div class="card-body">
    						<!--<h5 class="card-title">Layanan Kami</h5>-->
    						<p class="card-text">Berikut layanan terbaik kami untuk mendukung kemajuan bisnis dan organisasi Anda</p>
    					</div>
    					<ul class="list-group list-group-flush">
    					    @foreach ($dataview->layanan as $item)
    					    <a href="javascript:;" data-toggle="modal" data-target=".detail{{ $item->id_layanan }}">
    					        <li class="list-group-item">{!! $item->icon !!} <b>{{ $item->nama_layanan }}</b></li>
    					    </a>
    						
    						
    						<div class="modal fade detail{{ $item->id_layanan }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myLargeModalLabel">{{ $item->nama_layanan }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $item->deskripsi }}
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
    						@endforeach
    					</ul>
    					<div class="card-body">
    						<!--<a href="#" target="_blank" class="card-link"><i class="mdi mdi-web font-18 mr-2 align-middle"></i> Official Website</a>-->
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