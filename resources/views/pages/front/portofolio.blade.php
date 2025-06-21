@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Daftar Portofolio L|KITA Bengkalis" />
<meta property="og:description" content="Lihat daftar portofolio kami" />
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
                        <h6 class="text-white title"><a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> <i class="mdi mdi-chevron-right"></i> Portofolio</h6>
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
        				
        				@foreach($dataview->portofolio as $item)
    
        				<div class="col-md-3 col-6">
        					<!--<a href="javascript:;" data-toggle="modal" data-target=".detail{{ $item->id_portofolio }}">-->
        					<a href="{{ url('portofolio/'.$item->id_portofolio.'/'.generateSlug($item->nama_produk)) }}">
        					    <div class="card">
            						<div class="row no-gutters align-items-center">
            							<div class="col-md-4 text-center">
            							<img src="{{ asset($item->file_icon) }}" class="mt-2" height="60">
            							</div>
            							<div class="col-md-8">
            								<div class="card-body py-2">
            									<small class="mt-0 pt-2 text-muted">{{ $item->nama_jasa }}</small>
            									<h5 class="card-title">{!! $item->nama_produk !!}</h5>
            									<h6 class="mt-0 pt-2">{{ $item->kategori }}</h6>
            								</div>
            							</div>
            						</div>
            					</div>
        					</a>
        				</div>
        				
        				<div class="modal fade detail{{ $item->id_portofolio }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myLargeModalLabel">{!! $item->nama_produk !!}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td rowspan="4" class="text-center">
                                                        <img src="{{ asset($item->file_icon) }}" height="150">
                                                    </td>
                                                    <td>{{ $item->nama_jasa }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <strong>{!! $item->nama_produk !!}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="{{ $item->link }}">{{ $item->link }}</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">{{ $item->kategori }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">{{ $item->deskripsi }}</td>
                                                </tr>
                                            </table>
                                        </div>
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