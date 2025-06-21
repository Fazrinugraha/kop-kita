@extends('pages.admin.layout.auth')

@push('head')
	
@endpush

@section('content')
<div class="account-pages pt-5 my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="text-center">
                    <div class="my-3">
                        <a href="javascript:;">
                            <span><img src="{{ asset('assets/front/') }}/images/logo-putih.png" alt="" height="90"></span>
                        </a>
                    </div>
                </div>
                <div class="account-card-box">
                    <div class="card mb-0" style="border: unset;">
                        <div class="card-body p-4">
                            
                            <div class="text-center">
                                <h5 class="text-muted text-uppercase py-3 font-16">Selamat Datang</h5>
                            </div>

                            <form id="formLogin" action="{{ route('login') }}" class="mt-2" method="POST">
                                @csrf
                                
                                <div id="bfErrorMessage" class="alert alert-info text-center">
                                    Silakan login menggunakan akun Anda
                                </div>
                                
                                <!--<div id="errorMessage" class="alert alert-warning"></div>-->

                                <div class="form-group mb-3">
                                    <label>Username</label>
                                    <input class="form-control" type="text" id="username" name="username" placeholder="Username Anda" value="{{ old('username') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Password</label>
                                    <input class="form-control" type="password" id="password" name="password" placeholder="Masukkan password">
                                </div>

                                {{-- <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                        <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div> --}}

                                <div class="form-group text-center">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit"> Log In </button>
                                </div>
                                
                                <a href="{{ url('/') }}" class="text-muted"><i class="mdi mdi-chevron-left mr-1"></i> Kembali</a>
                                
                                {{-- <a href="javascript:;" class="text-muted float-right" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-lock mr-1"></i> Lupa password?</a> --}}
                                
                                {{-- <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Lupa password?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <ul>
                                                    <li>Untuk melakukan reset password, calon peserta didik bisa mengajukan reset
                                                        password ke Admin Dinas Pendidikan.</li>
                                                    <li>Bagi Anda yang mendaftar mandiri (Peserta didik Non-Dapodik), silakan
                                                        hubungi Sekolah SMP Terdekat.</li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div> --}}
                                <hr>

                            </form>

                            <div class="text-center mt-4">
                                
                                <div class="row">
                                    <div class="col-12">
                                        {{-- <button type="button" class="btn btn-facebook waves-effect font-14 waves-light mt-3">
                                            <i class="fab fa-facebook-f mr-1"></i> Facebook
                                        </button> --}}
    
                                        {{-- <a href="{{ url('registrasi') }}" class="btn btn-twitter waves-effect font-14 waves-light">
                                            <i class="fas fa-user-plus mr-1"></i> Pendaftaran Akun
                                        </a> --}}
    
                                        {{-- <button type="button" class="btn btn-googleplus waves-effect font-14 waves-light mt-3">
                                            <i class="fab fa-google-plus-g mr-1"></i> Google+
                                        </button> --}}
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">
                            {{ date('Y') > '2024' ? '2024 - '.date('Y') : '2024' }} &copy; {{ getTitle() }}
                        </p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
@endsection

@push('script')
<script>
document.getElementById("bfErrorMessage").classList.remove("alert-warning");
document.getElementById("bfErrorMessage").classList.add("alert-info");
document.getElementById("bfErrorMessage").innerHTML = "Silakan login menggunakan akun Anda";

document.getElementById("formLogin").addEventListener("submit", function(event) {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Menampilkan pesan validasi login
    const bfErrorMessage = document.getElementById("bfErrorMessage");
    bfErrorMessage.classList.remove("alert-info", "alert-warning");
    bfErrorMessage.classList.add("alert-info");
    bfErrorMessage.innerHTML = "Validasi login...";

    if (!username) {
        event.preventDefault(); // Prevent form submission
        bfErrorMessage.classList.remove("alert-info");
        bfErrorMessage.classList.add("alert-warning");
        bfErrorMessage.innerHTML = "<i class='mdi mdi-alert-circle mr-1'></i> Kolom username wajib diisi!";
    } else if (!password) {
        event.preventDefault(); // Prevent form submission
        bfErrorMessage.classList.remove("alert-info");
        bfErrorMessage.classList.add("alert-warning");
        bfErrorMessage.innerHTML = "<i class='mdi mdi-alert-circle mr-1'></i> Password tidak boleh kosong!";
    }
});
</script>

@endpush