@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Sekilas tentang L|KITA Bengkalis" />
<meta property="og:description" content="Lihat tentang kami" />
<meta property="og:image" content="{{ asset('themes/front/') }}/images/logo-hitam.png" />
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
                        <h6 class="text-white title"><a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> <i class="mdi mdi-chevron-right"></i> Tentang Kami</h6>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Hero section End -->

    <section class="section" style="padding-top: 40px; padding-bottom: unset;">
        <div class="container-fluid">
            
            <h3 class="mb-4">{{ $dataview->tentang->judul }}</h3>

            <div class="row justify-content-start">
                <div class="col-lg-8">
                    <!--<p style="font-size: 14px;"><i class="mdi mdi-account"></i> Admin&nbsp;&nbsp;</p>-->
                    <hr>
                    
                    
                    <div class="text-center">
                        <img class="card-img-top img-fluid" src="{{ asset($dataview->tentang->file_gambar) }}" style="width:200px;">
                    </div>
                    
                    
                    <div class="mt-3 mb-5 text-dark" style="text-align: justify;">
                        
                        {!! $dataview->tentang->isi !!}
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    {{-- <p style="font-size: 14px;"><b>Profil</b></p>
                    <hr>
    				
    				<div class="card">
    					<ul class="list-group list-group-flush">
    						<li class="list-group-item {{ Request::segment(2)=='sejarah' ? 'active' : '' }}"><a href="{{ url('profil/sejarah') }}" class="{{ Request::segment(2)=='sejarah' ? 'text-white' : 'text-dark' }}"><i class="mdi mdi-{{ Request::segment(2)=='sejarah' ? 'circle' : 'circle-outline' }} font-18 mr-2 align-middle"></i> Sejarah</a></li>
    						<li class="list-group-item {{ Request::segment(2)=='pengurus' ? 'active' : '' }}"><a href="{{ url('profil/pengurus') }}" class="{{ Request::segment(2)=='pengurus' ? 'text-white' : 'text-dark' }}"><i class="mdi mdi-{{ Request::segment(2)=='pengurus' ? 'circle' : 'circle-outline' }} font-18 mr-2 align-middle"></i> Struktur Organisasi / Pengurus</a></li>
    						<li class="list-group-item {{ Request::segment(2)=='tupoksi' ? 'active' : '' }}"><a href="{{ url('profil/tupoksi') }}" class="{{ Request::segment(2)=='tupoksi' ? 'text-white' : 'text-dark' }}"><i class="mdi mdi-{{ Request::segment(2)=='tupoksi' ? 'circle' : 'circle-outline' }} font-18 mr-2 align-middle"></i> Tugas & Fungsi</a></li>
    						<li class="list-group-item {{ Request::segment(2)=='visi-misi' ? 'active' : '' }}"><a href="{{ url('profil/visi-misi') }}" class="{{ Request::segment(2)=='visi-misi' ? 'text-white' : 'text-dark' }}"><i class="mdi mdi-{{ Request::segment(2)=='visi-misi' ? 'circle' : 'circle-outline' }} font-18 mr-2 align-middle"></i> Visi & Misi</a></li>
    					</ul>
    				</div> --}}
    				
                    {{-- <p style="font-size: 14px;"><b>Event & Agenda</b></p>
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
    				</div> --}}
    				
    				
    				
    				<div class="card">
    					<div class="card-body">
    						<h5 class="card-title">Layanan Kami</h5>
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
    
    <section class="section bg-light" id="pricing">
    	<div class="container-fluid">
    		<div class="row justify-content-center">
    			<div class="col-lg-6">
    				<div class="text-center mb-4">
    					<h3 class="title">Team</h3>
    					<p class="text-muted">Tim kecil ini, bermimpi besar!<br>Bersama, kami menciptakan solusi teknologi yang berdampak besar.</p>
    				</div>
    			</div>
    		</div>
    		<!-- end row -->
    
    		<div class="row justify-content-center">
    			<div class="col-lg-10">
    				<div class="row justify-content-center">
    					@foreach ($dataview->team as $item)
    						
    					<div class="col-lg-2">
    						<div class="pricing-box rounded bg-light mt-3" style="border-radius: 1rem !important">
    							<div class="plan-header  text-center">
    								{{-- <div class="bg-success py-3 mt-2">
    									<h5 class="plan-title text-white text-uppercase font-16 mb-0">Extended</h5>
    								</div>
    								<h2 class="mt-4 pt-2"><sup><small>$</small></sup>999</h2> --}}
    								<img src="{{ asset($item->file_foto) }}" class="img-fluid p-3">
    								<div class="plan-duration text-muted">{{ $item->nama }}</div>
    								<small>
    									<i class="mdi mdi-bag-checked mr-1"></i> {{ $item->bidang }}
    								</small>
    							</div>
    
    							<div class="plan-listing p-2">
    							{{-- <div class="plan-listing p-4 mt-3"> --}}
    								{{-- <p><i class="mdi mdi-bag-checked mr-1"></i> {{ $item->bidang }}</p>
    								<p><i class="mdi mdi-update mr-1"></i> Free Updates</p>
    								<p><i class="mdi mdi-upload-network-outline mr-1"></i> 3 Domain</p>
    								<p><i class="mdi mdi-calendar-repeat mr-1"></i> Monthly updates</p>
    								<p class="mb-0"><i class="mdi mdi-alarm-check mr-1"></i> 24x7 Support</p> --}}
    							</div>
    							{{-- <div class="text-center my-3">
    								<a href="#" class="btn btn-primary">Purchase Now</a>
    							</div> --}}
    						</div>
    					</div>
    
    					@endforeach
    				</div>
    			</div>
    		</div>
    		<!-- end row -->
    	    </div>
    	</div>
    	<!-- end container-fluid -->
    </section>
    
@endsection

@push('script')

@endpush