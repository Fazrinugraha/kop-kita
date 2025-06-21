@extends('pages.admin.layout.main')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Tambah Regulasi Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="{{ route('admin.regulasi.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="nama_regulasi">Nama Regulasi</label>
        <input type="text" class="form-control" id="nama_regulasi" name="nama_regulasi" value="{{ old('nama_regulasi') }}" required>
    </div>

    <div class="form-group">
        <label for="file_dokumen">File Dokumen (PDF atau DOC)</label>
        <input type="file" class="form-control" id="file_dokumen" name="file_dokumen" accept=".pdf,.doc,.docx" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.manage-regulasi.index') }}" class="btn btn-secondary">Batal</a>
</form>
</div>
@endsection
