<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Menu Utama</li>

                {{-- <li>
                    <a href="{{ url('/') }}" target="_blank">
                        <i class="mdi mdi-web"></i>
                        <span> Lihat Website <sup><i class="mdi mdi-link" style="font-size: 15px;"></i></sup></span>
                    </a>
                </li> --}}
                
                <li>
                    <a href="{{ url('dashboard') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('manage-slider') }}">
                        <i class="mdi mdi-image-area"></i>
                        <span> Slider </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('manage-tentang') }}">
                        <i class="mdi mdi-file-document-box"></i>
                        <span> Tentang </span>
                    </a>
                </li>

                <li>
    <a href="{{ url('sejarah') }}">
        <i class="mdi mdi-book-open-page-variant"></i>
        <span> Sejarah </span>
    </a>
</li>
<li>
    <a href="{{ url('visi_misi') }}">
        <i class="mdi mdi-book-open-page-variant"></i>
        <span> Visi Misi </span>
    </a>
</li>


                <li>
                    <a href="{{ url('manage-team') }}">
                        <i class="mdi mdi-account-group"></i>
                        <span> Team </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('manage-service') }}">
                        <i class="mdi mdi-buffer"></i>
                        <span> Service </span>
                    </a>
                </li>

                {{-- <li>
                    <a href="{{ url('manage-jasa') }}">
                        <i class="mdi mdi-format-list-bulleted-square"></i>
                        <span> Bidang Layanan </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('manage-portofolio') }}">
                        <i class="mdi mdi-account-card-details"></i>
                        <span> Portofolio </span>
                    </a>
                </li> --}}

                {{-- <li>
                    <a href="{{ url('manage-kegiatan') }}">
                        <i class="mdi mdi-run-fast"></i>
                        <span> Kegiatan </span>
                    </a>
                </li> --}}

                <li>
                    <a href="{{ url('manage-mitra') }}">
                        <i class="mdi mdi-account-tie"></i>
                        <span> Mitra / Partner </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('manage-event') }}">
                        <i class="mdi mdi-party-popper"></i>
                        <span> Event </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('manage-artikel') }}">
                        <i class="mdi mdi-pencil"></i>
                        <span> Blog / Artikel </span>
                    </a>
                </li>
{{-- 
                <li>
                    <a href="{{ url('manage-pengabdian') }}">
                        <i class="mdi mdi-home-group"></i>
                        <span> Pengabdian </span>
                    </a>
                </li> --}}
                
                <li>
                    <a href="{{ url('manage-kontak') }}">
                        <i class="mdi mdi-account-badge-horizontal"></i>
                        <span> Kontak </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.contact-messages.index') }}">
                        <i class="mdi mdi-email"></i>
                        <span> Pesan Kontak </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('manage-manfaat') }}">
                        <i class="mdi mdi-star-circle"></i>
                        <span> Manfaat Koperasi </span>
                    </a>
                </li>

   <!-- FAQ Link -->
                <li>
                    <a href="{{ url('manage-faq') }}">
                        <i class="mdi mdi-help-circle-outline"></i>
                        <span> FAQ </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('manage-karir') }}">
                        <i class="mdi mdi-briefcase-outline"></i>
                        <span> Karir </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('manage-regulasi') }}">
                        <i class="mdi mdi-file-document-outline"></i>
                        <span> Regulasi </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('manage-dokumentasi') }}">
                        <i class="mdi mdi-file-image"></i>
                        <span> Dokumentasi </span>
                    </a>
                </li>


                <li class="menu-title mt-2">Lainnya</li>

                <li>
                    <a href="javascript:;" onclick="promptLogout()">
                        <i class="mdi mdi-logout"></i>
                        <span> Logout </span>
                    </a>
                </li>

                

                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-account-card-details"></i>
                        <span> Profil</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ url('sd') }}">Sejarah</a></li>
                        <li><a href="{{ url('akun-sekolah') }}">Pengurus</a></li>
                        <li><a href="{{ url('pendaftaran-siswa-sekolah') }}">Tugas & Fungsi</a></li>
                        <li><a href="{{ url('pendaftaran-siswa-sekolah') }}">Visi & Misi</a></li>
                    </ul>
                </li> --}}

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>