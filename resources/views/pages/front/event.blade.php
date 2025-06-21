@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Daftar Event dari L|KITA Bengkalis" />
<meta property="og:description" content="Lihat daftar event kami" />
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
                        <h6 class="text-white title"><a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> <i class="mdi mdi-chevron-right"></i> Event</h6>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Hero section End -->


    <section class="section">
        <div class="container-fluid">
            
            <div class="row">
        		<div class="col-md-12">
        
        			<div class="row">
        				
        				@foreach($dataview->event as $item)
    
        				<div class="col-md-3">
        					<!--<a href="javascript:;" data-toggle="modal" data-target=".detail{{ $item->id_event }}">-->
        					<a href="{{ url('event/'.$item->id_event.'/'.generateSlug($item->nama_kegiatan)) }}">
        					    <div class="card">
                					<img class="card-img-top img-fluid" src="{{ asset($item->file_gambar) }}" alt="{{ $item->nama_kegiatan }}">
                					<div class="card-body">
                						<h5 class="card-title">{{ $item->nama_kegiatan }}</h5>
                						<p class="card-text text-muted">{!! getExcerpt($item->deskripsi, 20) !!}</p>
                					</div>
                					<ul class="list-group list-group-flush">
                						<li class="list-group-item"><i class="mdi mdi-calendar font-18 mr-2 align-middle"></i> <b>{{ tanggalIndonesia($item->tanggal) }}</b></li>
                						<li class="list-group-item"><i class="mdi mdi-map-marker-outline font-18 mr-2 align-middle"></i> {{ $item->lokasi }}</li>
                					</ul>
                					<div class="card-body">
                						<a href="{{ $item->link }}" target="_blank" class="card-link"><i class="mdi mdi-web font-18 mr-2 align-middle"></i> {{ $item->nama_link }}</a>
                					</div>
                				</div>
        					</a>
        				</div>
        				
        				<div class="modal fade detail{{ $item->id_event }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myLargeModalLabel">{{ $item->nama_kegiatan }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td rowspan="4" class="text-center" width="50%">
                                                    <img src="{{ asset($item->file_gambar) }}" class="img-fluid">
                                                </td>
                                                <td><i class="mdi mdi-calendar font-18 mr-1 align-middle"></i> <b>{{ tanggalIndonesia($item->tanggal) }}</b>&nbsp;&nbsp;|&nbsp;&nbsp;<i class="mdi mdi-map-marker-outline font-18 mr-1 align-middle"></i> {{ $item->lokasi }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <strong>{{ $item->nama_kegiatan }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <a href="{{ $item->link }}"><i class="mdi mdi-web font-18 mr-2 align-middle"></i> {{ $item->nama_link }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">{{ $item->bidang_kegiatan }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">{{ $item->deskripsi }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
        
        				@endforeach
        				
        			</div>
        			
        		</div>
        	</div>
            
        </div>
        <!-- end container-fluid -->
    </section>
@endsection

@push('script')

@endpush