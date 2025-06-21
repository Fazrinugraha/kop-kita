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
            <div id="timelineContainer">
              @foreach($dataview->sejarahs as $sejarah)
              <div class="timeline-event">
                <div class="timeline-content">
                  <div class="timeline-icon">
                    <div class="timeline-year">{{ $sejarah->tahun }}</div>
                  </div>
                  <div class="timeline-details">
                    @if($sejarah->file_gambar)
                    <div class="timeline-image mb-3">
                      <img src="{{ asset($sejarah->file_gambar) }}" alt="{{ $sejarah->judul }}"
                        class="img-fluid rounded shadow-sm">
                    </div>
                    @endif
                    <div class="timeline-text">
                      <h5 class="fw-bold text-primary mb-1">{{ $sejarah->judul }}</h5>
                      <p>{{ $sejarah->deskripsi }}</p>
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
        <div class="p-4 shadow-lg rounded-4 mb-4" style="background: linear-gradient(to bottom right, #ffffff, #e7f5ff);">
          <h4 class="fw-bold text-primary mb-3">Visi</h4>
          <p class="text-dark">"Mewujudkan Lembaga Inovatif dan Progresif dalam Pemberdayaan Masyarakat dan Pendidikan di Kabupaten Bengkalis."</p>
        </div>

        <div class="p-4 shadow-lg rounded-4 mb-4" style="background: linear-gradient(to bottom right, #ffffff, #e2ffe4);">
          <h4 class="fw-bold text-primary mb-3">Misi</h4>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">1. Menyelenggarakan program edukatif dan sosial yang berkelanjutan.</li>
            <li class="list-group-item">2. Mengembangkan potensi lokal melalui pelatihan dan pendampingan.</li>
            <li class="list-group-item">3. Meningkatkan literasi digital dan pendidikan karakter masyarakat.</li>
            <li class="list-group-item">4. Membangun kemitraan strategis dengan institusi pemerintah dan swasta.</li>
            <li class="list-group-item">5. Mendorong inovasi dan kreativitas generasi muda dalam pembangunan daerah.</li>
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
@endsection

@push('script')
<!-- Timeline Animation & Auto Slide -->
<script>
  function showImageModal(imgElement) {
    document.getElementById('modalImage').src = imgElement.src;
  }

  document.addEventListener('DOMContentLoaded', function () {
    const events = document.querySelectorAll('.timeline-event');
    const container = document.getElementById('timelineContainer');
    const eventWidth = 320 + 24; // card + margin

    function checkVisibility() {
      const triggerBottom = window.innerHeight * 0.85;
      events.forEach(event => {
        const top = event.getBoundingClientRect().top;
        if (top < triggerBottom) {
          event.classList.add('visible');
        }
      });
    }

    // Scroll animation
    window.addEventListener('scroll', checkVisibility);
    checkVisibility();

    // Auto slide
    let currentIndex = 0;
    function autoSlide() {
      currentIndex = (currentIndex + 1) % events.length;
      container.scrollTo({ left: currentIndex * eventWidth, behavior: 'smooth' });
    }

    let slideInterval = setInterval(autoSlide, 3000);

    // Pause auto-slide on click
    container.querySelectorAll('.timeline-event').forEach(event => {
      event.addEventListener('click', () => {
        clearInterval(slideInterval);
        setTimeout(() => slideInterval = setInterval(autoSlide, 3000), 5000);
      });
    });
  });
</script>


@endpush
