@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Dokumentasi L|KITA Bengkalis" />
<meta property="og:description" content="Lihat dokumentasi kegiatan kami" />
<meta property="og:image" content="{{ asset('themes/front/images/logo-hitam.png') }}" />
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
                        <i class="mdi mdi-chevron-right"></i> Dokumentasi
                    </h6>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero section End -->

<!-- Dokumentasi Section Start -->
<section class="section">
    <div class="container-fluid">
        <!-- Filter Buttons -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="btn-group" role="group" aria-label="Filter Dokumentasi">
                    <a href="{{ url('dokumentasi?tipe=foto') }}" class="btn btn-outline-primary {{ request('tipe') == 'foto' ? 'active' : '' }}">
                        <i class="mdi mdi-image"></i> Foto
                    </a>
                    <a href="{{ url('dokumentasi?tipe=video') }}" class="btn btn-outline-primary {{ request('tipe') == 'video' ? 'active' : '' }}">
                        <i class="mdi mdi-video"></i> Video
                    </a>
                    <a href="{{ url('dokumentasi') }}" class="btn btn-outline-secondary {{ request('tipe') == null ? 'active' : '' }}">
                        <i class="mdi mdi-format-list-bulleted"></i> Semua
                    </a>
                </div>
            </div>
        </div>

        <!-- Konten Dokumentasi -->
        <!-- Konten Dokumentasi -->
<div class="row">
    @forelse($dataview->dokumentasi as $item)
        <div class="col-md-12 mb-4">
            <div class="card border">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <p class="text-muted">{{ $item->tanggal }}</p>
                    <p>{{ $item->deskripsi }}</p>

                    <div class="row">
                        @if(request('tipe') === 'foto')
                            @foreach($item->foto as $foto)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset($foto->file_path) }}" alt="Foto dokumentasi" class="img-fluid rounded">
                                </div>
                            @endforeach
                        @elseif(request('tipe') === 'video')
                            @foreach($item->video as $video)
                                <div class="col-md-4 mb-3">
                                    @if($video->tipe === 'youtube')
                                {{-- DEBUG --}}
                                <p>Media Path: {{ $video->media_path }}</p>
                                <p>Extracted ID: {{ getYouTubeId($video->media_path) }}</p>

                                <div class="youtube-wrapper position-relative" style="padding-bottom: 56.25%; height: 0; overflow: hidden;">
                                    <div id="player-{{ $video->id }}" style="position: absolute; top:0; left:0; width:100%; height:100%;"></div>

                                    <!-- Tombol overlay -->
                                    <a href="{{ $video->media_path }}" target="_blank"
                                        class="youtube-overlay-btn d-none"
                                        id="overlay-btn-{{ $video->id }}"
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                            background: rgba(0,0,0,0.7); color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                                        Tonton Selengkapnya di YouTube
                                    </a>
                                </div>



                                    @else
                                        <video controls class="w-100 rounded">
                                            <source src="{{ asset($video->media_path) }}" type="video/mp4">
                                            Browser tidak mendukung video.
                                        </video>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            {{-- Tampilkan keduanya jika tidak difilter --}}
                            @foreach($item->foto as $foto)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset($foto->file_path) }}" alt="Foto dokumentasi" class="img-fluid rounded">
                                </div>
                            @endforeach
                            @foreach($item->video as $video)
                                <div class="col-md-4 mb-3">
                                    @if($video->tipe === 'youtube')
                                        <div class="youtube-wrapper position-relative" style="padding-bottom: 56.25%; height: 0; overflow: hidden;">
                                            <div id="player-{{ $video->id }}" style="position: absolute; top:0; left:0; width:100%; height:100%;"></div>

                                            <!-- Tombol overlay -->
                                            <a href="{{ $video->media_path }}" target="_blank"
                                                class="youtube-overlay-btn d-none"
                                                id="overlay-btn-{{ $video->id }}"
                                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                                    background: rgba(0,0,0,0.7); color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                                                Tonton Selengkapnya di YouTube
                                            </a>
                                        </div>


                                    @else
                                        <video controls class="w-100 rounded">
                                            <source src="{{ asset($video->media_path) }}" type="video/mp4">
                                            Browser tidak mendukung video.
                                        </video>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-md-12">
            <p class="text-muted text-center">Tidak ada dokumentasi tersedia.</p>
        </div>
    @endforelse
</div>

    </div>
</section>
<!-- Dokumentasi Section End -->

@endsection

@push('script')
@push('script')
<script src="https://www.youtube.com/iframe_api"></script>
<script>
    var players = {};

    function onYouTubeIframeAPIReady() {
        @foreach($dataview->dokumentasi as $item)
            @foreach($item->video as $video)
                @if($video->tipe === 'youtube')
                    players[{{ $video->id }}] = new YT.Player('player-{{ $video->id }}', {
                        videoId: "{{ getYouTubeId($video->media_path) }}",
                        playerVars: {
                            rel: 0,
                            controls: 1,
                            start: 0,
                            end: 10
                        },
                        events: {
                            'onStateChange': function(event) {
                                if (event.data === YT.PlayerState.ENDED) {
                                    document.getElementById("overlay-btn-{{ $video->id }}").classList.remove("d-none");
                                }
                            }
                        }
                    });
                @endif
            @endforeach
        @endforeach
    }
</script>
@endpush

@endpush
