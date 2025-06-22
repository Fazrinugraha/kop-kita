@extends('pages.admin.layout.main')

@push('head')
    <link href="{{ asset('themes/back/') }}/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/back/') }}/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/back/') }}/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/back/') }}/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button class="btn btn-primary float-right" data-toggle="modal" data-target=".form-tambah">
                <i class="mdi mdi-plus"></i> Tambah Lowongan
            </button>

            @include('pages.admin.karir.modal_tambah')
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
                                <th>Posisi</th>
                                <th>Divisi</th>
                                <th>Penempatan</th>
                                <th>Deskripsi</th>
                                <th>Kualifikasi</th>
                                <th>Benefit</th>
                                <th>Batas Lamar</th>
                                <th>Kuota</th>
                                <th>Status</th>
                                <th>Dokumen Syarat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataview->karir as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->judul_posisi }}</td>
                                <td>{{ $item->divisi }}</td>
                                <td>{{ $item->penempatan }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->kualifikasi }}</td>
                                <td>{{ $item->benefit ?? '-' }}</td>
                                <td>{{ $item->batas_lamar ? tanggal_indo($item->batas_lamar) : '-' }}</td>
                                <td>{{ $item->kuota }}</td>
                                <td>
                                    <span class="badge {{ $item->status == 'Aktif' ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>
                                    @if ($item->dokumen_syarat)
                                        <a href="{{ asset($item->dokumen_syarat) }}" target="_blank">Lihat Dokumen</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target=".form-edit{{ $item->id_karir }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target=".form-hapus{{ $item->id_karir }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>

                            @include('pages.admin.karir.modal_edit', ['item' => $item])
                            @include('pages.admin.karir.modal_hapus', ['item' => $item])

                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
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
<script src="{{ asset('themes/back/') }}/js/pages/datatables.init.js"></script>
@endpush
