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
                        <h6 class="text-white title"><a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a> <i class="mdi mdi-chevron-right"></i> Tentang Kami</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero section End -->

    <!-- Team Section Start -->
    <section class="section bg-light py-5" id="team">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="fw-bold text-primary mb-3">Struktur Tim Kami</h2>
                    <p class="lead text-muted">
                        Tim kecil dengan mimpi besar! Bersama, kami menciptakan solusi teknologi yang berdampak.
                    </p>
                </div>
            </div>

            <h2 class="fw-bold text-primary mb-3">Dewan Pengawas</h2>
            <div class="row justify-content-center">
                @foreach ($dataview->team->where('kategori', 'pengawas') as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="team-card card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="team-img mx-auto mb-4" data-bs-toggle="modal" data-bs-target="#teamModal{{ $loop->index }}" style="cursor: pointer;">
                                <img src="{{ asset($item->file_foto) }}"
                                     class="img-fluid rounded-circle shadow"
                                     alt="{{ $item->nama }}"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <h5 class="fw-bold mb-1">{{ $item->nama }}</h5>
                            <p class="text-muted mb-3">{{ $item->bidang }}</p>

                            <!-- Social Links -->
                            <div class="social-links d-flex justify-content-center gap-2">
                                @if($item->linkedin)
                                <a href="{{ $item->linkedin }}" class="text-primary" target="_blank"><i class="mdi mdi-linkedin"></i></a>
                                @endif
                                @if($item->twitter)
                                <a href="{{ $item->twitter }}" class="text-primary" target="_blank"><i class="mdi mdi-twitter"></i></a>
                                @endif
                                @if($item->email)
                                <a href="mailto:{{ $item->email }}" class="text-primary"><i class="mdi mdi-email"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for each team member -->
                <div class="modal fade" id="teamModal{{ $loop->index }}" tabindex="-1" aria-labelledby="teamModalLabel{{ $loop->index }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="teamModalLabel{{ $loop->index }}">Profil Anggota</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <img src="{{ asset($item->file_foto) }}"
                                             class="img-fluid rounded-circle shadow mb-3"
                                             alt="{{ $item->nama }}"
                                             style="width: 200px; height: 200px; object-fit: cover;">
                                        <h4 class="fw-bold">{{ $item->nama }}</h4>
                                        <p class="text-muted">{{ $item->bidang }}</p>
                                        <div class="social-links d-flex justify-content-center gap-3 mb-3">
                                            @if($item->linkedin)
                                            <a href="{{ $item->linkedin }}" class="text-primary" target="_blank"><i class="mdi mdi-linkedin fs-4"></i></a>
                                            @endif
                                            @if($item->twitter)
                                            <a href="{{ $item->twitter }}" class="text-primary" target="_blank"><i class="mdi mdi-twitter fs-4"></i></a>
                                            @endif
                                            @if($item->email)
                                            <a href="mailto:{{ $item->email }}" class="text-primary"><i class="mdi mdi-email fs-4"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="fw-bold border-bottom pb-2 mb-3">Tentang Saya</h5>
                                       <p>{{ $item->tentang_saya ?? 'Deskripsi anggota tim akan ditampilkan di sini.' }}</p>

                                        {{-- <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4">Pengalaman</h5>
                                        <ul class="list-unstyled">
                                            @if($item->pengalaman)
                                                @foreach(explode("\n", $item->pengalaman) as $exp)
                                                    <li class="mb-2"><i class="mdi mdi-check-circle-outline text-primary me-2"></i>{{ $exp }}</li>
                                                @endforeach
                                            @else
                                                <li>Pengalaman profesional akan ditampilkan di sini.</li>
                                            @endif
                                        </ul>

                                        <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4">Pendidikan</h5>
                                        <p>{{ $item->pendidikan ?? 'Riwayat pendidikan akan ditampilkan di sini.' }}</p> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <h2 class="fw-bold text-primary mb-3 mt-5">Dewan Pengurus</h2>
            <div class="row justify-content-center">
                @foreach ($dataview->team->where('kategori', 'pengurus') as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="team-card card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="team-img mx-auto mb-4" data-bs-toggle="modal" data-bs-target="#teamModal{{ $loop->index + count($dataview->team) }}" style="cursor: pointer;">
                                <img src="{{ asset($item->file_foto) }}"
                                     class="img-fluid rounded-circle shadow"
                                     alt="{{ $item->nama }}"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <h5 class="fw-bold mb-1">{{ $item->nama }}</h5>
                            <p class="text-muted mb-3">{{ $item->bidang }}</p>

                            <!-- Social Links -->
                            <div class="social-links d-flex justify-content-center gap-2">
                                @if($item->linkedin)
                                <a href="{{ $item->linkedin }}" class="text-primary" target="_blank"><i class="mdi mdi-linkedin"></i></a>
                                @endif
                                @if($item->twitter)
                                <a href="{{ $item->twitter }}" class="text-primary" target="_blank"><i class="mdi mdi-twitter"></i></a>
                                @endif
                                @if($item->email)
                                <a href="mailto:{{ $item->email }}" class="text-primary"><i class="mdi mdi-email"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for each team member -->
                <div class="modal fade" id="teamModal{{ $loop->index + count($dataview->team) }}" tabindex="-1" aria-labelledby="teamModalLabel{{ $loop->index + count($dataview->team) }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="teamModalLabel{{ $loop->index + count($dataview->team) }}">Profil Anggota</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <img src="{{ asset($item->file_foto) }}"
                                             class="img-fluid rounded-circle shadow mb-3"
                                             alt="{{ $item->nama }}"
                                             style="width: 200px; height: 200px; object-fit: cover;">
                                        <h4 class="fw-bold">{{ $item->nama }}</h4>
                                        <p class="text-muted">{{ $item->bidang }}</p>

                                        {{-- <div class="social-links d-flex justify-content-center gap-3 mb-3">
                                            @if($item->linkedin)
                                            <a href="{{ $item->linkedin }}" class="text-primary" target="_blank"><i class="mdi mdi-linkedin fs-4"></i></a>
                                            @endif
                                            @if($item->twitter)
                                            <a href="{{ $item->twitter }}" class="text-primary" target="_blank"><i class="mdi mdi-twitter fs-4"></i></a>
                                            @endif
                                            @if($item->email)
                                            <a href="mailto:{{ $item->email }}" class="text-primary"><i class="mdi mdi-email fs-4"></i></a>
                                            @endif
                                        </div> --}}
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="fw-bold border-bottom pb-2 mb-3">Tentang Saya</h5>
                                        <p>{{ $item->tentang_saya ?? 'Deskripsi anggota tim akan ditampilkan di sini.' }}</p>

                                        {{-- <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4">Pengalaman</h5>
                                        <ul class="list-unstyled">
                                            @if($item->pengalaman)
                                                @foreach(explode("\n", $item->pengalaman) as $exp)
                                                    <li class="mb-2"><i class="mdi mdi-check-circle-outline text-primary me-2"></i>{{ $exp }}</li>
                                                @endforeach
                                            @else
                                                <li>Pengalaman profesional akan ditampilkan di sini.</li>
                                            @endif
                                        </ul>

                                        <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4">Pendidikan</h5>
                                        <p>{{ $item->pendidikan ?? 'Riwayat pendidikan akan ditampilkan di sini.' }}</p> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Team Section End -->
@endsection

@push('styles')
<style>
    .team-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .team-img {
        border: 3px solid rgba(13, 110, 253, 0.2);
        border-radius: 50%;
        padding: 5px;
        transition: transform 0.3s ease;
    }
    .team-img:hover {
        transform: scale(1.05);
    }

    /* Modal styling */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    }
    .modal-header {
        border-bottom: 1px solid #eee;
        background-color: #f8f9fa;
        border-radius: 15px 15px 0 0 !important;
    }
    .modal-title {
        color: #0d6efd;
        font-weight: 600;
    }

    /* Social links animation */
    .social-links a {
        transition: transform 0.3s ease, color 0.3s ease;
    }
    .social-links a:hover {
        transform: translateY(-3px);
        color: #0b5ed7 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Optional: Add animation when modal shows
    document.addEventListener('DOMContentLoaded', function() {
        var teamModals = document.querySelectorAll('.team-img');

        teamModals.forEach(function(trigger) {
            trigger.addEventListener('click', function() {
                var modalId = this.getAttribute('data-bs-target');
                var modal = document.querySelector(modalId);

                // Add animation class
                modal.querySelector('.modal-content').classList.add('animate__animated', 'animate__fadeInUp');

                // Remove animation after it completes
                setTimeout(function() {
                    modal.querySelector('.modal-content').classList.remove('animate__animated', 'animate__fadeInUp');
                }, 500);
            });
        });
    });
</script>
@endpush
