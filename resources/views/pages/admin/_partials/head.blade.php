<head>
    <meta charset="utf-8" />
    {{-- <title>{{ $dataview->title }}</title> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/back/') }}/images/favicon.png">

    @stack('head')

    <!-- App css -->
    <link href="{{ asset('assets/back/') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{ asset('assets/back/') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/back/') }}/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

    <!-- Sweet Alert-->
    <link href="{{ asset('assets/back/') }}/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
</head>