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
        <h6 class="text-white title">
  <a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a>
  <i class="mdi mdi-chevron-right"></i> <a href="{{ url('/tentang') }}" class="text-white">Tentang Kami</a>
  <i class="mdi mdi-chevron-right"></i> Sejarah
</h6>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Hero section End -->

<!-- Sejarah & Sidebar Section -->
<section class="section py-5" style="background: #f8f9fa;">
  <div class="container">
    <div class="row g-4 align-items-stretch">
      <!-- Kolom Kiri: Sejarah -->
      <div class="col-lg-8">
        <div class="p-4 shadow-lg rounded-4 h-100" style="background: linear-gradient(to bottom right, #ffffff, #fdf7e3); border-left: 8px solid #f4b400;">
          <h3 class="mb-4 fw-bold text-dark">{{ $dataview->tentang->judul }}</h3>
          <hr>

          @if($dataview->tentang->file_gambar)
          <div class="text-center mb-4">
            <img src="{{ asset($dataview->tentang->file_gambar) }}" class="img-fluid rounded shadow-sm"
              style="max-width: 300px; cursor: pointer;" alt="Sejarah Perusahaan"
              data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImageModal(this)">
          </div>
          @endif

          <div class="text-dark" style="text-align: justify; font-size: 1rem;">
            {!! $dataview->tentang->isi !!}
          </div>

          <div class="mt-5">
            <h4 class="text-center text-primary fw-bold mb-4">Timeline Sejarah Perusahaan</h4>
            <div class="timeline-container">
              @foreach($dataview->sejarahs as $sejarah)
              <div class="timeline-item">
                <div class="timeline-year-badge">{{ $sejarah->tahun }}</div>
                <div class="timeline-card">
                  <div class="card shadow-sm border-0 h-100">
                    @if($sejarah->file_gambar)
                    <img src="{{ asset($sejarah->file_gambar) }}" class="card-img-top" alt="{{ $sejarah->judul }}" style="max-height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                      <h5 class="card-title fw-bold text-primary">{{ $sejarah->judul }}</h5>
                      <div class="card-text" style="word-wrap: break-word;">
                        {!! nl2br(e($sejarah->deskripsi)) !!}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
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

        <!-- VISI -->
        <div class="p-4 shadow-lg rounded-4 mb-4" style="background: linear-gradient(to bottom right, #ffffff, #e7f5ff);">
          <h4 class="fw-bold text-primary mb-3">Visi</h4>
          @foreach($dataview->visi as $visi)
            <p class="text-dark">"{{ $visi->isi }}"</p>
          @endforeach
        </div>

        <!-- MISI -->
        <div class="p-4 shadow-lg rounded-4 mb-4" style="background: linear-gradient(to bottom right, #ffffff, #e2ffe4);">
          <h4 class="fw-bold text-primary mb-3">Misi</h4>
          <ul class="list-group list-group-flush">
            @foreach($dataview->misi as $index => $misi)
              <li class="list-group-item">{{ $index + 1 }}. {{ $misi->isi }}</li>
            @endforeach
          </ul>
        </div>
      
        <div class="p-4 shadow-lg rounded-4" style="background: linear-gradient(to bottom right, #ffffff, #ffe9ec);">
          <h5 class="card-title text-danger">Informasi Singkat</h5>
          <p class="card-text">Kop Kita | Koperasi Merah Putih Digital untuk Desa dan Kelurahan</p>
          <a href="{{ url('/kontak') }}" class="btn btn-danger btn-sm mt-2">
            <i class="mdi mdi-email-outline"></i> Hubungi Kami
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 text-center">
        <img src="" id="modalImage" class="img-fluid rounded shadow" alt="Preview Gambar">
      </div>
    </div>
  </div>
</div>

<style>
  .timeline-container {
    position: relative;
    max-width: 100%;
    padding-left: 70px;
    margin-top: 30px;
  }
  
  .timeline-container::before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 35px;
    width: 3px;
    background: #f4b400;
    border-radius: 3px;
  }
  
  .timeline-item {
    position: relative;
    margin-bottom: 40px;
  }
  
  .timeline-year-badge {
    position: absolute;
    left: -70px;
    top: 0;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: #f4b400;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
    z-index: 1;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }
  
  .timeline-card {
    margin-left: 30px;
    transition: transform 0.3s ease;
  }
  
  .timeline-card:hover {
    transform: translateY(-5px);
  }
  
  .timeline-card .card {
    border-radius: 10px;
    overflow: hidden;
    border: none;
  }
  
  .timeline-card .card-body {
    padding: 1.5rem;
  }
  
  .timeline-card .card-title {
    font-size: 1.1rem;
    margin-bottom: 0.75rem;
  }
  
  .timeline-card .card-text {
    font-size: 0.95rem;
    line-height: 1.6;
  }

  /* Styles for Layanan section */
  .list-group-item {
    border-left: 3px solid transparent;
    transition: all 0.3s ease;
  }
  
  .list-group-item:hover {
    border-left-color: #f4b400;
    background-color: #f8f9fa;
  }
  
  .hover-shadow-sm:hover {
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
  }
  
  @media (max-width: 768px) {
    .timeline-container {
      padding-left: 60px;
    }
    
    .timeline-year-badge {
      width: 50px;
      height: 50px;
      left: -60px;
      font-size: 1rem;
    }
    
    .timeline-card {
      margin-left: 20px;
    }
  }
</style>
@endsection

@push('script')
<script>
  function showImageModal(imgElement) {
    document.getElementById('modalImage').src = imgElement.src;
  }

  document.addEventListener('DOMContentLoaded', function() {
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    function animateTimeline() {
      const triggerBottom = window.innerHeight * 0.8;
      
      timelineItems.forEach((item, index) => {
        const itemTop = item.getBoundingClientRect().top;
        
        if (itemTop < triggerBottom) {
          item.style.opacity = '1';
          item.style.transform = 'translateX(0)';
          item.style.transitionDelay = `${index * 0.1}s`;
        }
      });
    }
    
    // Set initial state
    timelineItems.forEach(item => {
      item.style.opacity = '0';
      item.style.transform = 'translateX(-20px)';
      item.style.transition = 'all 0.5s ease-out';
    });
    
    window.addEventListener('scroll', animateTimeline);
    animateTimeline(); // Run once on load
  });
</script>
@endpush