<!DOCTYPE html>
<html style="font-size: 16px;" lang="ar">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="INTUITIVE">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jomhuria&family=Lateef&family=Mirza&display=swap" rel="stylesheet">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lateef&display=swap" rel="stylesheet"> -->
    <!-- end font -->
    <title>4Media</title>
    <link rel="stylesheet" href="{{asset('website/css/nicepage.css')}}" media="screen">
    @stack('styles')
    <livewire:styles />
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <meta name="generator" content="Nicepage 4.6.5, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i">

    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="index">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
    <style>
        .menu-text {
            /* display: inli !important; */
            /* margin-right: 6px !important; */
            font-size: 16px !important;
        }

        .toast-message {
            text-align: right !important;
            margin-right: 20%;
        }

        .error {
            color: red;
            font-size: 10px;
            font-weight: bold;
        }
    </style>
</head>
  </head>
  <body class="u-body u-overlap u-overlap-transparent u-xl-mode">
    {{-- header code  --}}
    @include('website.includes.header')
    {{-- end header code  --}}
    {{-- main code  --}}

    @yield('content')
    {{-- end main code  --}}
    {{-- footer code  --}}
    @include('website.includes.footer')
    {{-- end footer code  --}}
    {{-- js Code --}}
    <livewire:scripts />

    <script class="u-script" type="text/javascript" src="{{asset('website/js/jquery.js')}}" defer=""></script>
    <script class="u-script" type="text/javascript" src="{{asset('website/js/nicepage.js')}}" defer=""></script>

    <script src="{{asset('dist/assets/js/pages/features/miscellaneous//toastr.min.js')}}"></script>
    <script src="{{ asset('dist/assets/js/pages/features/miscellaneous/sweetalert2.min.js') }}"></script>

</body>
</html>
