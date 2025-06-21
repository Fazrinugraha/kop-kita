@extends('pages.admin.layout.main')


@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Edit Regulasi</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="{{ route('admin.regulasi.update', $regulasi->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama_regulasi">Nama Regulasi</label>
        <input type="text" class="form-control" id="nama_regulasi" name="nama_regulasi" value="{{ old('nama_regulasi', $regulasi->nama_regulasi) }}" required>
    </div>

    <div class="form-group">
        <label for="file_dokumen">File Dokumen (PDF atau DOC)</label>
        <input type="file" class="form-control" id="file_dokumen" name="file_dokumen" accept=".pdf,.doc,.docx">
        @if($regulasi->file_dokumen)
            <p>File saat ini: <a href="{{ asset($regulasi->file_dokumen) }}" target="_blank">Lihat Dokumen</a></p>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Perbaharui</button>
    <a href="{{ route('admin.manage-regulasi.index') }}" class="btn btn-secondary">Batal</a>
</form>
</div>
@endsection
