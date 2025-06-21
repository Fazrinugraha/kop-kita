@extends('pages.admin.layout.main')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Daftar Regulasi</h1>
    <a href="{{ route('admin.regulasi.create') }}" class="btn btn-primary mb-3">Tambah Regulasi Baru</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Regulasi</th>
                <th>File Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($regulasi as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_regulasi }}</td>
<td>
    @if($item->file_dokumen)
        <a href="{{ asset($item->file_dokumen) }}" target="_blank">Lihat Dokumen</a>
    @else
        Tidak ada file
    @endif
</td>
                <td>
                    <a href="{{ route('admin.regulasi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.regulasi.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus regulasi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
