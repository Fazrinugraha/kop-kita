@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Daftar Karir dari L|KITA Bengkalis" />
<meta property="og:description" content="Lihat daftar lowongan karir kami" />
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
                        <h6 class="text-white title"><a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> <i class="mdi mdi-chevron-right"></i> Karir</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero section End -->
    <section class="section py-5 bg-light">
    <div class="container">
        <div class="row">
        <div class="col-12">

            <!-- Section Header -->
            <div class="text-center mb-5">
            <div class="section-badge mb-3">
                <span class="badge bg-primary px-3 py-2 rounded-pill">
                <i class="fas fa-briefcase me-2"></i>Karir
                </span>
            </div>
            <h2 class="section-title mb-3 display-5 fw-bold">Peluang Karir Terbuka</h2>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                Bergabunglah dengan tim profesional kami dan kembangkan karir Anda bersama L|KITA Bengkalis
            </p>
            </div>

            <!-- Jobs Grid -->
            <div class="row g-4 justify-content-center">
            @foreach($dataview->karir as $item)
            <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                <div class="card h-100 shadow-lg border-0 position-relative overflow-hidden career-card">

                <!-- Status Badge -->
                <div class="position-absolute top-0 end-0 m-3 z-index-1">
                    <span class="badge {{ $item->status == 'Aktif' ? 'bg-success' : 'bg-warning text-dark' }} rounded-pill px-3 py-2 shadow-sm">
                    <i class="fas {{ $item->status == 'Aktif' ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>
                    {{ $item->status }}
                    </span>
                </div>

                <!-- Card Image -->
                @if($item->foto)
                <div class="card-img-wrapper position-relative overflow-hidden">
                    <img src="{{ asset($item->foto) }}" alt="{{ $item->judul_posisi }}"
                        class="card-img-top img-fluid" style="height: 220px; object-fit: cover; transition: transform 0.3s ease;">
                    <div class="position-absolute bottom-0 start-0 w-100 h-100"
                        style="background: linear-gradient(135deg, transparent 60%, rgba(0,123,255,0.8) 100%);"></div>
                </div>
                @else
                <div class="card-img-placeholder bg-gradient-primary d-flex align-items-center justify-content-center"
                    style="height: 220px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="text-center text-white">
                    <i class="fas fa-briefcase fa-4x mb-2 opacity-75"></i>
                    <p class="mb-0 fw-medium">{{ $item->judul_posisi }}</p>
                    </div>
                </div>
                @endif

                <!-- Card Body -->
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title fw-bold text-dark mb-3 line-clamp-2">{{ $item->judul_posisi }}</h5>

                    <!-- Job Details -->
                    <div class="job-details mb-4 flex-grow-1">
                    <div class="row gx-3 gy-3">

                        <div class="col-6 detail-item">
                        <i class="fas fa-building icon text-primary"></i>
                        <div>
                            <div class="label">Divisi</div>
                            <div class="value">{{ $item->divisi }}</div>
                        </div>
                        </div>

                        <div class="col-6 detail-item">
                        <i class="fas fa-map-marker-alt icon text-danger"></i>
                        <div>
                            <div class="label">Penempatan</div>
                            <div class="value">{{ $item->penempatan }}</div>
                        </div>
                        </div>

                        <div class="col-6 detail-item">
                        <i class="fas fa-users icon text-success"></i>
                        <div>
                            <div class="label">Kuota</div>
                            <div class="value">
                            <span class="badge bg-success-soft text-success border border-success fw-bold px-2 py-1 rounded-pill">
                                {{ $item->kuota }} Posisi
                            </span>
                            </div>
                        </div>
                        </div>

                        @if($item->batas_lamar)
                        <div class="col-6 detail-item">
                        <i class="fas fa-calendar-alt icon text-warning"></i>
                        <div>
                            <div class="label">Batas Lamaran</div>
                            <div class="value text-warning fw-semibold">{{ tanggal_indo($item->batas_lamar) }}</div>
                        </div>
                        </div>
                        @endif

                    </div>
                    </div>


                    <!-- Action Buttons -->
                    <div class="mt-auto pt-3 border-top">
                    <div class="row g-2">
                        <div class="col-12 col-sm-6">
                        <a href="{{ route('detail.karir', ['id' => $item->id_karir, 'slug' => \Str::slug($item->judul_posisi)]) }}"
                            class="btn btn-outline-primary w-100 btn-sm">
                            <i class="fas fa-info-circle me-2"></i>
                            <span class="d-none d-sm-inline">Detail</span>
                            <span class="d-sm-none">Info</span>
                        </a>
                        </div>
                        <div class="col-12 col-sm-6">
                        {{-- <a href="https://mail.google.com/mail/?view=cm&to={{ getKontak()->email }}&su=Lamaran%20Pekerjaan%20{{ urlencode($item->judul_posisi) }}&body=Halo%2C%0A%0ASaya%20ingin%20melamar%20untuk%20posisi%3A%0A-%20Posisi%3A%20{{ urlencode($item->judul_posisi) }}%0A-%20Divisi%3A%20{{ urlencode($item->divisi) }}%0A-%20Penempatan%3A%20{{ urlencode($item->penempatan) }}%0A%0AMohon%20informasi%20lebih%20lanjut%20mengenai%20proses%20rekrutmen.%0A%0ATerima%20kasih."
                            class="btn btn-success w-100 btn-sm"
                            target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-paper-plane me-2"></i>
                            <span class="d-none d-sm-inline">Lamar</span>
                            <span class="d-sm-none">Apply</span>
                        </a> --}}
                         <a href="{{ url('kontak') }}" class="btn btn-success w-100 btn-sm" target="_blank" rel="noopener noreferrer">
    <i class="fas fa-paper-plane me-2"></i>
    <span class="d-none d-sm-inline">Lamar</span>
    <span class="d-sm-none">Apply</span>
