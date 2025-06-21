
<!DOCTYPE html>
<html lang="en">
    {{-- Include the head section with metadata and styles --}}
    @include('pages/front/_partials/head')

    <body>

        @include('pages/front/_partials/navbar')

        @yield('content')
        
        
        @include('pages/front/_partials/footer')
        
        @include('pages/front/_partials/script')
        
        {{-- <script type="text/javascript">
            $(window).on('load', function() {
                $('.pengumuman').modal('show');
            });
        </script> --}}
    </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>