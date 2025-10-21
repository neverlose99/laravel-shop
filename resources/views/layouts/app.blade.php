<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Surfside Media</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="surfside media" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Allura&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer">

    @vite(['resources/scss/app.scss'])
</head>

<body class="gradient-bg">
    {{-- Chứa các định nghĩa icon SVG --}}
    @include('layouts.partials.svg')

    {{-- Header cho mobile và desktop --}}
    @include('layouts.partials.header')

    <main>
        {{-- Đây là nơi nội dung chính của mỗi trang sẽ được hiển thị --}}
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')

    <div id="scrollTop" class="visually-hidden end-0"></div>
    <div class="page-overlay"></div>

    <script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.bundle.min.js') }}"></script> {{-- Lưu ý: file này có thể xung đột với bootstrap cài qua npm, nếu lỗi thì xóa dòng này đi --}}
    <script src="{{ asset('assets/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>

    @vite(['resources/js/app.js'])
</body>

</html>