@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Kontak Resmi L|KITA Bengkalis" />
<meta property="og:description" content="Lihat daftar kontak kami" />
<meta property="og:image" content="{{ asset('themes/front/') }}/images/logo-hitam.png" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush

@section('content')
    <!-- Hero section Start -->
    <section class="hero-section bg-primary" id="home">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <hr style="border: 1px solid white;">
                    <div class="hero-wrapper pb-3">
                        <h6 class="text-white title">
                            <a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a>
                            <i class="mdi mdi-chevron-right"></i> Kontak
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="contact-us section" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-us-content">
                    <div class="row">
                        <div class="col-md-5 col-lg-4">
                            <div id="map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115655.72935966901!2d101.2557283559451!3d1.6675696937968003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d3af399bc9f7d9%3A0xfaf97dec9a757b44!2sDumai%2C%20Kota%20Dumai%2C%20Riau!5e1!3m2!1sid!2sid!4v1749455221427!5m2!1sid!2sid" width="100%" height="100%" frameborder="0" style="border:0; border-radius: 15px; min-height: 400px;" allowfullscreen=""></iframe>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-8">
                            <form id="contact-form" action="{{ route('contact.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="section-heading">
                                            <h2><em>Contact Us</em> &amp; Get In <span>Touch</span></h2>
                                        </div>
                                        @if($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <input type="text" name="name" id="name" placeholder="Your Name..." autocomplete="on" required value="{{ old('name') }}">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <input type="text" name="surname" id="surname" placeholder="Your Surname..." autocomplete="on" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <input type="email" name="email" id="email" placeholder="Your E-mail..." required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <input type="text" name="subject" id="subject" placeholder="Subject..." autocomplete="on">
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <fieldset>
                                            <textarea name="message" id="message" placeholder="Your Message" required></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </div>
                                    <!-- Tambahkan tombol kirim ini -->
                                    <div class="col-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="blue-yellow-button">Send Message</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                            <div class="more-info">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="info-item">
                                            <i class="fa fa-phone"></i>
                                            <h4><a href="tel:{{ getKontak()->telpon }}">{{ getKontak()->telpon }}</a></h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="info-item">
                                            <i class="fa fa-envelope"></i>
                                            <h4><a href="mailto:{{ getKontak()->email }}">{{ getKontak()->email }}</a></h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="info-item">
                                            <i class="fa fa-map-marker"></i>
                                            <h4><a href="#">{{ getKontak()->alamat }}</a></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



            @endsection

@push('script')
@endpush
