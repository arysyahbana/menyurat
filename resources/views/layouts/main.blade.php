<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Application icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset("assets/icon/favicon.ico") }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Menyurat</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/button.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/background_color.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/text_custom.css') }}">

    <script src="https://kit.fontawesome.com/82ebf8392e.js" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>


</head>

<body>
    <div class="wrapper  ">
        @include('layouts.sidebar')
        <div class="main ">
            @include('layouts.navbar')
            {{-- content --}}
            <div class="content  ">
                <div style="">
                    @yield('content')
                </div>
            </div>
            {{-- end-content --}}
        </div>
    </div>

    @include("layouts.toast")
    @include("layouts.alert")
    <script src="{{ asset('assets/js/sidebar.js') }}" crossorigin="anonymous"></script>
</body>

</html>
