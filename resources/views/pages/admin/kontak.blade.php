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
                <form action="{{ route('update.kontak', $kontak->id_kontak) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <label>Nama Lembaga</label>
                                <input type="text" class="form-control" name="nama_instansi" placeholder="Nama Lembaga" value="{{ $kontak->nama_instansi }}" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" placeholder="Alamat" required>{{ $kontak->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Link Google Maps</label>
                                <input type="url" class="form-control" name="link_google_map" placeholder="https://maps.google.com/..." value="{{ $kontak->link_google_map }}" required>
                                <small class="form-text text-muted">Masukkan URL lengkap peta Google Maps</small>
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="text" class="form-control" name="telpon" placeholder="Telepon" value="{{ $kontak->telpon }}" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email Lembaga" value="{{ $kontak->email }}" required>
                            </div>
                            <h4 class="header-title mb-4">Sosial Media</h4>
                            <hr>
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="text" class="form-control" name="sosmed_facebook" placeholder="Sosial Media Facebook" value="{{ $kontak->sosmed_facebook }}">
                            </div>
                            <div class="form-group">
                                <label>Instagram</label>
                                <input type="text" class="form-control" name="sosmed_instagram" placeholder="Sosial Media Instagram" value="{{ $kontak->sosmed_instagram }}">
                            </div>
                            <div class="form-group">
                                <label>YouTube</label>
                                <input type="text" class="form-control" name="sosmed_youtube" placeholder="Sosial Media YouTube" value="{{ $kontak->sosmed_youtube }}">
                            </div>
                            <h4 class="header-title mb-4">Website</h4>
                            <hr>
                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" class="form-control" name="website" placeholder="Website Resmi" value="{{ $kontak->website }}">
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

@endpush