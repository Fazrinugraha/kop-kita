<!--Navbar Start-->
<nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky bg-primary">
    <div class="container-fluid">
        <!-- LOGO -->
        <a class="logo text-uppercase" href="{{ url('/') }}">
            <img src="{{ asset('assets/front/images/logo-putih.png') }}" alt="" class="logo-light" height="55" />
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto navbar-center" id="mySidenav">

                <li class="nav-item {{ empty(Request::segment(1)) ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                </li>

                <!-- Tentang Kami Dropdown -->
                <li class="nav-item dropdown {{ Request::segment(1) == 'tentang' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="tentangDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tentang Kami <i class="mdi mdi-chevron-down ml-1"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="tentangDropdown">
                        <a class="dropdown-item {{ Request::segment(2) == 'sejarah' ? 'active' : '' }}" href="{{ url('tentang') }}">Sekilas Tentang Koperasi</a>
                        <a class="dropdown-item {{ Request::segment(1) == 'team' ? 'active' : '' }}" href="{{ route('team') }}">Struktur Organisasi</a>
                        <a class="dropdown-item {{ Request::segment(2) == 'manfaat' ? 'active' : '' }}" href="{{ url('manfaat') }}">Manfaat Koperasi</a>
                    </div>
                </li>

                <!-- Layanan Dropdown -->
                <li class="nav-item dropdown {{ Request::segment(1) == 'layanan' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Produk <i class="mdi mdi-chevron-down ml-1"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="layananDropdown">
                        @foreach($layananDropdown as $item)
                            <a class="dropdown-item {{ Request::fullUrl() == $item->link_url ? 'active' : '' }}" href="{{ $item->link_url }}" target="_blank">
                                {{ $item->nama_layanan }}
                            </a>
                        @endforeach
                    </div>
                </li>

                <!-- Program & Kegiatan Dropdown -->
                <li class="nav-item dropdown {{ Request::segment(1) == 'program' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="programDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Program & Kegiatan <i class="mdi mdi-chevron-down ml-1"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="programDropdown">
                        <a class="dropdown-item {{ Request::segment(2) == 'event' ? 'active' : '' }}" href="{{ url('event') }}">Event</a>
                        <a class="dropdown-item {{ Request::segment(2) == 'dokumentasi' ? 'active' : '' }}" href="{{ url('dokumentasi') }}">Dokumentasi</a>
                        <a class="dropdown-item {{ Request::segment(2) == 'karir' ? 'active' : '' }}" href="{{ url('informasi/karir') }}">Karir</a>
                        <a class="dropdown-item {{ Request::segment(2) == 'berita' ? 'active' : '' }}" href="{{ url('artikel') }}">Berita dan Promosi</a>
                    </div>
                </li>

                <!-- Informasi & Transparansi Dropdown -->
                <li class="nav-item dropdown {{ Request::segment(1) == 'informasi' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="informasiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dokumen<i class="mdi mdi-chevron-down ml-1"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="informasiDropdown">
                        <a class="dropdown-item {{ Request::segment(2) == 'berita' ? 'active' : '' }}" href="{{ url('regulasi') }}">Regulasi</a>
                        {{-- <a class="dropdown-item {{ Request::segment(2) == 'laporan' ? 'active' : '' }}" href="{{ url('informasi/laporan') }}">Laporan Keuangan</a> --}}
                        <a class="dropdown-item {{ Request::segment(2) == 'faq' ? 'active' : '' }}" href="{{ url('faq') }}">FAQ</a>
                    </div>
                </li>

                <li class="nav-item {{ Request::segment(1) == 'kontak' ? 'active' : '' }}">
                    <a href="{{ url('kontak') }}" class="nav-link">Kontak</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- Navbar End -->

<!-- MDI Icons CDN if not already included -->
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
