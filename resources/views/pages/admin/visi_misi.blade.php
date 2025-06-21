@extends('pages.admin.layout.main')

@push('head')
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $dataview->page_title }}</h4>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form edit hanya jika $visiMisi tersedia --}}
    @isset($visiMisi)
    <div class="card-box">
        <h4 class="header-title mb-4">Edit Visi & Misi</h4>
        <form action="{{ route('visi_misi.update', $visiMisi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="jenis">Jenis</label>
                <select class="form-select" name="jenis" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Visi" {{ old('jenis', $visiMisi->jenis) == 'Visi' ? 'selected' : '' }}>Visi</option>
                    <option value="Misi" {{ old('jenis', $visiMisi->jenis) == 'Misi' ? 'selected' : '' }}>Misi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" name="judul" value="{{ old('judul', $visiMisi->judul) }}" required>
            </div>

            <div class="form-group">
                <label for="isi">Isi</label>
                <textarea class="form-control" name="isi" rows="4" required>{{ old('isi', $visiMisi->isi) }}</textarea>
            </div>

            <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" class="form-control" name="urutan" value="{{ old('urutan', $visiMisi->urutan) }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    <hr>
    @endisset

    {{-- Daftar Visi Misi --}}
    <div class="card-box">
        <h4 class="header-title mb-4">Daftar Visi & Misi</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visiMisis as $item)
                <tr>
                    <td>{{ $item->jenis }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{!! Str::limit(strip_tags($item->isi), 100) !!}</td>
                    <td>{{ $item->urutan }}</td>
                    <td>
                        <a href="{{ route('visi_misi.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('visi_misi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
