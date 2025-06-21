@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Website Resmi {{ getTitle() }}" />
<meta property="og:description" content="Selamat Datang di Website {{ env('APP_NAME') }}" />
<meta property="og:image" content="{{ url('assets/front/images/logo-hitam.png') }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />

	<link href="{{ url('assets/front/css/timeline.css') }}" rel="stylesheet" type="text/css"  id="app-stylesheet" />
	
	<style>
    .cover-berita {
        object-fit: cover;
        width: 100%;
        height: 200px; /* Sesuaikan tinggi sesuai kebutuhan */
    }
      
	#carouselExample {
		width: 100vw; /* Full width */
		max-width: 100%; /* Hindari overflow */
	}

	#carouselExample .carousel-inner img {
		width: 100%; /* Pastikan gambar memenuhi lebar slider */
		height: auto; /* Menjaga rasio gambar */
	}
    
    .row-centered {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }
    </style>
@endpush

@section('content')
<!-- Hero section Start -->
<section class="hero-section bg-primary" id="home">
	<div class="container-fluid">
		
		<div class="row justify-content-end">
			
			{{-- <div class="col-md-12">
				<div class="hero-wrapper pb-3">
					<h1 class="text-center hero-title text-white mb-4">Selamat Datang di Website Resmi {{ env('APP_NAME') }}</h1>
					<div class="mt-0 text-center">
						<h5 class="text-white">{{ env('APP_DESC') }}</h5>
					</div>
				</div>
			</div> --}}
		</div>

		{{-- <div class="row">
			<div class="col-md-12">
				<!-- START carousel-->
				<div id="carouselExample" class="mb-5 carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						@foreach($dataview->slider as $key => $value)
						<li data-target="#carouselExample" data-slide-to="{{ $key }}" class="{{ $key=='0' ? 'active' : '' }}"></li>
						@endforeach
					</ol>
					<div class="carousel-inner" role="listbox">
						@foreach($dataview->slider as $key => $value)
						<div class="carousel-item {{ $key=='0' ? 'active' : '' }}">
							<a href="{{ $value->link }}"><img class="d-block img-fluid" src="{{ asset($value->file_gambar) }}" alt="Slide {{ ($key+1) }}" /></a>
						</div>
						@endforeach
					</div>
				</div>
				<!-- END carousel-->
			</div>
		</div> --}}
		
	</div>
</section>

<div id="carouselExample" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		@foreach($dataview->slider as $key => $value)
		<li data-target="#carouselExample" data-slide-to="{{ $key }}" class="{{ $key=='0' ? 'active' : '' }}"></li>
		@endforeach
	</ol>
	<div class="carousel-inner" role="listbox">
		@foreach($dataview->slider as $key => $value)
		<div class="carousel-item {{ $key=='0' ? 'active' : '' }}">
			<a href="{{ $value->link }}"><img class="d-block img-fluid" src="{{ url($value->file_gambar) }}" alt="Slide {{ ($key+1) }}" /></a>
		</div>
		@endforeach
	</div>
</div>

<!-- About Section Start -->
<section class="section about-section" id="about">
    <div class="container">
        <div class="row align-items-center">
            <!-- Image Column -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="about-image-wrapper">
                    <div class="image-frame">
                        <img src="{{ url($dataview->tentang->file_gambar) }}" alt="Tentang Kami" class="about-img img-fluid">
                    </div>
                    {{-- <div class="experience-badge">
                        <span class="years">5+</span>
                        <span class="label">Tahun Pengalaman</span>
                    </div> --}}
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-title mb-4">
                        <span class="section-label">Tentang Kami</span>
                        <h2 class="title mb-3">Mengenal Lebih Dekat <span class="text-highlight">Kop Kita</span></h2>
                        <div class="divider"></div>
                    </div>
                    
                  <style>

                        .justified-text {
                            text-align: justify;
                            text-justify: inter-word;
                            hyphens: auto;
                            word-wrap: break-word;
                            line-height: 1.6; 
                        }
                        

                        @supports (hyphens: auto) {
                            .justified-text {
                                hyphens: auto;
                            }
                        }
                    </style>

                    <div class="about-text mb-5">
                        <p class="lead justified-text">{!! getExcerpt($dataview->tentang->isi, 70) !!}</p>
                    </div>
                    
                    <div class="about-cta">
                        <a href="{{ url('tentang') }}" class="btn btn-primary me-3">
                            Selengkapnya 
                            <i class="mdi mdi-arrow-right ms-2"></i>
                        </a>
                        <a href="{{ url('/kontak') }}" class="btn btn-outline-primary">
                            <i class="mdi mdi-phone me-2"></i>Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->


