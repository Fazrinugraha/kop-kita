@extends('pages.admin.layout.main')

@push('head')
<link href="{{ asset('themes/back/libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/back/libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title">Daftar Pesan Kontak</h4>

                <div class="table-responsive mt-3">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                        <thead class="thead-light">
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
                                    <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="btn btn-sm btn-primary">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
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
@endsection

@push('script')
<script src="{{ asset('themes/back/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/back/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/back/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>
@endpush
