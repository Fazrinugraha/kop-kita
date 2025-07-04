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

    .about-image-wrapper {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .image-frame {
        width: 100%;
        max-width: 400px; /* Ukuran default */
        border-radius: 12px;
        overflow: hidden;
    }

    .about-img {
        width: 100%;
        height: auto;
        object-fit: cover;
        display: block;
    }

    @media (max-width: 768px) {
        .image-frame {
            max-width: 280px; /* Ukuran lebih kecil untuk HP */
        }
    }

    @media (max-width: 480px) {
        .image-frame {
            max-width: 220px; /* Ukuran paling kecil untuk layar kecil */
        }
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
<!-- Features start -->
<section class="section bg-light" id="layanan" style="padding-top: 40px; padding-bottom: 80px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <div class="section-title-wrapper">
                        <h3 class="title mb-3 animate__animated animate__fadeInDown">Produk Kami</h3>
                        <div class="title-border animate__animated animate__fadeIn"></div>
                        <p class="text-muted mt-3 animate__animated animate__fadeIn animate__delay-1s" style="text-align: justify;">
                            Solusi inovatif untuk kebutuhan teknologi Anda! Kami menghadirkan produk terbaik untuk mendukung kemajuan bisnis dan organisasi Anda
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($dataview->layanan as $item)
                <div class="col-xl-4 col-md-6">
                    <div class="card service-card h-100 border-0 animate__animated animate__fadeInUp" data-animation-delay="{{ $loop->index * 0.1 }}s">
                        <div class="card-body p-4">
                            <div class="media align-items-center">
                                <!-- Ikon Layanan -->
                                <div class="me-4 icon-wrapper">
                                    @php
                                        $iconMap = [
                                            'Website Profil Koperasi' => 'fas fa-globe text-primary',
                                            'Aplikasi Simpan Pinjam' => 'fas fa-hand-holding-dollar text-success',
                                            'Aplikasi Sembako' => 'fas fa-shopping-basket text-warning',
                                            'Aplikasi Apotik' => 'fas fa-prescription-bottle-alt text-danger',
                                            'Aplikasi UMKM (eCommerce)' => 'fas fa-store text-info',
                                            'Aplikasi Gudang Koperasi' => 'fas fa-warehouse text-secondary',
                                            'Aplikasi Logistik' => 'fas fa-truck-moving text-dark',
                                            'Integrasi Sistem' => 'fas fa-project-diagram text-indigo',
                                        ];
                                        $iconClass = $iconMap[$item->nama_layanan] ?? 'fas fa-puzzle-piece text-muted';
                                    @endphp
                                    <i class="{{ $iconClass }} fa-2x"></i>
                                </div>

                                <!-- Konten Layanan -->
                                <div class="media-body">
                                    <h5 class="font-16 mb-2 service-title">{{ $item->nama_layanan }}</h5>
                                    <p class="text-muted mb-3 service-desc" style="text-align: justify;">{{ $item->deskripsi }}</p>
                                </div>
                            </div>

                            <!-- Tombol Platform -->
                            <div class="d-grid mt-3">
                                <a href="{{ $item->link_url }}" target="_blank" class="btn btn-sm btn-hover-scale btn-outline-primary">
                                    Selengkapnya <i class="mdi mdi-arrow-right ms-1 transition-all"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Features end -->

<!-- Styles -->
<style>
    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #FFD700, #FFB800);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s ease;
    }

    .service-card:hover::before {
        transform: scaleX(1);
    }

    .service-desc, .text-muted {
        text-align: justify;
        text-justify: inter-word;
    }

    .icon-wrapper {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__fadeInUp');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.service-card').forEach(card => observer.observe(card));

        const titleBorder = document.querySelector('.title-border');
        if (titleBorder) {
            setTimeout(() => {
                titleBorder.style.opacity = '1';
                titleBorder.style.transform = 'translateY(0)';
            }, 500);
        }
    });