<script>
    // Animation on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const aboutSection = document.querySelector('.about-section');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.querySelector('.image-frame').style.transform = 'perspective(1000px) rotateY(-5deg)';
                    entry.target.querySelector('.experience-badge').style.animation = 'fadeInUp 0.8s ease-out';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        if (aboutSection) {
            observer.observe(aboutSection);
        }
        
        // Add hover effect for buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
            });
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
<!-- Features start -->
<section class="section bg-light" id="layanan" style="padding-top: 40px; padding-bottom: 80px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <div class="section-title-wrapper">
                        <h3 class="title mb-3 animate__animated animate__fadeInDown">Produk Kami</h3>
                        <div class="title-border animate__animated animate__fadeIn"></div>
                        <p class="text-muted mt-3 animate__animated animate__fadeIn animate__delay-1s" style="text-align: justify;">Solusi inovatif untuk kebutuhan teknologi Anda! Kami menghadirkan produk terbaik untuk mendukung kemajuan bisnis dan organisasi Anda</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        
        <div class="row g-4">
            @foreach ($dataview->layanan as $item)
                <div class="col-xl-4 col-md-6">
                    <div class="card service-card h-100 border-0 animate__animated animate__fadeInUp" data-animation-delay="{{ $loop->index * 0.1 }}s">
                        <div class="card-body p-4">
                            <div class="media align-items-center">
                                <!-- Ikon Layanan -->
                                <div class="me-4 icon-wrapper">
                                    @if($item->nama_layanan == 'Simpanan')
                                        <i class="fas fa-wallet fa-2x text-primary"></i>
                                    @elseif($item->nama_layanan == 'Pinjaman')
                                        <i class="fas fa-hand-holding-usd fa-2x text-success"></i>
                                    @elseif($item->nama_layanan == 'UKM')
                                        <i class="fas fa-store fa-2x text-warning"></i>
                                    @elseif(!empty($item->icon))
                                        <div class="custom-icon">{!! $item->icon !!}</div>
                                    @else
                                        <i class="fas fa-circle-notch fa-2x text-info"></i>
                                    @endif
                                </div>

                                <!-- Konten Layanan -->
                                <div class="media-body">
                                    <h5 class="font-16 mb-2 service-title">{{ $item->nama_layanan }}</h5>
                                    <p class="text-muted mb-3 service-desc" style="text-align: justify;">{{ $item->deskripsi }}</p>
                                </div>
                            </div>
                            
                        <!-- Tombol Platform -->
                        <div class="d-grid mt-3">
                            <a href="{{ $item->link_url }}" target="_blank" class="btn btn-sm btn-hover-scale 
                                @if($item->nama_layanan == 'Simpanan') btn-outline-primary
                                @elseif($item->nama_layanan == 'Pinjaman') btn-outline-success
                                @else btn-outline-warning
                                @endif">
                                Selengkapnya <i class="mdi mdi-arrow-right ms-1 transition-all"></i>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- end container-fluid -->
</section>
<!-- Features end -->

<style>
    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, 
            @if($item->nama_layanan == 'Simpanan') #10b981, #34d399
            @elseif($item->nama_layanan == 'Pinjaman') #3b82f6, #60a5fa
            @else #f59e0b, #fbbf24
            @endif);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s ease;
    }
    
    .service-card:hover::before {
        transform: scaleX(1);
    }
    
    /* Add text justification for all paragraphs */
    .service-desc, .text-muted {
        text-align: justify;
        text-justify: inter-word;
    }
