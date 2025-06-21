@extends('pages.admin.layout.main')

@push('head')
    <!-- Table datatable css -->
    <link href="{{ asset('themes/back/') }}/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
    <link href="{{ asset('themes/back/') }}/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/back/') }}/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/back/') }}/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@endpush


@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Daftar Pesan Kontak</h4>
                    
                    <div class="table-responsive mt-3">
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Subjek</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $message->name }} {{ $message->surname }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->subject ?? 'Tanpa Subjek' }}</td>
                                    <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.contact-messages.show', $message->id) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        {{-- <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Hapus pesan ini?')">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


