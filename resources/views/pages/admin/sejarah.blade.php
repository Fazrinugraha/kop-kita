@extends('pages.admin.layout.main')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">{{ $dataview->page_title }}</h2>

    {{-- Tampilkan pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Tambah atau Edit --}}
    <div class="card mb-4">
        <div class="card-header">
            @if(isset($edit))
                Edit Sejarah
            @else
                Tambah Sejarah
            @endif
        </div>
        <div class="card-body">
            <form action="{{ isset($edit) ? route('sejarah.update', $sejarah->id) : route('sejarah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($edit))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" class="form-control" id="tahun" name="tahun" value="{{ old('tahun', $sejarah->tahun ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $sejarah->judul ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $sejarah->deskripsi ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="file_gambar" class="form-label">File Gambar (Opsional)</label>
                    <input type="file" class="form-control" id="file_gambar" name="file_gambar">
                    @if(isset($edit) && $sejarah->file_gambar)
                        <div class="mt-2">
                            <img src="{{ asset($sejarah->file_gambar) }}" alt="Gambar Sejarah" style="max-width: 200px;">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($edit) ? 'Update' : 'Simpan' }}
                </button>
                @if(isset($edit))
                    <a href="{{ route('sejarah.index') }}" class="btn btn-secondary">Batal</a>
                @endif
            </form>
        </div>
    </div>

    {{-- Tabel Daftar Sejarah --}}
    <div class="card">
        <div class="card-header">Daftar Sejarah</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sejarahs as $item)
                        <tr>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ Str::limit($item->deskripsi, 100) }}</td>
                            <td>
                                @if($item->file_gambar)
                                    <img src="{{ asset($item->file_gambar) }}" style="max-width: 100px;" alt="Gambar">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('sejarah.index', ['edit' => $item->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('sejarah.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Belum ada data sejarah.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
