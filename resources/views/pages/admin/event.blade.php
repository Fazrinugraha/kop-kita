@extends('pages.admin.layout.main')

@push('head')
    <!-- Table datatable css -->
    <link href="{{ asset('themes/back/') }}/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
    <link href="{{ asset('themes/back/') }}/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/back/') }}/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/back/') }}/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@endpush

@section('content')
<div class="container-fluid">

    <!-- start page title -->
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
    <!-- end page title --> 

    <div class="row">
        <div class="col-12 mb-4">
            
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="btn btn-primary float-right" data-toggle="modal" data-target=".form-tambah">
                <span class="btn-label"><i class="mdi mdi-plus"></i>
                </span>Tambah Data
            </div>

            <div class="modal fade form-tambah" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="scard-box">

                                <div class="row">
                                    <div class="col-xl-12">
                                        <form action="{{ route('store.event') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>File Gambar</label>
                                                <input type="file" class="form-control" accept="image/png, image/jpeg" name="file_gambar" required>
                                                <small class="text-muted">Ukuran file tidak lebih dari 2MB</small>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Kegiatan</label>
                                                <input type="text" class="form-control" name="nama_kegiatan" placeholder="Nama Kegiatan">
                                            </div>
                                            <div class="form-group">
                                                <label>Bindang Kegiatan</label>
                                                <input type="text" class="form-control" name="bidang_kegiatan" placeholder="Bindang Kegiatan">
                                            </div>
                                            <div class="form-group">
                                                <label>Lokasi</label>
                                                <input type="text" class="form-control" name="lokasi" placeholder="Lokasi">
                                            </div>

                                            <div class="form-group">
                                                <label>Link Event</label>
                                                <input type="text" class="form-control" name="link" placeholder="Link">
                                            </div>

                                            <div class="form-group">
                                                <label>Nama Link</label>
                                                <input type="text" class="form-control" name="nama_link" placeholder="Misal: Official Website, Pendaftaran, dll">
                                            </div>

                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div><!-- end col -->

                                </div><!-- end row -->
                            </div>
                            
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            
        </div>
    </div>
                        
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Foto Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Bidang Kegiatan</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Link</th>
                            <th>View</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @forelse ($dataview->event as $item)
                            <tr>
                                <th width="10" scope="row">{{ $nomor++ }}</th>
                                <td nowrap>{{ tanggalIndonesia($item->tanggal) }}</td>
                                <td>
                                    <img src="{{ asset($item->file_gambar) }}" height="150">
                                </td>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>{{ $item->bidang_kegiatan }}</td>
                                <td nowrap>{{ $item->lokasi }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td><a href="{{ $item->link }}">{{ $item->nama_link }}</a></td>
                                <td><i class="mdi mdi-eye"></i> {{ $item->view }}</td>
                                <td nowrap>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".form-edit{{ $item->id_event }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".form-hapus{{ $item->id_event }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade form-edit{{ $item->id_event }}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <div class="scard-box">
                
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <form action="{{ route('update.event', $item->id_event) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group text-center">
                                                                <img src="{{ asset($item->file_gambar) }}" class="img-fluid">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>File Gambar (Kosongkan jika tidak ingin mengganti gambar)</label>
                                                                <input type="file" class="form-control" accept="image/png, image/jpeg" name="file_gambar">
                                                                <small class="text-muted">Ukuran file tidak lebih dari 2MB</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tanggal</label>
                                                                <input type="date" class="form-control" name="tanggal" value="{{ $item->tanggal }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Kegiatan</label>
                                                                <input type="text" class="form-control" name="nama_kegiatan" placeholder="Nama Kegiatan" value="{{ $item->nama_kegiatan }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Bindang Kegiatan</label>
                                                                <input type="text" class="form-control" name="bidang_kegiatan" placeholder="Bindang Kegiatan" value="{{ $item->bidang_kegiatan }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Lokasi</label>
                                                                <input type="text" class="form-control" name="lokasi" placeholder="Lokasi" value="{{ $item->lokasi }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Link Event</label>
                                                                <input type="text" class="form-control" name="link" placeholder="Link" value="{{ $item->link }}">
                                                            </div>
                
                                                            <div class="form-group">
                                                                <label>Nama Link</label>
                                                                <input type="text" class="form-control" name="nama_link" placeholder="Misal: Official Website, Pendaftaran, dll" value="{{ $item->nama_link }}">
                                                            </div>


                                                            <div class="form-group">
                                                                <label>Deskripsi</label>
                                                                <textarea class="form-control" name="deskripsi" placeholder="Deskripsi">{{ $item->deskripsi }}</textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </form>
                                                    </div><!-- end col -->
                
                                                </div><!-- end row -->
                                            </div>
                                            
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>

                            <div class="modal fade form-hapus{{ $item->id_event }}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <div class="scard-box">
                
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <form action="{{ route('delete.event', $item->id_event) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('DELETE')
                                                            <p>
                                                                <b>Apakah anda ingin menghapus data ini?</b>
                                                            </p>
                                                            
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        </form>
                                                    </div><!-- end col -->
                
                                                </div><!-- end row -->
                                            </div>
                                            
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>

                            @empty
                            <tr>
                                <th colspan="8" class="text-center">Tidak ada data</th>
                            </tr>
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
<script src="{{ asset('themes/back/') }}/libs/select2/select2.min.js"></script>
<script src="{{ asset('themes/back/') }}/js/pages/form-advanced.init.js"></script>

<!-- Datatable plugin js -->
<script src="{{ asset('themes/back/') }}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('themes/back/') }}/libs/datatables/dataTables.bootstrap4.min.js"></script>

<script src="{{ asset('themes/back/') }}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{ asset('themes/back/') }}/libs/datatables/responsive.bootstrap4.min.js"></script>

<script src="{{ asset('themes/back/') }}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{ asset('themes/back/') }}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{ asset('themes/back/') }}/libs/jszip/jszip.min.js"></script>
<script src="{{ asset('themes/back/') }}/libs/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('themes/back/') }}/libs/pdfmake/vfs_fonts.js"></script>

<script src="{{ asset('themes/back/') }}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{ asset('themes/back/') }}/libs/datatables/buttons.print.min.js"></script>

<script src="{{ asset('themes/back/') }}/libs/datatables/dataTables.keyTable.min.js"></script>
<script src="{{ asset('themes/back/') }}/libs/datatables/dataTables.select.min.js"></script>

<!-- Datatables init -->
<script src="{{ asset('themes/back/') }}/js/pages/datatables.init.js"></script>
{{-- <script>
    $('#example').DataTable({
        responsive: false, // Menonaktifkan responsive
        // Tambahkan opsi lain jika diperlukan
        paging: true,
        searching: true,
        ordering: true,
    });
</script> --}}

@endpush