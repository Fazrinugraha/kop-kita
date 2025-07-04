@extends('pages.admin.layout.main')

@push('head')
    <link href="{{ asset('themes/back/') }}/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('themes/back/') }}/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('themes/back/') }}/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" />
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const addBtn = document.getElementById('add-media-btn');
        const mediaContainer = document.getElementById('media-inputs');

        addBtn.addEventListener('click', function () {
            const inputGroup = document.createElement('div');
            inputGroup.classList.add('input-group', 'mb-2');

            inputGroup.innerHTML = `
                <input type="file" name="media_file[]" class="form-control" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-media-btn">&times;</button>
                </div>
            `;

            mediaContainer.appendChild(inputGroup);
        });

        mediaContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-media-btn')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>

@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Utama</a></li>
                        <li class="breadcrumb-item active">{{ $dataview->page_title }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ $dataview->page_title }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tombol Tambah Foto -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalFoto">
                <i class="mdi mdi-image"></i> Tambah Dokumentasi Foto
            </button>

            <!-- Tombol Tambah Video -->
            <button class="btn btn-warning" data-toggle="modal" data-target="#modalVideo">
                <i class="mdi mdi-video"></i> Tambah Dokumentasi Video
            </button>


            <!-- Modal Tambah Foto -->
            <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Dokumentasi Foto</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="tipe_media" value="foto">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" class="form-control" name="judul" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>


                                </div>

                                <div class="form-group">
                                    <label>File Foto</label>
                                    <input type="file" class="form-control" id="photo-upload" name="media_file[]" accept="image/*" multiple>
                                </div>

                                <div class="form-group" id="photo-preview-container" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>

                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Video -->
            <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Dokumentasi Video</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="tipe_media" value="video">



                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" class="form-control" name="judul" required>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>


                                </div>

                                <div class="form-group">
                                    <label>Sumber Video</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input video-source-radio" type="radio" name="video_source" value="local" checked>
                                        <label class="form-check-label">Upload Lokal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input video-source-radio" type="radio" name="video_source" value="youtube">
                                        <label class="form-check-label">Link YouTube</label>
                                    </div>
                                </div>

                                <div class="form-group" id="upload-local-group">
                                    <label>Upload File Video (maks. 10MB, format .mp4)</label>
                                    <input type="file" class="form-control" name="media_file[]" accept="video/mp4" multiple>
                                </div>

                                <div class="form-group d-none" id="youtube-link-group">
                                    <label>Link YouTube</label>
                                    <input type="url" class="form-control" name="video_youtube" placeholder="https://www.youtube.com/watch?v=...">
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi"></textarea>
                                </div>

                                <button type="submit" class="btn btn-warning">Simpan Video</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>






        </div>
    </div>
    <div class="btn-group mb-3" role="group" aria-label="Filter Dokumentasi">
        <a href="{{ route('manage.dokumentasi') }}" class="btn btn-outline-secondary {{ request('tipe') == null ? 'active' : '' }}">
            Semua
        </a>
        <a href="{{ route('manage.dokumentasi', ['tipe' => 'foto']) }}" class="btn btn-outline-primary {{ request('tipe') == 'foto' ? 'active' : '' }}">
            Foto
        </a>
        <a href="{{ route('manage.dokumentasi', ['tipe' => 'video']) }}" class="btn btn-outline-warning {{ request('tipe') == 'video' ? 'active' : '' }}">
            Video
        </a>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Media</th>
                                <th>Jenis</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataview->dokumentasi as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>
                                        <!-- Foto -->
                                        @foreach ($item->foto as $foto)
                                            <img src="{{ asset($foto->file_path) }}" height="80" class="mr-2 mb-2 rounded">
                                        @endforeach

                                        <!-- Video -->
                                        @foreach ($item->video as $video)
                                            @if($video->tipe == 'local')
                                                <video width="120" controls class="mb-2 rounded">
                                                    <source src="{{ asset($video->media_path) }}" type="video/mp4">
                                                </video>
                                            @elseif($video->tipe == 'youtube')
                                                <iframe width="120" height="80" src="https://www.youtube.com/embed/{{ getYouTubeId($video->media_path) }}" frameborder="0" allowfullscreen></iframe>
                                            @endif
                                        @endforeach

                                    </td>
                                    <td>
                                        <span class="badge badge-{{ count($item->video) > 0 ? 'warning' : 'info' }}">
                                            {{ count($item->video) > 0 ? 'Video' : 'Foto' }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $item->deskripsi ?: 'Tidak ada deskripsi' }}
                                    </td>
                

                                    <td>
                                        {{-- Tombol Edit --}}
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>


                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('dokumentasi.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus dokumentasi ini? Semua media juga akan terhapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal Edit Dokumentasi --}}
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Dokumentasi</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editForm{{ $item->id }}" action="{{ route('dokumentasi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label>Judul</label>
                                                    <input type="text" class="form-control" name="judul" value="{{ $item->judul }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Tanggal</label>
                                                    <input type="date" class="form-control" name="tanggal" value="{{ $item->tanggal }}" required>
                                                </div>

                                                <input type="hidden" name="tipe_media" value="{{ count($item->video) > 0 ? 'video' : 'foto' }}">

                                                @if(count($item->video) > 0)
                                                    @php
                                                        $youtubeVideo = $item->video->firstWhere('tipe', 'youtube');
                                                        $isYoutube = $youtubeVideo !== null;
                                                    @endphp

                                                    <div class="form-group">
                                                        <label>Sumber Video</label><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input video-source-radio" type="radio" name="video_source" value="local" {{ !$isYoutube ? 'checked' : '' }}>

                                                            <label class="form-check-label">Upload Lokal</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input video-source-radio" type="radio" name="video_source" value="youtube" {{ $isYoutube ? 'checked' : '' }}>
                                                            <label class="form-check-label">Link YouTube</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group {{ $isYoutube ? 'd-none' : '' }}" id="upload-local-group">
                                                        <label>Upload File Video (maks. 10MB, format .mp4)</label>
                                                        <input type="file" class="form-control" name="media_file[]" accept="video/mp4" multiple>
                                                        <small class="form-text text-muted">Kosongkan jika tidak ingin menambahkan video baru.</small>
                                                    </div>

                                                    <div class="form-group {{ !$isYoutube ? 'd-none' : '' }}" id="youtube-link-group">
                                                        <label>Link YouTube</label>
                                                        <input type="url" class="form-control" name="video_youtube" value="{{ $youtubeVideo?->media_path }}" placeholder="https://www.youtube.com/watch?v=...">
                                                    </div>

                                                @else
                                                    <!-- Bagian Edit Foto -->
                                                    <div class="form-group">
                                                        <label>Foto yang Sudah Ada</label><br>
                                                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                                            @foreach ($item->foto as $foto)
                                                                <div style="position: relative; display: inline-block;">
                                                                    <img src="{{ asset($foto->file_path) }}" style="width: 100px; height: 80px; object-fit: cover; border-radius: 5px; border: 1px solid #ccc;">
                                                                    <form action="{{ route('dokumentasi.media.destroy', $foto->id) }}" method="POST" style="position: absolute; top: 0; right: 0;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" onclick="return confirm('Hapus foto ini?')" style="background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px;">×</button>
                                                                    </form>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Tambah File Foto Baru</label>
                                                        <input type="file" class="form-control photo-edit-upload" name="media_file[]" accept="image/*" multiple>
                                                        <small class="form-text text-muted">Kosongkan jika tidak ingin menambahkan foto baru.</small>
                                                    </div>

                                                    <div class="form-group photo-edit-preview" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                                                @endif

                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control" name="deskripsi">{{ $item->deskripsi }}</textarea>
                                                </div>

                                                    <button type="submit" class="btn btn-primary">Perbarui</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@push('script')
<script src="{{ asset('themes/back/') }}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('themes/back/') }}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('themes/back/') }}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{ asset('themes/back/') }}/libs/datatables/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("photo-upload");
    const previewContainer = document.getElementById("photo-preview-container");

    input.addEventListener("change", function () {
        previewContainer.innerHTML = ""; // reset dulu
        const files = Array.from(this.files);

        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const wrapper = document.createElement("div");
                wrapper.style.position = "relative";
                wrapper.style.display = "inline-block";

                const img = document.createElement("img");
                img.src = e.target.result;
                img.style.maxWidth = "120px";
                img.style.maxHeight = "100px";
                img.style.borderRadius = "6px";
                img.style.border = "1px solid #ccc";

                const btn = document.createElement("button");
                btn.innerText = "×";
                btn.style.position = "absolute";
                btn.style.top = "0";
                btn.style.right = "0";
                btn.style.background = "red";
                btn.style.color = "white";
                btn.style.border = "none";
                btn.style.borderRadius = "50%";
                btn.style.cursor = "pointer";
                btn.style.width = "20px";
                btn.style.height = "20px";
                btn.title = "Hapus gambar ini";

                btn.onclick = function () {
                    // remove image preview
                    wrapper.remove();
                    // hapus file dari input
                    const newFiles = Array.from(input.files).filter((_, i) => i !== index);
                    const dataTransfer = new DataTransfer();
                    newFiles.forEach(f => dataTransfer.items.add(f));
                    input.files = dataTransfer.files;
                };

                wrapper.appendChild(img);
                wrapper.appendChild(btn);
                previewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.photo-edit-upload').forEach(function(input) {
        const previewContainer = input.closest('form').querySelector('.photo-edit-preview');

        input.addEventListener("change", function () {
            previewContainer.innerHTML = ""; // reset dulu
            const files = Array.from(this.files);

            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const wrapper = document.createElement("div");
                    wrapper.style.position = "relative";
                    wrapper.style.display = "inline-block";

                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.maxWidth = "100px";
                    img.style.maxHeight = "80px";
                    img.style.borderRadius = "6px";
                    img.style.border = "1px solid #ccc";

                    const btn = document.createElement("button");
                    btn.innerText = "×";
                    btn.style.position = "absolute";
                    btn.style.top = "0";
                    btn.style.right = "0";
                    btn.style.background = "red";
                    btn.style.color = "white";
                    btn.style.border = "none";
                    btn.style.borderRadius = "50%";
                    btn.style.cursor = "pointer";
                    btn.style.width = "20px";
                    btn.style.height = "20px";

                    btn.onclick = function () {
                        wrapper.remove();
                        const newFiles = Array.from(input.files).filter((_, i) => i !== index);
                        const dataTransfer = new DataTransfer();
                        newFiles.forEach(f => dataTransfer.items.add(f));
                        input.files = dataTransfer.files;
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(btn);
                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        });
    });
});
</script>
<script>
document.querySelectorAll('form[id^="editForm"]').forEach(function(form) {
    form.addEventListener("submit", function(e) {
        console.log("Form " + form.id + " dikirim");
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    function handleVideoSourceToggle(container) {
        const radios = container.querySelectorAll('.video-source-radio');
        const localGroup = container.querySelector('#upload-local-group');
        const youtubeGroup = container.querySelector('#youtube-link-group');

        radios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'local') {
                    localGroup.classList.remove('d-none');
                    youtubeGroup.classList.add('d-none');
                } else {
                    localGroup.classList.add('d-none');
                    youtubeGroup.classList.remove('d-none');
                }
            });
        });
    }

    // Untuk modal tambah video
    const videoModal = document.querySelector('#modalVideo');
    if (videoModal) {
        handleVideoSourceToggle(videoModal);
    }

    // Untuk semua modal edit video
    document.querySelectorAll('.modal').forEach(modal => {
        if (modal.querySelector('.video-source-radio')) {
            handleVideoSourceToggle(modal);
        }
    });
});
function handleVideoSourceToggle(container) {
    const radios = container.querySelectorAll('.video-source-radio');
    const localGroup = container.querySelector('#upload-local-group');
    const youtubeGroup = container.querySelector('#youtube-link-group');
    const sourceInput = container.querySelector('input[name="video_source"][type="hidden"]');

    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'local') {
                localGroup.classList.remove('d-none');
                youtubeGroup.classList.add('d-none');
                if (sourceInput) sourceInput.value = 'local';
            } else {
                localGroup.classList.add('d-none');
                youtubeGroup.classList.remove('d-none');
                if (sourceInput) sourceInput.value = 'youtube';
            }
        });
    });
}

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Validasi ukuran file video (maks 10MB)
    document.querySelectorAll('input[type="file"][accept="video/mp4"]').forEach(function(input) {
        input.addEventListener('change', function () {
            const files = Array.from(this.files);
            const maxSize = 10 * 1024 * 1024; // 10MB

            for (let file of files) {
                if (file.size > maxSize) {
                    alert(`File "${file.name}" melebihi batas ukuran maksimal 10MB. Silakan pilih file yang lebih kecil.`);
                    this.value = ""; // reset input
                    break;
                }
            }
        });
    });
});
</script>



@endpush
