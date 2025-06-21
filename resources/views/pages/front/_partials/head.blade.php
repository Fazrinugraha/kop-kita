    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <title>{{ $dataview->title }}</title> --}}
        {{-- <meta name="description" content="{{ getTitle() }}" /> --}}
        <meta name="keywords" content="" />
        <meta name="author" content="Coderassets" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('assets/front/images/favicon.png') }}">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ url('assets/front/css/bootstrap.min.css') }}" type="text/css">

        <!--Material Icon -->
        <link rel="stylesheet" type="text/css" href="{{ url('assets/front/css/materialdesignicons.min.css') }}" />

        <!-- owl carousel css -->
        <link rel="stylesheet" type="text/css" href="{{ url('assets/front/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/front/css/owl.theme.default.min.css') }}">

        <!-- Custom  sCss -->
        <link rel="stylesheet" type="text/css" href="{{ url('assets/front/css/style.css') }}" />

        <!-- Sweet Alert-->
        <link href="{{ url('assets/back/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        
        @stack('head')
        
    </head>
