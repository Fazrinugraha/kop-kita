@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Daftar Kegiatan L|KITA Bengkalis" />
<meta property="og:description" content="Lihat daftar kegiatan kami" />
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
                        <h6 class="text-white title"><a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> <i class="mdi mdi-chevron-right"></i> Kegiatan</h6>
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
        				
        				@foreach($dataview->kegiatan as $item)
    
        				<div class="col-md-3">
        					{{--<a href="javascript:;" data-toggle="modal" data-target=".detail{{ $item->id_kegiatan }}">
        					    <div class="card">
        							<img class="card-img-top img-fluid cover-berita" src="{{ asset($item->file_gambar) }}" alt="{{ $item->nama_kegiatan }}">
        							<div class="card-body">
        								<h5 class="card-title">{{ $item->nama_kegiatan }}</h5>
        								<p class="card-text">
        									<small class="text-muted">{{ tanggalIndonesia($item->tanggal, true) }}</small>
        								</p>
        								<p class="card-text">{!! getExcerpt($item->keterangan, 20) !!}</p>
        							</div>
        						</div>
        					</a>--}}
        					<!--<a href="javascript:;" data-toggle="modal" data-target=".detail{{ $item->id_kegiatan }}">-->
        					<a href="{{ url('informasi/kegiatan/'.$item->id_kegiatan.'/'.generateSlug($item->nama_kegiatan)) }}">
        					    <div class="card">
                					<img class="card-img-top img-fluid" src="{{ asset($item->file_gambar) }}" alt="{{ $item->nama_kegiatan }}">
                					<div class="card-body">
                						<h5 class="card-title">{{ $item->nama_kegiatan }}</h5>
                						<p class="card-text">
        									<small class="text-muted">{!! getExcerpt($item->keterangan, 20) !!}</small>
        								</p>
                					</div>
                					<ul class="list-group list-group-flush">
                						<li class="list-group-item"><i class="mdi mdi-calendar font-16 mr-1 align-middle"></i> <small>{{ tanggalIndonesia($item->tanggal) }}</small>&nbsp;&nbsp;<i class="mdi mdi-label font-16 mr-1 align-middle"></i> <small>{{ $item->nama_jasa }}</small></li>
                					</ul>
                					<!--<div class="card-body">-->
                					<!--	<a href="XXX" target="_blank" class="card-link"><i class="mdi mdi-web font-18 mr-2 align-middle"></i> XXX</a>-->
                					<!--</div>-->
                				</div>
        					</a>
        				</div>
        				
        				<div class="modal fade detail{{ $item->id_kegiatan }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myLargeModalLabel">{{ $item->nama_kegiatan }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="text-center">
                                                    <img src="{{ asset($item->file_gambar) }}" class="img-fluid">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="mdi mdi-calendar font-16 mr-1 align-middle"></i> <small><b>{{ tanggalIndonesia($item->tanggal) }}</b></small>&nbsp;&nbsp;<i class="mdi mdi-label font-16 mr-1 align-middle"></i> <small><b>{{ $item->nama_jasa }}</b></small></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>{{ $item->nama_kegiatan }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{!! $item->keterangan !!}</td>
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