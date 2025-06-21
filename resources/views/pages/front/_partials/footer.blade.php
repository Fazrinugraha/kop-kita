<!-- Footer start -->
<footer class="bg-dark footer pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div>
                    <div class="mb-3">
                        <img src="{{ asset('assets/front/images/logo-putih.png') }}" alt="Kreasikita logo in white on a transparent background, stylized text with a creative and modern design, displayed in the website footer area" height="85">
                    </div>
                    <p class="pt-1 text-white-50">&nbsp;</p>
                    <p class="text-white-50">{{ getKontak()->nama_instansi }}</p>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="mt-3 mt-sm-0">
                    <h5 class="footer-title text-white font-16 mb-3">Sosial Media</h5>
                    <ul class="list-unstyled footer-list">
                        <li><a href="{{ getKontak()->sosmed_facebook }}" target="_blank"><i class="mdi mdi-facebook text-white font-18 mr-2 align-middle"></i> Facebook</a></li>
                        <li><a href="{{ getKontak()->sosmed_instagram }}" target="_blank"><i class="mdi mdi-instagram text-white font-18 mr-2 align-middle"></i> Instagram</a></li>
                        <li><a href="{{ getKontak()->sosmed_youtube}}" target="_blank"><i class="mdi mdi-youtube text-white font-18 mr-2 align-middle"></i> YouTube</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                {{-- <div class="mt-3 mt-sm-0">
                    <h5 class="footer-title text-white font-16 mb-3">Support</h5>
                    <ul class="list-unstyled footer-list">
                        <li><a href="{{ url('bantuan') }}">Bantuan</a></li>
                        <li><a href="{{ url('http://helpdesk.dumaikota.go.id') }}">Helpdesk</a></li>
                        <li><a href="{{ url('http://dumai.lapor.go.id') }}">SP4N Lapor!</a></li>
                    </ul>
                </div> --}}

            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="mt-3 mt-sm-0">
                    <h5 class="footer-title text-white font-16 mb-3">Kontak</h5>
                    <div>
                        <p class="text-white-50 mb-2"><i class="mdi mdi-map-marker-outline text-white font-18 mr-2 align-middle"></i> {{ getKontak()->alamat }}</p>
                        {{-- <p class="text-white-50 mb-2"><i class="mdi mdi-phone text-white font-18 mr-2 align-middle"></i> <a href="javascript:;">{{ getKontak()->telpon }}</a></p> --}}
                        <p class="text-white-50 mb-2"><i class="mdi mdi-web text-white font-18 mr-2 align-middle"></i> <a target="_blank" href="{{ getKontak()->website }}" class="text-warning">{{ getKontak()->website }}</a></p>
                        <p class="text-white-50"><i class="mdi mdi-email-outline text-white font-18 mr-2 align-middle"></i> <a href="mailto:{{ getKontak()->email }}" class="text-warning">{{ getKontak()->email }}</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->

    <div class="footer-alt py-3 mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="text-white-50 mb-md-0 float-md-left">{{ date('Y') > '2024' ? '2024 - '.date('Y') : '2024' }} &copy; {{ getTitle() }} </p>
                        <ul class="list-inline social-links float-md-right mb-0">
                            <li class="list-inline-item">Versi: 1.0.0</li>
                        </ul>
                        {{-- <ul class="list-inline social-links float-md-right mb-0">
                            <li class="list-inline-item"><a href="{{ getKontak()->sosmed_facebook }}"><i class="mdi mdi-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="{{ getKontak()->sosmed_instagram }}"><i class="mdi mdi-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="{{ getKontak()->sosmed_youtube }}"><i class="mdi mdi-youtube"></i></a></li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- WhatsApp Floating Button -->
@php
    $telpon = isset(getKontak()->telpon) ? preg_replace('/[^0-9]/', '', getKontak()->telpon) : '';
    $waNumber = ltrim($telpon, '0');
@endphp

@if(!empty($waNumber))
<div class="whatsapp-float-container">
    <a href="https://wa.me/62{{ $waNumber }}?text=Halo%20{{ urlencode(getKontak()->nama_instansi ?? 'Admin') }}%2C%20saya%20ingin%20bertanya%20tentang..."
       class="whatsapp-float"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Chat via WhatsApp">
        <i class="mdi mdi-whatsapp"></i>
        <span class="whatsapp-pulse"></span>
        <span class="whatsapp-tooltip">Butuh Bantuan?<br>Chat Sekarang</span>
    </a>
</div>

@endif
</footer>
<!-- Footer end -->

<!-- Back to top -->    
<a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a>