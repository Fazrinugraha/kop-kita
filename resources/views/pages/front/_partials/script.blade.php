
        <!-- Javascript -->
        <script src="{{ asset('assets/front/') }}/js/jquery.min.js"></script>
        <script src="{{ asset('assets/front/') }}/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets/front/') }}/js/jquery.easing.min.js"></script>
        <script src="{{ asset('assets/front/') }}/js/scrollspy.min.js"></script>

        <!-- owl-carousel -->
        <script src="{{ asset('assets/front/') }}/js/owl.carousel.min.js"></script>

        <!-- custom js -->
        <script src="{{ asset('assets/front/') }}/js/app.js"></script>

        <!-- Sweet Alerts js -->
        <script src="{{ asset('assets/back/') }}/libs/sweetalert2/sweetalert2.min.js"></script>

        @stack('script')

        <!-- App js -->
        <script src="{{ asset('assets/back/') }}/js/app.min.js"></script>

        <!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


        <script>
        $(function() {

                @if (session('success'))
                        Swal.fire({ 
                                title: "Berhasil!", 
                                text: "{{ session('success') }}", 
                                type: "success", 
                                confirmButtonColor: "#348cd4"
                        })
                @endif

                @if (session('warning'))
                        Swal.fire({ 
                                title: "Perhatian!", 
                                text: "{{ session('warning') }}", 
                                type: "warning", 
                                confirmButtonColor: "#348cd4"
                        })
                @endif

                @if (session('failed'))
                        Swal.fire({ 
                                title: "Maaf!", 
                                text: "{{ session('failed') }}", 
                                type: "error", 
                                confirmButtonColor: "#6c757d"
                        })
                @endif

        });
        </script>