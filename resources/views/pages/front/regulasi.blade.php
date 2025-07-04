@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Dokumen Regulasi | L|KITA Bengkalis" />
<meta property="og:description" content="Unduh dokumen resmi dan regulasi Koperasi Desa Merah Putih" />
<meta property="og:image" content="{{ asset('themes/front/') }}/images/logo-hitam.png" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />
@endpush

@section('content')
<section class="hero-section bg-primary" id="home">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <hr style="border: 1px solid white;">
        <div class="hero-wrapper pb-3">
          <h6 class="text-white title">
            <a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a>
            <i class="mdi mdi-chevron-right"></i> Regulasi
          </h6>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="download-section">
  <div class="download-container">
    <div class="download-header">
      <h2 class="download-title">Dokumen Resmi Koperasi Desa Merah Putih</h2>
      <p class="download-subtitle">Unduh dokumen penting terkait pembentukan dan pengelolaan koperasi desa.</p>
    </div>

    <div class="regulasi-list">
      @forelse($dataview->regulasi as $reg)
      <div class="regulasi-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
        <div class="regulasi-content d-flex flex-wrap align-items-center justify-content-between gap-3">
          <div class="d-flex align-items-center flex-wrap gap-2">
            <div class="icon-dokumen">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#f8c51c" viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.103.897 2 2 2h12a2
                2 0 0 0 2-2V8l-6-6zm1 7V3.5L20.5 9H15z"/>
              </svg>
            </div>
            <span class="regulasi-name">{{ $reg->nama_regulasi }}</span>
          </div>
          <a href="{{ route('regulasi.download', $reg->id) }}" class="download-btn" target="_blank">
            Unduh <i class="mdi mdi-download ms-1"></i>
          </a>
        </div>
      </div>
      @empty
      <p class="text-center text-muted">Belum ada dokumen regulasi yang tersedia.</p>
      @endforelse
    </div>
  </div>
</div>

<link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>AOS.init();</script>

<style>
:root {
  --primary-blue: #1a56b4;
  --primary-yellow: #f8c51c;
  --medium-gray: #4a5568;
  --light-gray: #f7fafc;
  --white: #ffffff;
}

.download-section {
  background-color: var(--light-gray);
  font-family: 'Poppins', sans-serif;
  padding: 4rem 0;
}

.download-container {
  max-width: 1200px;
  margin: auto;
  padding: 0 1.5rem;
}

.download-header {
  text-align: center;
  margin-bottom: 3rem;
}

.download-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--primary-blue);
  position: relative;
}

.download-title::after {
  content: '';
  display: block;
  margin: 0.75rem auto 0;
  width: 100px;
  height: 4px;
  background: linear-gradient(to right, var(--primary-blue), var(--primary-yellow));
  border-radius: 4px;
}

.download-subtitle {
  font-size: 1.1rem;
  color: var(--medium-gray);
  margin-top: 1rem;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
}

.regulasi-list {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.regulasi-card {
  background: var(--white);
  border-radius: 10px;
  padding: 1rem 1.5rem;
  box-shadow: 0 3px 12px rgba(0,0,0,0.06);
  transition: 0.3s ease;
}

.regulasi-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.icon-dokumen {
  background-color: #e8f2fc;
  padding: 8px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.regulasi-name {
  font-size: 1.05rem;
  font-weight: 600;
  color: var(--primary-blue);
}

.download-btn {
  background-color: var(--primary-yellow);
  color: #222;
  padding: 0.45rem 1rem;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  transition: 0.3s ease;
}

.download-btn:hover {
  background-color: #e6b400;
  color: #000;
}

/* Responsive */
@media (max-width: 992px) {
  .download-title {
    font-size: 2.1rem;
  }

  .download-subtitle {
    font-size: 1rem;
  }

  .regulasi-name {
    font-size: 0.95rem;
  }

  .download-btn {
    font-size: 0.9rem;
    padding: 0.4rem 0.9rem;
  }

  .icon-dokumen svg {
    width: 24px;
    height: 24px;
  }
}

@media (max-width: 768px) {
  .download-title {
    font-size: 1.9rem;
  }

  .regulasi-content {
    flex-direction: column;
    align-items: flex-start !important;
    gap: 0.75rem;
  }

  .download-btn {
    width: 100%;
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .download-title {
    font-size: 1.6rem;
  }

  .download-subtitle {
    font-size: 0.95rem;
  }

  .download-container {
    padding: 0 1rem;
  }

  .icon-dokumen {
    padding: 6px;
  }

  .icon-dokumen svg {
    width: 22px;
    height: 22px;
  }

  .regulasi-name {
    font-size: 0.9rem;
  }
}
</style>
@endsection

@push('script')
@endpush
