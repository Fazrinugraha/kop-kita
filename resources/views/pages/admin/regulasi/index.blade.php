@extends('pages.admin.layout.main')

@push('head')
<!-- DataTables CSS -->
<link href="{{ asset('themes/back/libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/back/libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Menu Utama</a></li>
                        <li class="breadcrumb-item active">Regulasi</li>
                    </ol>
                </div>
                <h4 class="page-title">Daftar Regulasi</h4>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endif
    @if(session('failed'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('failed') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endif

    <!-- Tambah Button -->
    <div class="mb-3 text-right">
        <button class="btn btn-primary" data-toggle="modal" data-target=".form-tambah">
            <i class="mdi mdi-plus"></i> Tambah Regulasi
        </button>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade form-tambah" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.regulasi.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Regulasi</h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Regulasi</label>
                        <input type="text" class="form-control" name="nama_regulasi" required>
                    </div>
                    <div class="form-group">
                        <label>Upload Dokumen (PDF)</label>
                        <input type="file" class="form-control" name="file_dokumen" accept=".pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card-box">
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%;">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Regulasi</th>
                        <th>File Dokumen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($regulasi as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nama_regulasi }}</td>
                        <td>
                            @if($item->file_dokumen)
                            <a href="{{ asset($item->file_dokumen) }}" target="_blank">Lihat Dokumen</a>
                            @else
                            <span class="text-muted">Tidak ada file</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".form-edit{{ $item->id }}">
                                <i class="mdi mdi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".form-hapus{{ $item->id }}">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade form-edit{{ $item->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <form action="{{ route('admin.regulasi.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Regulasi</h5>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Regulasi</label>
                                        <input type="text" class="form-control" name="nama_regulasi" value="{{ $item->nama_regulasi }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Ganti File Dokumen (Opsional)</label>
                                        <input type="file" class="form-control" name="file_dokumen" accept=".pdf">
                                    </div>
                                    @if($item->file_dokumen)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ asset($item->file_dokumen) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade form-hapus{{ $item->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <form action="{{ route('admin.regulasi.destroy', $item->id) }}" method="POST" class="modal-content">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Regulasi</h5>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus regulasi <strong>{{ $item->nama_regulasi }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
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
