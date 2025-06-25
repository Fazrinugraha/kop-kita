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

            <button class="btn btn-primary float-right" data-toggle="modal" data-target=".form-tambah">
                <i class="mdi mdi-plus"></i> Tambah Dokumentasi
            </button>

            <div class="modal fade form-tambah" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Dokumentasi</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                           <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" class="form-control" name="judul" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" required>
                                </div>

                                <div class="form-group">
                                    <label>File Media (Foto/Video)</label>
                                    <div id="media-inputs">
                                        <div class="input-group mb-2">
                                            <input type="file" name="media_file[]" class="form-control" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-media-btn">&times;</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary" id="add-media-btn">
                                        + Tambah File Media
                                    </button>
                                    <small class="form-text text-muted">
                                        Bisa upload lebih dari satu file. Jenis file: jpg, jpeg, png, mp4.
                                    </small>
                                </div>

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

        </div>
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
                                        @foreach ($item->media as $media)
                                            @if ($media->jenis_media == 'foto')
                                                <img src="{{ asset($media->media_path) }}" height="80" class="mr-2 mb-2" style="border-radius:5px;">
                                            @elseif ($media->jenis_media == 'video')
                                                <video width="120" controls class="mb-2">
                                                    <source src="{{ asset($media->media_path) }}" type="video/mp4">
                                                </video>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($item->media as $media)
                                            <span class="badge badge-{{ $media->jenis_media == 'foto' ? 'info' : 'warning' }}">
                                                {{ ucfirst($media->jenis_media) }}
                                            </span><br>
                                        @endforeach
                                    </td>
                                    <td>{{ $item->deskripsi }}</td>
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
                                                <form action="{{ route('dokumentasi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
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
                                                    
                                                    <div class="form-group">
                                                        
                                                        <label>Tambah File Media Baru</label>
                                                        <input type="file" class="form-control" name="media_file[]" multiple>
                                                        <small class="form-text text-muted">
                                                            Kosongkan jika tidak ingin menambahkan media baru.
                                                        </small>
                                                    </div>
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
@endpush
