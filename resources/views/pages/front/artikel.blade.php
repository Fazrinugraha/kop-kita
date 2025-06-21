@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Daftar Artikel L|KITA Bengkalis" />
<meta property="og:description" content="Lihat daftar artikel kami" />
<meta property="og:image" content="{{ asset('assets/front/') }}/images/logo-hitam.png" />
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
                        <h6 class="text-white title"><a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> <i class="mdi mdi-chevron-right"></i> Blog / Artikel</h6>
                    </div>
                </div>
            </div>

        </div>
    </section>
   <!-- Hero section End -->

<section class="section" style="padding-top: 40px; padding-bottom: 40px; background-color: #f8f9fa;">
    <div class="container-fluid">
        
        <div class="section-header mb-5 text-center">
            <h3 class="display-5" style="color: #247ba0; position: relative; display: inline-block;">
                <span style="background-color: #f8f9fa; padding: 0 20px; position: relative; z-index: 2;">Blog & Artikel</span>
                <span style="position: absolute; bottom: 10px; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, transparent, #ffd166, transparent); z-index: 1;"></span>
            </h3>
            <p class="text-muted">Temukan informasi dan artikel terbaru kami</p>
        </div>

        <div class="row justify-content-start">
            <div class="col-lg-8">
                @foreach($dataview->artikel as $artikel)
                <div class="card mb-4 article-card" style="border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: transform 0.3s;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <a href="{{ url('artikel/'.$artikel->id_artikel.'/'.generateSlug($artikel->judul)) }}">
                                <div class="image-container" style="height: 100%; min-height: 200px; overflow: hidden;">
                                    <img class="img-fluid h-100 w-100" src="{{ asset($artikel->file_gambar) }}" alt="{{ $artikel->judul }}" style="object-fit: cover; transition: transform 0.5s;">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body" style="background-color: white; height: 100%;">
                                <div class="d-flex flex-wrap justify-content-between align-items-center mb-2">
                                    <span class="badge mb-2 mb-md-0" style="background-color: #ffd166; color: #333; font-weight: 500;">
                                        <i class="mdi mdi-calendar mr-1"></i> {{ tanggalIndonesia($artikel->tanggal, true) }}
                                    </span>
                                    {{-- <span class="text-muted small"><i class="mdi mdi-eye-outline mr-1"></i> {{ formatViews($artikel->views) }} views</span> --}}
                                </div>
                                <a href="{{ url('artikel/'.$artikel->id_artikel.'/'.generateSlug($artikel->judul)) }}" style="text-decoration: none;">
                                    <h5 class="card-title" style="color: #247ba0; font-weight: 600; margin-bottom: 15px;">{{ $artikel->judul }}</h5>
                                </a>
                                <p class="card-text" style="color: #555; margin-bottom: 20px;">{!! getExcerpt($artikel->isi) !!}</p>
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                    <a href="{{ url('artikel/'.$artikel->id_artikel.'/'.generateSlug($artikel->judul)) }}" class="read-more-btn mb-3 mb-md-0" style="background-color: #247ba0; color: white; border: none; padding: 8px 20px; border-radius: 30px; font-weight: 500; transition: all 0.3s; white-space: nowrap;">
                                        Baca Selengkapnya <i class="mdi mdi-arrow-right ml-1"></i>
                                    </a>
                                    <div class="social-share">
                                        <button class="btn btn-sm btn-outline-secondary mr-1 share-btn" data-platform="facebook" data-url="{{ url('artikel/'.$artikel->id_artikel.'/'.generateSlug($artikel->judul)) }}" data-title="{{ $artikel->judul }}">
                                            <i class="mdi mdi-facebook"></i> <span class="d-none d-md-inline">Share</span>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary mr-1 share-btn" data-platform="twitter" data-url="{{ url('artikel/'.$artikel->id_artikel.'/'.generateSlug($artikel->judul)) }}" data-title="{{ $artikel->judul }}">
                                            <i class="mdi mdi-twitter"></i> <span class="d-none d-md-inline">Tweet</span>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary share-btn" data-platform="whatsapp" data-url="{{ url('artikel/'.$artikel->id_artikel.'/'.generateSlug($artikel->judul)) }}" data-title="{{ $artikel->judul }}">
                                            <i class="mdi mdi-whatsapp"></i> <span class="d-none d-md-inline">WhatsApp</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                {{-- <nav aria-label="Page navigation" class="mt-5">
                    <ul class="pagination justify-content-center flex-wrap">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true" style="color: #247ba0;">Sebelumnya</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#" style="background-color: #247ba0; border-color: #247ba0;">1</a></li>
                        <li class="page-item"><a class="page-link" href="#" style="color: #247ba0;">2</a></li>
                        <li class="page-item"><a class="page-link" href="#" style="color: #247ba0;">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" style="color: #247ba0;">Selanjutnya</a>
                        </li>
                    </ul>
                </nav> --}}
            </div>
            
            <div class="col-lg-4">
                <!-- Services Card -->
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
                
                <!-- Newsletter Card -->
                {{-- <div class="card mb-4" style="border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); background: linear-gradient(135deg, #247ba0, #1a659e); color: white;">
                    <div class="card-body text-center" style="padding: 25px;">
                        <div style="width: 60px; height: 60px; background-color: rgba(255, 255, 255, 0.2); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                            <i class="mdi mdi-email-outline" style="font-size: 24px;"></i>
                        </div>
                        <h5 style="font-weight: 600; margin-bottom: 10px;">Berlangganan Newsletter</h5>
                        <p class="small" style="opacity: 0.8;">Dapatkan update terbaru langsung ke email Anda</p>
                        <form class="newsletter-form">
                            <div class="form-group mb-2">
                                <input type="email" class="form-control" placeholder="Alamat Email" required style="border-radius: 30px; border: none; padding: 10px 15px;">
                            </div>
                            <button type="submit" class="btn btn-block" style="background-color: #ffd166; color: #333; font-weight: 500; border-radius: 30px; padding: 10px; border: none;">
                                <span class="submit-text">Subscribe</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>

<style>
    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .article-card:hover .image-container img {
        transform: scale(1.05);
    }
    
    .read-more-btn:hover {
        background-color: #1a659e !important;
        box-shadow: 0 5px 15px rgba(36, 123, 160, 0.3);
        transform: translateY(-2px);
    }
    
    .service-item:hover {
        background-color: #f0f7fb !important;
        transform: translateX(5px);
    }
    
    .page-link:hover {
        color: #1a659e !important;
        background-color: #f0f7fb;
    }
    
    .share-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
    
    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .article-card .row {
            flex-direction: column;
        }
        .article-card .col-md-4 {
            width: 100%;
        }
        .article-card .col-md-8 {
            width: 100%;
        }
        .social-share {
            width: 100%;
            justify-content: flex-start !important;
            margin-top: 10px;
        }
        .card-title {
            font-size: 1.1rem;
        }
    }
</style>

@push('script')
<script>
    // Social sharing functionality
    document.querySelectorAll('.share-btn').forEach(button => {
        button.addEventListener('click', function() {
            const platform = this.getAttribute('data-platform');
            const url = encodeURIComponent(this.getAttribute('data-url'));
            const title = encodeURIComponent(this.getAttribute('data-title'));
            
            let shareUrl;
            
            switch(platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                    break;
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${title}%20${url}`;
                    break;
                default:
                    return;
            }
            
            window.open(shareUrl, '_blank', 'width=600,height=400');
        });
    });

    // Newsletter form submission
    document.querySelectorAll('.newsletter-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const submitText = submitBtn.querySelector('.submit-text');
            const spinner = submitBtn.querySelector('.spinner-border');
            
            // Show loading state
            submitText.classList.add('d-none');
            spinner.classList.remove('d-none');
            submitBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // Hide loading state
                submitText.classList.remove('d-none');
                spinner.classList.add('d-none');
                submitBtn.disabled = false;
                
                // Show success message
                alert('Terima kasih telah berlangganan newsletter kami!');
                this.reset();
            }, 1500);
        });
    });
</script>
@endpush

@endsection