@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Daftar Manfaat dari L|KITA Bengkalis" />
<meta property="og:description" content="Lihat daftar manfaat program kami" />
<meta property="og:image" content="{{ asset('themes/front/') }}/images/logo-hitam.png" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />
@endpush

@push('head')
<style>
    /* Card Section Styling */
    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
        padding: 16px 0;
    }
    
    .card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: none !important;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .card:hover img {
        transform: scale(1.03);
    }
    
    .card-content {
        padding: 16px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .card-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
        font-size: 1.1rem;
        line-height: 1.4;
    }
    
    .card-content p {
        color: #4a5568;
        font-size: 0.9rem;
        margin-bottom: 12px;
        flex-grow: 1;
    }
    
    /* Empty State */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px 20px;
        color: #718096;
    }
    
    .empty-state svg {
        width: 64px;
        height: 64px;
        margin-bottom: 16px;
        opacity: 0.7;
    }
    
    /* Vision & Mission Styling */
    .vision-mission-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }
    
    .vision-card, .mission-card {
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    .vision-card {
        background: linear-gradient(to bottom right, #ffffff, #e7f5ff);
        border-left: 4px solid #247ba0;
    }
    
    .mission-card {
        background: linear-gradient(to bottom right, #ffffff, #e2ffe4);
        border-left: 4px solid #28a745;
    }
    
    .vision-title, .mission-title {
        font-weight: 700;
        margin-bottom: 16px;
        color: #247ba0;
    }
    
    .mission-title {
        color: #28a745;
    }
    
    .mission-list {
        list-style-type: none;
        padding-left: 0;
    }
    
    .mission-list li {
        padding: 8px 0;
        position: relative;
        padding-left: 28px;
    }
    
    .mission-list li:before {
        content: counter(item) ".";
        counter-increment: item;
        position: absolute;
        left: 0;
        color: #28a745;
        font-weight: bold;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 767px) {
        .cards-container {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 16px;
        }
        
        .card img {
            height: 160px;
        }
        
        .vision-mission-container {
            grid-template-columns: 1fr;
        }
    }
    
    @media (min-width: 992px) {
        .cards-container {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }
        
        .card img {
            height: 200px;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero section Start -->
<section class="hero-section bg-primary" id="home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <hr style="border: 1px solid white;">
                <div class="hero-wrapper pb-3">
                    <h6 class="text-white title">
                        <a href="{{ url('/') }}" class="text-white">
                            <i class="mdi mdi-home"></i> Beranda
                        </a> 
                        <i class="mdi mdi-chevron-right"></i> Manfaat
                    </h6>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero section End -->

<section class="section">
    <div class="container-fluid">
        <!-- Vision & Mission Section -->
        <div class="vision-mission-container">
            <!-- Vision Card -->
            <div class="vision-card">
                <h3 class="vision-title">Visi</h3>
                @foreach($dataview->visi as $visi)
                    <p class="mb-0">"{{ $visi->isi }}"</p>
                @endforeach
            </div>
            
            <!-- Mission Card -->
            <div class="mission-card">
                <h3 class="mission-title">Misi</h3>
                <ol class="mission-list" style="counter-reset: item;">
                    @foreach($dataview->misi as $misi)
                        <li>{{ $misi->isi }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
        
        <!-- Benefits Section -->
        <div class="section-header mb-5 text-center">
            <h3 class="display-5" style="color: #247ba0; position: relative; display: inline-block;">
                <span style="background-color: #f8f9fa; padding: 0 20px; position: relative; z-index: 2;">13 Manfaat Koperasi Desa/Kelurahan Merah Putih Sebagai Pusat Produksi & Distribusi</span>
                <span style="position: absolute; bottom: 10px; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, transparent, #ffd166, transparent); z-index: 1;"></span>
            </h3>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <section class="cards-container" aria-label="Daftar Manfaat">
                    @forelse ($dataview->manfaat as $item)
                    <article class="card" tabindex="0">
                        @if($item->img)
                        <img src="{{ asset($item->img) }}" alt="{{ $item->judul }}" class="img-fluid" loading="lazy" />
                        @else
                        <img src="{{ asset('assets/front/images/default-image.png') }}" alt="Default Image" class="img-fluid" loading="lazy" />
                        @endif
                        <div class="card-content">
                            <p class="card-title fw-bold">{{ $item->judul }}</p>
                            <p class="text-muted">{{ Str::limit($item->deskripsi, 120) }}</p>
                        </div>
                    </article>
                    @empty
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h5>Tidak ada data manfaat tersedia</h5>
                        <p class="text-muted">Silakan kembali lagi nanti</p>
                    </div>
                    @endforelse
                </section>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
@endpush