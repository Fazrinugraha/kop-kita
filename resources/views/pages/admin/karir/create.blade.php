@extends('pages.admin.layout.main')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Tambah Lowongan Karir</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="{{ route('store.karir') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="judul_posisi">Judul Posisi</label>
        <input type="text" class="form-control" id="judul_posisi" name="judul_posisi" value="{{ old('judul_posisi') }}" required>
    </div>

    <div class="form-group">
        <label for="divisi">Divisi</label>
        <input type="text" class="form-control" id="divisi" name="divisi" value="{{ old('divisi') }}" required>
    </div>

    <div class="form-group">
        <label for="penempatan">Penempatan</label>
        <input type="text" class="form-control" id="penempatan" name="penempatan" value="{{ old('penempatan') }}" required>
    </div>

    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
    </div>

    <div class="form-group">
        <label for="kualifikasi">Kualifikasi</label>
        <textarea class="form-control" id="kualifikasi" name="kualifikasi" rows="3" required>{{ old('kualifikasi') }}</textarea>
    </div>

    <div class="form-group">
        <label for="benefit">Benefit</label>
        <textarea class="form-control" id="benefit" name="benefit" rows="3">{{ old('benefit') }}</textarea>
    </div>

    <div class="form-group">
        <label for="batas_lamar">Batas Lamar</label>
        <input type="date" class="form-control" id="batas_lamar" name="batas_lamar" value="{{ old('batas_lamar') }}">
    </div>

    <div class="form-group">
        <label for="kuota">Kuota</label>
        <input type="number" class="form-control" id="kuota" name="kuota" min="0" value="{{ old('kuota', 0) }}" required>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Non Aktif" {{ old('status') == 'Non Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
    </div>

    <div class="form-group">
        <label for="dokumen_syarat">Dokumen Syarat (PDF, DOC, DOCX)</label>
        <input type="file" class="form-control" id="dokumen_syarat" name="dokumen_syarat" accept=".pdf,.doc,.docx">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('manage.karir') }}" class="btn btn-secondary">Batal</a>
</form>
</div>
@endsection
