@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Kontak Resmi L|KITA Bengkalis" />
<meta property="og:description" content="Lihat daftar kontak kami" />
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
      <h2 class="download-title">
        Dokumen Resmi Koperasi Desa Merah Putih
      </h2>
      <p class="download-subtitle">Unduh dokumen-dokumen penting terkait pembentukan dan pengelolaan koperasi desa</p>
    </div>
    
    <div class="download-grid">
      @foreach($dataview->regulasi as $reg)
      <div class="download-card">
        <div class="card-badge">
          @php
            $extension = pathinfo($reg->file_dokumen, PATHINFO_EXTENSION);
            echo strtoupper($extension);
          @endphp
        </div>
        <div class="card-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
            <path d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.3 10.7 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.5 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"/>
          </svg>
        </div>
        <h3 class="document-title">{{ $reg->nama_regulasi }}</h3>
        <a href="{{ route('regulasi.download', $reg->id) }}" class="download-button" target="_blank" rel="noopener noreferrer">
          <span>Unduh Dokumen</span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
          </svg>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</div>
<style>
/* Base Styles */
:root {
  --primary-blue: #1a56b4;
  --secondary-blue: #2c83d6;
  --light-blue: #e8f2fc;
  --primary-yellow: #f8c51c;
  --dark-yellow: #e6b400;
  --dark-gray: #2d3748;
  --medium-gray: #4a5568;
  --light-gray: #f7fafc;
}

.download-section {
  font-family: 'Poppins', system-ui, -apple-system, sans-serif;
  background-color: var(--light-gray);
  padding: 4rem 0;
}

.download-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

.download-header {
  text-align: center;
  margin-bottom: 3rem;
}

.download-title {
  color: var(--primary-blue);
  font-size: 2.25rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  position: relative;
  display: inline-block;
}

.download-title .title-icon {
  margin-right: 0.5rem;
}

.download-title::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background: linear-gradient(90deg, var(--primary-blue), var(--primary-yellow));
  border-radius: 2px;
}

.download-subtitle {
  color: var(--medium-gray);
  font-size: 1.1rem;
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.6;
}

.download-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
}

.download-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  border: 1px solid rgba(0, 0, 0, 0.05);
  position: relative;
}

.download-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1), 0 6px 6px rgba(0, 0, 0, 0.05);
  border-color: rgba(26, 86, 180, 0.2);
}

.card-badge {
  position: absolute;
  top: 0;
  right: 0;
  background-color: var(--primary-yellow);
  color: #000;
  font-size: 0.75rem;
  font-weight: 600;
  padding: 0.25rem 0.75rem;
  border-bottom-left-radius: 8px;
  border-top-right-radius: 12px;
}

.card-icon {
  width: 60px;
  height: 60px;
  background-color: var(--light-blue);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.25rem;
}

.card-icon svg {
  width: 30px;
  height: 30px;
  fill: var(--primary-blue);
}

.document-title {
  color: var(--dark-gray);
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 0.75rem;
  line-height: 1.4;
}

.document-description {
  color: var(--medium-gray);
  font-size: 0.9rem;
  line-height: 1.5;
  margin-bottom: 1.5rem;
  flex-grow: 1;
}

.download-button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
  color: white;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  width: 100%;
  max-width: 200px;
  box-shadow: 0 2px 5px rgba(26, 86, 180, 0.2);
}

.download-button:hover {
  background: linear-gradient(135deg, var(--secondary-blue), var(--primary-blue));
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(26, 86, 180, 0.3);
}

.download-button svg {
  width: 18px;
  height: 18px;
  fill: white;
  margin-left: 0.5rem;
}

/* Responsive Adjustments */
@media (max-width: 1024px) {
  .download-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  }
}

@media (max-width: 768px) {
  .download-title {
    font-size: 1.8rem;
  }
  
  .download-subtitle {
    font-size: 1rem;
  }
}

@media (max-width: 480px) {
  .download-section {
    padding: 2.5rem 0;
  }
  
  .download-title {
    font-size: 1.5rem;
  }
  
  .download-grid {
    grid-template-columns: 1fr;
  }
}
</style>
            @endsection

@push('script')
@endpush