</script>

<!-- Font Awesome (jika belum ada) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


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
<section class="tabs-block py-5" style="background-color: #f1f5f9;">






    <div class="container">

        <!-- Tabs -->
        <ul class="tabs-block__list nav nav-tabs justify-content-center mb-4">
            <li class="nav-item">
                <a class="nav-link active" href="#struktur-tab" data-toggle="tab">
                    <i class="la la-sitemap"></i> Struktur Organisasi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#foto-tab" data-toggle="tab">
                    <i class="la la-photo"></i> Foto
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#video-tab" data-toggle="tab">
                    <i class="la la-play"></i> Video
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">

            <!-- TAB 1: Struktur Organisasi -->
            <div class="tab-pane fade show active" id="struktur-tab">
                <h5 class="text-primary mb-3 fw-bold">Dewan Pengawas</h5>
                <div class="owl-carousel owl-theme mb-4" id="carousel-pengawas">
                    @forelse($dataview->pengawas as $item)
                        <div class="item">
                            <div class="card team-card text-center border-0 shadow-sm h-100 p-3">
                                <img src="{{ asset($item->file_foto) }}" alt="{{ $item->bidang }}" class="rounded-circle mx-auto mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                                <h6 class="fw-bold mb-1 text-uppercase">{{ $item->nama }}</h6>
                                <p class="text-muted small text-center">{{ $item->bidang }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center w-100 py-5">
                            <p class="text-muted">Belum ada data Dewan Pengawas.</p>
                        </div>
                    @endforelse
                </div>

                <h5 class="text-primary mb-3 fw-bold">Dewan Pengurus</h5>
                <div class="owl-carousel owl-theme" id="carousel-pengurus">
                    @forelse($dataview->pengurus as $item)
                        <div class="item">
                            <div class="card team-card text-center border-0 shadow-sm h-100 p-3">
                                <img src="{{ asset($item->file_foto) }}" alt="{{ $item->bidang }}" class="rounded-circle mx-auto mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                                <h6 class="fw-bold mb-1 text-uppercase">{{ $item->nama }}</h6>
                                <p class="text-muted small text-center">{{ $item->bidang }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center w-100 py-5">
                            <p class="text-muted">Belum ada data Dewan Pengurus.</p>
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-4">
                    <a class="text-btn" href="{{ route('team') }}">Lihat Struktur Lengkap</a>
                </div>
            </div>

            <!-- TAB 2: Galeri Foto -->
            <div class="tab-pane fade" id="foto-tab">
                <div class="owl-carousel owl-theme" id="carousel-foto">
                    @forelse($dataview->foto as $d)
                        @php
                            $mediaPertama = isset($d->foto) ? $d->foto->first() : null;
                        @endphp

                        @if($mediaPertama)
                            <div class="item">
                                <div class="photo-post text-center">
                                    <div class="image-wrapper">
                                        <img src="{{ asset($mediaPertama->file_path) }}" alt="{{ $d->judul }}">
                                    </div>
                                    <p class="text-muted small text-center mt-2 mb-1">
                                        <i class="fa fa-calendar me-1"></i> {{ \Carbon\Carbon::parse($d->tanggal)->format('d M Y') }}
                                    </p>
                                    <h6 class="mb-0">{{ $d->judul }}</h6>
                                </div>

                            </div>
                        @endif
                    @empty
                        <div class="text-center w-100 py-5">
                            <p class="text-muted">Belum ada foto yang tersedia.</p>
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('dokumentasi') }}" class="text-btn">Lihat Semua Foto</a>
                </div>
            </div>

            <!-- TAB 3: Galeri Video -->
            <div class="tab-pane fade" id="video-tab">
                <div class="owl-carousel owl-theme" id="carousel-video">
                    @foreach($dataview->videoList as $video)
                        <div class="item">
                            <div class="card border-0 shadow-sm text-center p-3">
                                <div class="embed-responsive embed-responsive-16by9 rounded mb-2">
                                    @if($video->tipe === 'youtube')
                                        <div class="youtube-wrapper position-relative">
                                            <div id="carousel-player-{{ $video->id }}" style="width:100%; height:315px;"></div>
                                            <a href="{{ $video->media_path }}" target="_blank"
                                                class="youtube-overlay-btn d-none"
                                                id="carousel-overlay-{{ $video->id }}"
                                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                                    background: rgba(0,0,0,0.7); color: white; padding: 6px 12px; border-radius: 4px; font-size: 0.875rem; text-decoration: none;">
                                                Tonton Selengkapnya di YouTube
                                            </a>
                                        </div>

                                    @else
                                        <video class="embed-responsive-item" controls>
                                            <source src="{{ asset($video->media_path) }}" type="video/mp4">
                                            Browser tidak mendukung video.
                                        </video>
                                    @endif
                                </div>
                                <small class="text-muted text-center">
                                    <i class="fa fa-calendar me-1"></i> {{ tanggal_indo($video->dokumentasi->tanggal) }}
                                </small>
                                <h6 class="mt-1">{{ $video->dokumentasi->judul }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('dokumentasi') }}" class="text-btn">Lihat Semua Video</a>
                </div>
            </div>

        </div>
    </div>
