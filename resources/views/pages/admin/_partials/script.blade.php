
        <!-- Vendor js -->
        <script src="{{ asset('assets/back/') }}/js/vendor.min.js"></script>

        <!--Morris Chart-->
        <script src="{{ asset('assets/back/') }}/libs/morris-js/morris.min.js"></script>
        <script src="{{ asset('assets/back/') }}/libs/raphael/raphael.min.js"></script>

        <!-- Sweet Alerts js -->
        <script src="{{ asset('assets/back/') }}/libs/sweetalert2/sweetalert2.min.js"></script>

        @stack('script')

        <!-- App js -->
        <script src="{{ asset('assets/back/') }}/js/app.min.js"></script>

        <script>
        $(function() {

                @if (session('success'))
                        Swal.fire({ 
                                title: "Berhasil!", 
                                html: "{!! session('success') !!}", 
                                type: "success", 
                                confirmButtonColor: "#348cd4",
                                cancelButtonColor: "#6c757d",
                        })
                @endif

                @if (session('warning'))
                        Swal.fire({ 
                                title: "Perhatian!", 
                                html: "{!! session('warning') !!}", 
                                type: "warning", 
                                confirmButtonColor: "#348cd4",
                                cancelButtonColor: "#6c757d",
                        })
                @endif

                @if (session('failed'))
                        Swal.fire({ 
                                title: "Maaf!", 
                                html: "{!! session('failed') !!}", 
                                type: "error", 
                                confirmButtonColor: "#6c757d"
                        })
                @endif

        });

        function promptLogout() {
                Swal.fire({
                title: "Logout",
                text: "Apakah Anda yakin ingin logout?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#348cd4",
                confirmButtonText: "Ya, Logout",
                cancelButtonColor: "#6c757d",
                cancelButtonText: "Batal"
                }).then((result) => {
                if (result.value) {
                        window.location.href = "{{ url('logout') }}";
                }
                });
        }

        function promptChangePassword() {
                Swal.fire({
                title: "Ganti Password",
                html: '<input type="password" id="old_password" class="swal2-input" placeholder="Masukkan password lama Anda">' +
                        '<input type="password" id="new_password" class="swal2-input" placeholder="Masukkan password baru Anda">',
                type: "question",
                showCancelButton: true,
                confirmButtonColor: "#348cd4",
                confirmButtonText: "Ganti",
                cancelButtonColor: "#6c757d",
                cancelButtonText: "Batal",
                inputAttributes: {
                        autocapitalize: 'off'
                },
                preConfirm: () => {
                        const oldPassword = document.getElementById('old_password').value;
                        const newPassword = document.getElementById('new_password').value;
                        if (!oldPassword) {
                        Swal.showValidationMessage('Mohon masukkan password lama anda!');
                        }
                        else if (!newPassword) {
                        Swal.showValidationMessage('Mohon masukkan password baru anda!');
                        }
                        
                }
                }).then((result) => {
                if (result.value) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = "{{ route('ganti.password') }}";
                        form.innerHTML = '@csrf' +
                                '<input type="hidden" name="old_password" value="' + document.getElementById('old_password').value + '">' +
                                '<input type="hidden" name="new_password" value="' + document.getElementById('new_password').value + '">';
                        document.body.appendChild(form);
                        form.submit();
                }
                });
        }
        </script>