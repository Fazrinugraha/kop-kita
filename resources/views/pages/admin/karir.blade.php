@extends('pages.admin.layout.main')

@push('head')
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

            @include('pages.admin.karir.modal_tambah')
            
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
                            <th>Foto</th>
                            <th>Judul Posisi</th>
                            <th>Divisi</th>
                            <th>Penempatan</th>
                            <th>Deskripsi</th>
                            <th>Kualifikasi</th>
                            <th>Benefit</th>
                            <th>Batas Lamar</th>
                            <th>Kuota</th>
                            <th>Status</th>
                            <th>View</th>
                            <th>Dokumen Syarat</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @forelse ($dataview->karir as $item)
                            <tr>
                                <th width="10" scope="row">{{ $nomor++ }}</th>
                                <td>
                                    @if($item->foto)
                                        <img src="{{ asset($item->foto) }}" height="150">
                                    @endif
                                </td>
                                <td>{{ $item->judul_posisi }}</td>
                                <td>{{ $item->divisi }}</td>
                                <td>{{ $item->penempatan }}</td>
                                <td>{!! Str::limit($item->deskripsi, 50) !!}</td>
                                <td>{!! Str::limit($item->kualifikasi, 50) !!}</td>
                                <td>{{ $item->benefit ?? '-' }}</td>
                                <td>{{ $item->batas_lamar ? tanggal_indo($item->batas_lamar) : '-' }}</td>
                                <td>{{ $item->kuota }}</td>
                                <td>
                                    <span class="badge {{ $item->status == 'Aktif' ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>{{ $item->view ?? 0 }}</td>
                                <td>
                                    @if ($item->dokumen_syarat)
                                        <a href="{{ asset($item->dokumen_syarat) }}" target="_blank">Lihat Dokumen</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td nowrap>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".form-edit{{ $item->id_karir }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".form-hapus{{ $item->id_karir }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>

                            @include('pages.admin.karir.modal_edit', ['item' => $item])
                            @include('pages.admin.karir.modal_hapus', ['item' => $item])

                            @empty
                            <tr>
                                <th colspan="13" class="text-center">Tidak ada data</th>
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
@endpush
