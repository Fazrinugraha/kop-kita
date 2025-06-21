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
                                        <form action="{{ route('store.portofolio') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Bidang Layanan</label>
                                                <select class="form-control" name="id_jasa" required>
                                                    <option value="">Tentukan</option>
                                                    @foreach ($dataview->jasa as $js)
                                                    <option value="{{ $js->id_jasa }}">{{ $js->nama_jasa }}</option>    
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select class="form-control" name="kategori">
                                                    <option value="Website">Website</option>
                                                    <option value="Web App">Web App</option>
                                                    <option value="Android App">Android App</option>
                                                    <option value="iOS App">iOS App</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>File Icon</label>
                                                <input type="file" class="form-control" accept="image/png, image/jpeg" name="file_icon" required>
                                                <small class="text-muted">Ukuran file tidak lebih dari 2MB</small>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk">
                                            </div>
                                            <div class="form-group">
                                                <label>Link</label>
                                                <input type="text" class="form-control" name="link" placeholder="Link">
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi Produk</label>
                                                <textarea class="form-control" name="deskripsi" placeholder="Deskripsi Produk"></textarea>
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
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Bidang Layanan</th>
                            <th>Icon</th>
                            <th>Nama Produk</th>
                            <th>Link</th>
                            <th>View</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @forelse ($dataview->portofolio as $item)
                            <tr>
                                <th width="10" scope="row">{{ $nomor++ }}</th>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->nama_jasa }}</td>
                                <td class="text-center">
                                    <img src="{{ asset($item->file_icon) }}" height="150">
                                </td>
                                <td>{!! $item->nama_produk !!}</td>
                                <td><a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a></td>
                                <td><i class="mdi mdi-eye"></i> {{ $item->view }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".form-edit{{ $item->id_portofolio }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".form-hapus{{ $item->id_portofolio }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade form-edit{{ $item->id_portofolio }}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                                                        <form action="{{ route('update.portofolio', $item->id_portofolio) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group text-center">
                                                                <img src="{{ asset($item->file_icon) }}" class="img-fluid">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Bidang Layanan</label>
                                                                <select class="form-control" name="id_jasa" required>
                                                                    <option value="">Tentukan</option>
                                                                    @foreach ($dataview->jasa as $js)
                                                                    <option value="{{ $js->id_jasa }}" {{ $js->id_jasa==$item->id_jasa ? 'selected' : '' }}>{{ $js->nama_jasa }}</option>    
                                                                    @endforeach
                                                                    
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Kategori</label>
                                                                <select class="form-control" name="kategori">
                                                                    <option value="Website" {{ $item->kategori=='Website' ? 'selected' : '' }}>Website</option>
                                                                    <option value="Web App" {{ $item->kategori=='Web App' ? 'selected' : '' }}>Web App</option>
                                                                    <option value="Android App" {{ $item->kategori=='Android App' ? 'selected' : '' }}>Android App</option>
                                                                    <option value="iOS App" {{ $item->kategori=='iOS App' ? 'selected' : '' }}>iOS App</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>File Icon (Kosongkan jika tidak ingin mengganti gambar)</label>
                                                                <input type="file" class="form-control" accept="image/png, image/jpeg" name="file_icon">
                                                                <small class="text-muted">Ukuran file tidak lebih dari 2MB</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Produk</label>
                                                                <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk" value="{{ $item->nama_produk }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Link</label>
                                                                <input type="text" class="form-control" name="link" placeholder="Link" value="{{ $item->link }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Deskripsi Produk</label>
                                                                <textarea class="form-control" name="deskripsi" placeholder="Deskripsi Produk">{{ $item->deskripsi }}</textarea>
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

                            <div class="modal fade form-hapus{{ $item->id_portofolio }}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                                                        <form action="{{ route('delete.portofolio', $item->id_portofolio) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="form-group text-center">
                                                                <img src="{{ asset($item->file_icon) }}" class="img-fluid">
                                                            </div>
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
                                <th colspan="7" class="text-center">Tidak ada data</th>
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