</a>

                        
                        </div>
                    </div>
                    </div>

                </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div>
            @endforeach
            </div>

            <!-- Empty State -->
            @if($dataview->karir->isEmpty())
            <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-search fa-4x text-muted"></i>
            </div>
            <h4 class="text-muted">Belum Ada Lowongan Tersedia</h4>
            <p class="text-muted">Saat ini belum ada lowongan karir yang tersedia. Silakan cek kembali nanti.</p>
            </div>
            @endif

        </div>
        </div>
    </div>
    </section>


    <!-- Custom CSS untuk styling tambahan -->
    <style>
        /* Section Styling */
        .section-badge .badge {
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .section-title {
            font-weight: 800;
            color: #2c3e50;
            position: relative;
            letter-spacing: -0.5px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #007bff, #28a745);
            border-radius: 2px;
        }

        /* Card Styling */
        .career-card {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border-radius: 20px;
            overflow: hidden;
            background: #fff;
        }

        .career-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 123, 255, 0.15) !important;
        }

        .career-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-img-wrapper {
            border-radius: 20px 20px 0 0;
            overflow: hidden;
            position: relative;
        }



        /* Job Details Styling */
        .job-details .detail-item i {
            font-size: 1rem;
            flex-shrink: 0;
            color: inherit;
        }
        .job-details .detail-item div {
        line-height: 1.3;
        }





        .job-details .badge {
        font-size: 0.75rem;
        padding: 3px 8px;
        font-weight: 600;
        line-height: 1;
        margin-top: 2px;
        border-radius: 6px;
        }

        .detail-item {
            padding: 8px 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }


        .detail-item:hover {
            background-color: rgba(0, 123, 255, 0.05);
            margin: 0 -15px;
            padding: 8px 15px;
            border-radius: 8px;
        }
        .detail-item .icon {
        font-size: 1.1rem;
        margin-top: 2px;
        flex-shrink: 0;
        width: 20px;
        text-align: center;
        }
        .detail-item .label {
        font-size: 0.7rem;
        font-weight: 500;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
        }
        .detail-item .value {
            margin-top: 2px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #212529;
            line-height: 1.3;
        }

        .badge.bg-success-soft {
        background-color: rgba(40, 167, 69, 0.1);
        }

        /* Line Clamp for Title */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
            min-height: 2.8em;
        }

        /* Button Styling */
        .btn {
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border-color: #007bff;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #28a745, #1e7e34);
        }

        /* Badge Styling */
        .badge {
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }



        /* Empty State */

        /* Z-index utility */
        .z-index-1 {
            z-index: 1;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .career-card:hover {
                transform: translateY(-10px);
            }
        }

        @media (max-width: 992px) {
            .card-img-top, .card-img-placeholder {
                height: 200px;
            }

            .section-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .career-card {
                margin-bottom: 1rem;
            }

            .career-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0, 123, 255, 0.1) !important;
            }

            .card-img-top, .card-img-placeholder {
                height: 180px;
            }

            .job-details {
                font-size: 0.85rem;
            }
            .job-details i {
                font-size: 1rem;
                width: 20px;
                text-align: center;
                margin-top: 2px;
                flex-shrink: 0;
                }


            .section-title {
                font-size: 2rem;
            }

            .detail-item:hover {
                background-color: transparent;
                margin: 0;
                padding: 8px 0;
            }

            .btn {
                font-size: 0.8rem;
                padding: 8px 12px;
            }
        }

        @media (max-width: 576px) {
            .section {
                padding: 3rem 0;
            }

            .card-body {
                padding: 1.5rem;
                text-align: center;
            }

            .section-title {
                font-size: 1.75rem;
            }
            .detail-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .detail-item .icon {
                margin-bottom: 4px;
            }
            .btn:active {
            transform: scale(0.98);
            box-shadow: none;
            }
            .hero-wrapper .title {
                font-size: 0.9rem !important;
            }
            .hero-wrapper .title a,
            .hero-wrapper .title i {
                font-size: 0.9rem !important;
            }

        }



        /* Loading Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .career-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .career-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .career-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        .career-card:nth-child(4) {
            animation-delay: 0.3s;
        }
    </style>
@endsection

@push('script')

@endpush