</section>







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

{{-- <section class="section bg-light" style="padding-top: 40px; padding-bottom: 40px;">
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
</section> --}}

@endsection

@push('script')
<!-- Feather Icons & Bootstrap JS -->
<script src="http://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        feather.replace();
    });
</script>
@push('script')
<script>
    $(document).ready(function() {
        // Struktur Organisasi (boleh loop)
        $('#carousel-pengawas').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: { items: 1 },
                576: { items: 2 },
                992: { items: 3 },
                1200: { items: 4 }
            }
        });

        $('#carousel-pengurus').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: { items: 1 },
                576: { items: 2 },
                992: { items: 3 },
                1200: { items: 4 }
            }
        });

        // Galeri Foto
        $('#carousel-foto').owlCarousel({
            loop: {{ count($dataview->foto) > 3 ? 'true' : 'false' }},
            margin: 15,
            nav: true,
            dots: true,
            responsive: {
                0: { items: 1 },
                576: { items: 2 },
                992: { items: 3 }
            }
        });

        // Galeri Video
        $('#carousel-video').owlCarousel({
            loop: {{ count($dataview->videoList) > 3 ? 'true' : 'false' }},
            margin: 15,
            nav: true,
            dots: true,
            responsive: {
                0: { items: 1 },
                576: { items: 2 },
                992: { items: 3 }
            }
        });
    });
</script>
<script src="https://www.youtube.com/iframe_api"></script>
<script>
    var carouselPlayers = {};

    // Tunggu API siap
    function onYouTubeIframeAPIReady() {
        // Kita tunggu sampai Owl Carousel selesai render, lalu jalankan inisialisasi player
        initYouTubeCarouselPlayers();
    }

    function initYouTubeCarouselPlayers() {
        // Jalankan hanya setelah DOM siap
        $(document).ready(function () {
            @foreach($dataview->videoList as $video)
                @if($video->tipe === 'youtube')
                    if (document.getElementById("carousel-player-{{ $video->id }}")) {
                        carouselPlayers[{{ $video->id }}] = new YT.Player('carousel-player-{{ $video->id }}', {
                            videoId: "{{ getYouTubeId($video->media_path) }}",
                            playerVars: {
                                rel: 0,
                                controls: 1,
                                start: 0,
                                end: 10
                            },
                            events: {
                                'onStateChange': function (event) {
                                    if (event.data === YT.PlayerState.ENDED) {
                                        document.getElementById("carousel-overlay-{{ $video->id }}").classList.remove("d-none");
                                    }
                                }
                            }
                        });
                    }
                @endif
            @endforeach
        });
    }
</script>


@endpush



@endpush
