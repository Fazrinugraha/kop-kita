@extends('pages.admin.layout.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="header-title">Detail Pesan</h4>
                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm btn-secondary">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <strong>Nama Lengkap:</strong>
                        <p>{{ $contact->name }} {{ $contact->surname }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        <p>{{ $contact->email }}</p>
                    </div>
                </div>

                <div class="mb-2">
                    <strong>Subjek:</strong>
                    <p>{{ $contact->subject ?? 'Tanpa Subjek' }}</p>
                </div>

                <div class="mb-3">
                    <strong>Pesan:</strong>
                    <div class="border p-3 bg-light rounded">
                        {!! nl2br(e($contact->message)) !!}
                    </div>
                </div>

                <div class="mb-2">
                    <strong>Dikirim Pada:</strong>
                    <p>{{ $contact->created_at->format('d M Y H:i') }}</p>
                </div>

                {{-- Optional delete feature --}}
                {{-- 
                <form action="{{ route('admin.contact-messages.destroy', $contact->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Hapus pesan ini?')">
                        <i class="mdi mdi-delete"></i> Hapus Pesan
                    </button>
                </form> 
                --}}
            </div>
        </div>
    </div>
</div>
@endsection
