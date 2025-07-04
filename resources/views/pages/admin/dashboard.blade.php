@extends('pages.admin.layout.main')

@push('head')
<style>
    .step-container {
        border: 1px solid #ccc;
        border-style: dashed;
        border-radius: 15px;
        padding: 20px 20px 30px 20px;

        display: flex;
        justify-content: space-between; /* Memposisikan ke tengah */
        align-items: center;
        margin: 0 auto; /* Menengahkan container */
        max-width: 600px; /* Menambahkan max-width untuk menjaga agar tahapan tidak terlalu lebar */
    }

    .step {
        height: 50px;
        border-radius: 50%;
        text-align: center;
        line-height: 40px; /* Menyesuaikan teks menjadi vertikal tengah */
        font-size: 34px;
        margin: 0 5px;
    }

    .step-title {
        font-size: 14px;
        text-align: center;
    }

    .line {
        width: 50px; /* Sesuaikan panjang garis di sini */
        height: 1px; /* Sesuaikan ketebalan garis di sini */
        background-color: #ccc; /* Sesuaikan warna garis di sini */
    }
    
    @media screen and (max-width: 600px) {
        .step {
            width: 55px;
            height: 30px;
            line-height: 30px; /* Menyesuaikan teks menjadi vertikal tengah */
            font-size: 24px;
        }

        .step-title {
            font-size: 10px;
            text-align: center;
        }
    }
    
    .cover-berita {
        object-fit: cover;
        width: 100%;
        height: 300px; /* Sesuaikan tinggi sesuai kebutuhan */
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Utama</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

	<div class="row">
        <div class="col-12">
            
            <div class="card-box">
                <h4 class="title">Selamat datang, {{ Auth::guard('admin')->user()->nama }}</h4>
                
            </div>
        </div>
    </div>

    <div class="row">
		<div class="col-md-12">

			<div class="row">
				<div class="col-md-3 col-6">
					<a href="{{ url('manage-slider') }}">
					<div class="card">
						<div class="row no-gutters align-items-center">
							<div class="col-md-5 text-center">
							<i class="mdi mdi-image-area" style="font-size: 40px;"></i>
							</div>
							<div class="col-md-7">
								<div class="card-body py-2">
									<h5 class="card-title">Slider</h5>
									<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_slider) }}</h2>
								</div>
							</div>
						</div>
					</div>
					</a>
					
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('manage-team') }}">
					<div class="card">
						<div class="row no-gutters align-items-center">
							<div class="col-md-5 text-center">
							<i class="mdi mdi-account-group" style="font-size: 40px;"></i>
							</div>
							<div class="col-md-7">
								<div class="card-body py-2">
									<h5 class="card-title">Team</h5>
									<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_team) }}</h2>
								</div>
							</div>
						</div>
					</div>
					</a>
					
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('manage-service') }}">
					<div class="card">
						<div class="row no-gutters align-items-center">
							<div class="col-md-5 text-center">
							<i class="mdi mdi-buffer" style="font-size: 40px;"></i>
							</div>
							<div class="col-md-7">
								<div class="card-body py-2">
									<h5 class="card-title">Service</h5>
									<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_layanan) }}</h2>
								</div>
							</div>
						</div>
					</div>
					</a>
					
				</div>
				
				<div class="col-md-3 col-6">
					<a href="{{ url('manage-mitra') }}">
					<div class="card">
						<div class="row no-gutters align-items-center">
							<div class="col-md-5 text-center">
							<i class="mdi mdi-account-tie" style="font-size: 40px;"></i>
							</div>
							<div class="col-md-7">
								<div class="card-body py-2">
									<h5 class="card-title">Mitra / Partner</h5>
									<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_mitra) }}</h2>
								</div>
							</div>
						</div>
					</div>
					</a>
					
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('manage-artikel') }}">
					<div class="card">
						<div class="row no-gutters align-items-center">
							<div class="col-md-5 text-center">
							<i class="mdi mdi-pencil" style="font-size: 40px;"></i>
							</div>
							<div class="col-md-7">
								<div class="card-body py-2">
									<h5 class="card-title">Blog / Artikel</h5>
									<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_artikel) }}</h2>
								</div>
							</div>
						</div>
					</div>
					</a>

				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('visi-misi') }}">
						<div class="card">
							<div class="row no-gutters align-items-center">
								<div class="col-md-5 text-center">
								<i class="mdi mdi-eye" style="font-size: 40px;"></i>
								</div>
								<div class="col-md-7">
									<div class="card-body py-2">
										<h5 class="card-title">Visi Misi</h5>
										<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_visimisi) }}</h2>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('sejarah') }}">
						<div class="card">
							<div class="row no-gutters align-items-center">
								<div class="col-md-5 text-center">
								<i class="mdi mdi-book-open-variant" style="font-size: 40px;"></i>
								</div>
								<div class="col-md-7">
									<div class="card-body py-2">
										<h5 class="card-title">Sejarah</h5>
										<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_sejarah) }}</h2>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('manage-event') }}">
						<div class="card">
							<div class="row no-gutters align-items-center">
								<div class="col-md-5 text-center">
								<i class="mdi mdi-calendar-multiselect" style="font-size: 40px;"></i>
								</div>
								<div class="col-md-7">
									<div class="card-body py-2">
										<h5 class="card-title">Event</h5>
										<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_event) }}</h2>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('manage-karir') }}">
						<div class="card">
							<div class="row no-gutters align-items-center">
								<div class="col-md-5 text-center">
								<i class="mdi mdi-briefcase" style="font-size: 40px;"></i>
								</div>
								<div class="col-md-7">
									<div class="card-body py-2">
										<h5 class="card-title">Karir</h5>
										<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_karir) }}</h2>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('manage-regulasi') }}">
						<div class="card">
							<div class="row no-gutters align-items-center">
								<div class="col-md-5 text-center">
								<i class="mdi mdi-file-document" style="font-size: 40px;"></i>
								</div>
								<div class="col-md-7">
									<div class="card-body py-2">
										<h5 class="card-title">Regulasi</h5>
										<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_regulasi) }}</h2>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('manage-faq') }}">
						<div class="card">
							<div class="row no-gutters align-items-center">
								<div class="col-md-5 text-center">
								<i class="mdi mdi-comment-question-outline" style="font-size: 40px;"></i>
								</div>
								<div class="col-md-7">
									<div class="card-body py-2">
										<h5 class="card-title">FAQ</h5>
										<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_faq) }}</h2>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('manage-dokumentasi') }}">
						<div class="card">
							<div class="row no-gutters align-items-center">
								<div class="col-md-5 text-center">
								<i class="mdi mdi-camera-image" style="font-size: 40px;"></i>
								</div>
								<div class="col-md-7">
									<div class="card-body py-2">
										<h5 class="card-title">Dokumentasi</h5>
										<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_dokumentasi) }}</h2>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('manage-kontak') }}">
						<div class="card">
							<div class="row no-gutters align-items-center">
								<div class="col-md-5 text-center">
								<i class="mdi mdi-phone" style="font-size: 40px;"></i>
								</div>
								<div class="col-md-7">
									<div class="card-body py-2">
										<h5 class="card-title">Kontak</h5>
										<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_kontak) }}</h2>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('admin/contact-messages') }}">
						<div class="card">
							<div class="row no-gutters align-items-center">
								<div class="col-md-5 text-center">
								<i class="mdi mdi-email" style="font-size: 40px;"></i>
								</div>
								<div class="col-md-7">
									<div class="card-body py-2">
										<h5 class="card-title">Pesan Kontak</h5>
										<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_pesan) }}</h2>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 col-6">
					<a href="{{ url('manage-manfaat') }}">
						<div class="card">
							<div class="row no-gutters align-items-center">
								<div class="col-md-5 text-center">
								<i class="mdi mdi-star-outline" style="font-size: 40px;"></i>
								</div>
								<div class="col-md-7">
									<div class="card-body py-2">
										<h5 class="card-title">Manfaat</h5>
										<h2 class="mt-0 pt-2">{{ number_format($dataview->jum_manfaat) }}</h2>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				
			</div>
			
			
		</div>
	</div>

</div>
@endsection

@push('script')
<!-- Dashboard init js-->
<script src="{{ asset('themes/back/') }}/js/pages/dashboard.init.js"></script>

<script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>
<script type="text/javascript">
    document.addEventListener("adobe_dc_view_sdk.ready", function () {
        document.getElementById("view-pdf-btn").disabled = false;
    });
	function previewFile(nama_file) {
	    var adobeDCView = new AdobeDC.View({clientId: "b30b7254b3234b1bbc2b686aa39cf910"});
		adobeDCView.previewFile({
			content:{location: {url: "{{ url('storage') }}/"+nama_file}},
			metaData:{fileName: nama_file}
		}, {embedMode: "LIGHT_BOX"});
	}
</script>
@endpush