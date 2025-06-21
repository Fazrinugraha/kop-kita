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
                <span class="btn-label"><i class="mdi mdi-plus"></i></span>Tambah Data
            </div>

            <!-- Modal Form Tambah FAQ -->
            <div class="modal fade form-tambah" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah FAQ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="scard-box">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <form action="{{ route('manage-faq.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Pertanyaan</label>
                                                <input type="text" class="form-control" name="question" placeholder="Pertanyaan" autocomplete="false">
                                            </div>
                                            <div class="form-group">
                                                <label>Jawaban</label>
                                                <textarea class="form-control" name="answer" placeholder="Jawaban"></textarea>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="active" selected>Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div> --}}
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
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                                {{-- <th>Status</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @forelse ($dataview->faq as $item)
                            <tr>
                                <th width="10" scope="row">{{ $nomor++ }}</th>
                                <td>{{ $item->question }}</td>
                                <td>{{ $item->answer }}</td>
                                {{-- <td>{{ $item->status }}</td> --}}
                                <td nowrap>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".form-edit{{ $item->id }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".form-hapus{{ $item->id }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Edit FAQ -->
                            <div class="modal fade form-edit{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit FAQ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="scard-box">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                        <form action="{{ route('manage-faq.update', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label>Pertanyaan</label>
                                                                <input type="text" class="form-control" name="question" value="{{ $item->question }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Jawaban</label>
                                                                <textarea class="form-control" name="answer">{{ $item->answer }}</textarea>
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <label>Status</label>
                                                                <select class="form-control" name="status">
                                                                    <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active</option>
                                                                    <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                                </select>
                                                            </div> --}}
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </form>
                                                    </div><!-- end col -->
                                                </div><!-- end row -->
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>

                            <!-- Modal Hapus FAQ -->
                            <div class="modal fade form-hapus{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus FAQ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="scard-box">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <form action="{{ route('manage-faq.destroy', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <p>
                                                                <b>Apakah Anda yakin ingin menghapus FAQ ini?</b>
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
                                <th colspan="4" class="text-center">Tidak ada data</th>
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
