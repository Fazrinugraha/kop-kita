@extends('pages.admin.layout.main')

@push('head')
<link href="{{ asset('themes/back/libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/back/libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between">
                <h4 class="page-title">{{ $dataview->page_title }}</h4>
                @if(!isset($edit))
                <button class="btn btn-primary" data-toggle="modal" data-target=".form-tambah">
                    <i class="mdi mdi-plus"></i> Tambah Sejarah
                </button>
                @endif
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
            @endif

            {{-- Modal Tambah --}}
            <div class="modal fade form-tambah" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <form action="{{ route('sejarah.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Sejarah</h5>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" class="form-control" name="tahun" required>
                            </div>
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control" name="judul" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>File Gambar (Opsional)</label>
                                <input type="file" class="form-control" name="file_gambar">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Edit --}}
            @if(isset($edit))
            <div class="modal fade show form-edit" tabindex="-1" role="dialog" style="display:block; background-color: rgba(0,0,0,.5);">
                <div class="modal-dialog modal-lg">
                    <form action="{{ route('sejarah.update', $sejarah->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Sejarah</h5>
                            <a href="{{ route('sejarah.index') }}" class="close">&times;</a>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" class="form-control" name="tahun" value="{{ $sejarah->tahun }}" required>
                            </div>
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control" name="judul" value="{{ $sejarah->judul }}" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="4" required>{{ $sejarah->deskripsi }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>File Gambar (Opsional)</label>
                                <input type="file" class="form-control" name="file_gambar">
                                @if($sejarah->file_gambar)
                                <div class="mt-2">
                                    <img src="{{ asset($sejarah->file_gambar) }}" alt="Gambar Sejarah" style="max-width: 200px;">
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="{{ route('sejarah.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            {{-- Tabel --}}
            <div class="card mt-3">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th>Tahun</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sejarahs as $item)
                            <tr>
                                <td>{{ $item->tahun }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ Str::limit($item->deskripsi, 100) }}</td>
                                <td>
                                    @if($item->file_gambar)
                                    <img src="{{ asset($item->file_gambar) }}" style="max-width: 100px;" alt="Gambar">
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('sejarah.index', ['edit' => $item->id]) }}" class="btn btn-sm btn-warning">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <form action="{{ route('sejarah.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center">Belum ada data sejarah.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('themes/back/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/back/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/back/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>
@endpush