</style>

<script>
    // Initialize animations when element is in viewport
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__fadeInUp');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        
        document.querySelectorAll('.service-card').forEach(card => {
            observer.observe(card);
        });
        
        // Animate title border
        const titleBorder = document.querySelector('.title-border');
        if (titleBorder) {
            setTimeout(() => {
                titleBorder.style.opacity = '1';
                titleBorder.style.transform = 'translateY(0)';
            }, 500);
        }
    });
</script>

<!-- Pricing Start -->
{{-- <section class="section" id="pricing" style="padding-top: 40px;">
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
								{{-- <img src="{{ url($item->file_foto) }}" class="img-fluid p-3">
								<div class="plan-duration text-muted">{{ $item->nama }}</div>
								<small>
									<i class="mdi mdi-bag-checked mr-1"></i> {{ $item->bidang }}
								</small>
							</div>

							<div class="plan-listing p-2"> --}}
							{{-- <div class="plan-listing p-4 mt-3"> --}}
								{{-- <p><i class="mdi mdi-bag-checked mr-1"></i> {{ $item->bidang }}</p>
								<p><i class="mdi mdi-update mr-1"></i> Free Updates</p>
								<p><i class="mdi mdi-upload-network-outline mr-1"></i> 3 Domain</p>
								<p><i class="mdi mdi-calendar-repeat mr-1"></i> Monthly updates</p>
								<p class="mb-0"><i class="mdi mdi-alarm-check mr-1"></i> 24x7 Support</p> --}}
							{{-- </div> --}}
							{{-- <div class="text-center my-3">
								<a href="#" class="btn btn-primary">Purchase Now</a>
							</div> --}}
						{{-- </div>
					</div>

					@endforeach
				</div>
			</div>
		</div> --}}
		<!-- end row -->
	{{-- </div>
	</div> --}}
	<!-- end container-fluid -->
{{-- </section>  --}}
<!-- Pricing end -->

<!-- Elegant Partners Section -->
<section class="section partner-section bg-light pt-7 pb-7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
									<div class="text-center pt-4 mb-4">
					<h3 class="title">Mitra Bisnis Kami</h3>
                    {{-- <h2 class="section-title mb-3">Mitra <span class="text-primary">Bisnis</span> Kami</h2> --}}
                    <p class="section-subtitle mx-auto">Bersama mitra terpercaya, {{ env('APP_NAME') }} menghadirkan inovasi teknologi yang mengubah lanskap industri.</p>
                </div>
            </div>
        </div>

        <div class="position-relative">
            <div id="partnerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
                <div class="carousel-inner">
                    @foreach ($dataview->mitra->chunk(3) as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="row gx-4 gy-4 justify-content-center">
                            @foreach ($chunk as $item)
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="partner-item">
                                    <div class="partner-logo-wrapper">
                                        <img src="{{ url($item->file_logo) }}" alt="{{ $item->nama }}" class="partner-logo">
                                        <div class="partner-info">
                                            <span class="partner-name">{{ $item->nama }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Carousel Indicators (Dots) -->
                <div class="carousel-indicators-wrapper mt-4">
                    <div class="carousel-indicators">
                        @foreach ($dataview->mitra->chunk(3) as $chunkIndex => $chunk)
                        <button type="button" data-bs-target="#partnerCarousel" 
                                data-bs-slide-to="{{ $chunkIndex }}" 
                                class="{{ $chunkIndex == 0 ? 'active' : '' }}" 
                                aria-current="{{ $chunkIndex == 0 ? 'true' : 'false' }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Faq start -->
<section class="section" id="faqs" style="padding-top: 40px; padding-bottom: 40px;">
	<div class="container-fluid">
		{{-- <div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="text-center mb-5">
					<h3 class="title">Berita</h3>
					<p class="text-muted">Pusat Kabar & Kegiatan KONI Kota Dumai</p>
				</div>
			</div>
		</div> --}}
		<!-- end row -->

		<div class="row">
			<div class="col-lg-9">
				
				<div class="text-center mb-5">
					<h3 class="title">Blog & Artikel</h3>
					{{-- <p class="text-muted">Pusat Informasi & Kegiatan {{ getTitle() }}</p> --}}
				</div>

				<div class="row">
				    @foreach($dataview->artikel_terbaru as $artikel)
					<div class="col-lg-4">
						<div class="card">
							<img class="card-img-top img-fluid cover-berita" src="{{ url($artikel->file_gambar) }}" alt="{{ $artikel->judul }}">
							<div class="card-body">
								<a href="{{ url('artikel/'.$artikel->id_artikel.'/'.generateSlug($artikel->judul)) }}"><h5 class="card-title">{{ $artikel->judul }}</h5></a>
								<p class="card-text">
									<small class="text-muted">{{ tanggalIndonesia($artikel->tanggal, true) }}</small>
								</p>
								<p class="card-text">{!! getExcerpt($artikel->isi, 20) !!}</p>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="text-center">
					<a href="{{ url('artikel') }}" class="mt-4 btn btn-primary">Semua Artikel <i class="mdi mdi-arrow-right ml-2"></i></a>
				</div>
			</div>

			<div class="col-lg-3">
				
				<div class="text-center mb-5">
					<h3 class="title">Event</h3>
					<p class="text-muted">Latest event kami</p>
				</div>

                <a href="{{ url('event/'.$dataview->event_terkini->id_event.'/'.generateSlug($dataview->event_terkini->nama_kegiatan)) }}">
				<div class="card">
					<img class="card-img-top img-fluid" src="{{ url($dataview->event_terkini->file_gambar) }}" alt="{{ $dataview->event_terkini->judul }}">
					<div class="card-body">
						<h5 class="card-title">{{ $dataview->event_terkini->judul }}</h5>
						<p class="card-text text-muted">{!! getExcerpt($dataview->event_terkini->deskripsi, 20) !!}</p>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><i class="mdi mdi-calendar font-18 mr-2 align-middle"></i> <b>{{ tanggalIndonesia($dataview->event_terkini->tanggal) }}</b></li>
						<li class="list-group-item"><i class="mdi mdi-map-marker-outline font-18 mr-2 align-middle"></i> {{ $dataview->event_terkini->lokasi }}</li>
					</ul>
					<div class="card-body">
						<a href="{{ $dataview->event_terkini->link }}" target="_blank" class="card-link"><i class="mdi mdi-web font-18 mr-2 align-middle"></i> {{ $dataview->event_terkini->nama_link }}</a>
					</div>
				</div>
				</a>
				
				<div class="text-center">
					<a href="{{ url('event') }}" class="btn btn-primary btn-sm">Semua Event <i class="mdi mdi-arrow-right ml-2"></i></a>
				</div>

			</div>
		</div>
		<!-- end row -->
		
		
	</div>
	<!-- end container-fluid -->
</section>
<!-- Faq end -->

<section class="section bg-light" style="padding-top: 40px; padding-bottom: 40px;">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="text-center mb-4">
					<h3 class="title">Portofolio</h3>
					<p class="text-muted">&nbsp;</p>
				</div>
			</div>
		</div>
		
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
        							<img src="{{ url($item->file_icon) }}" class="mt-2" height="60">
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
                                                <img src="{{ url($item->file_icon) }}" height="150">
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
    			
    			<div class="text-center">
					<a href="{{ url('portofolio') }}" class="mt-4 btn btn-primary">Semua Portofolio <i class="mdi mdi-arrow-right ml-2"></i></a>
				</div>
    		</div>
    	</div>
	</div>
</section>

@endsection

@push('script')
<!-- Feather Icons & Bootstrap JS -->
<script src="http://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        feather.replace();
    });
</script>
@endpush