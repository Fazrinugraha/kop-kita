@extends('pages.admin.layout.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="header-title">Detail Pesan</h4>
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <p class="form-control-plaintext">{{ $contact->name }} {{ $contact->surname }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <p class="form-control-plaintext">{{ $contact->email }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Subjek</label>
                        <p class="form-control-plaintext">{{ $contact->subject ?? 'Tanpa Subjek' }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Pesan</label>
                        <div class="border p-3 bg-light rounded">
                            {!! nl2br(e($contact->message)) !!}
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Dikirim Pada</label>
                                <p class="form-control-plaintext">{{ $contact->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- <div class="mt-4">
                        <form action="{{ route('admin.contact-messages.destroy', $contact->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus pesan ini?')">
                                <i class="mdi mdi-delete"></i> Hapus Pesan
                            </button>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection