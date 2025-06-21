@extends('pages.admin.layout.main')

@push('head')

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

    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title mb-4">Informasi</h4>
                <hr>
                <form action="{{ route('update.tentang', $tentang->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            @if(empty($tentang->file_gambar))
                            <center><i>Tidak ada gambar</i></center>
                            <br>
                            @else
                            <div class="form-group text-center">
                                <img src="{{ asset($tentang->file_gambar) }}" height="200">
                            </div>
                            @endif
                            
                            <div class="form-group">
                                <label>File Gambar</label>
                                <input type="file" class="form-control" accept="image/png, image/jpeg" name="file_gambar">
                                <small class="text-muted">Ukuran file tidak lebih dari 2MB</small>
                            </div>
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Ketik Judul" value="{{ $tentang->judul }}" required>
                            </div>
                            <div class="form-group">
                                <label>Isi / Deskripsi</label>
                                <textarea class="form-control" id="editor" rows="3" name="isi" placeholder="Ketik deskripsi" required>{{ $tentang->isi }}</textarea>
                            </div>
                            
                        </div><!-- end col -->
                        
                        <div class="col-12">
                            <hr>
                            <button class="btn btn-primary waves-effect waves-light float-right">
                                <span class="btn-label"><i class="mdi mdi-content-save"></i>
                                </span>Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('script')
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', {
        versionCheck: false,
    });
</script>
@endpush