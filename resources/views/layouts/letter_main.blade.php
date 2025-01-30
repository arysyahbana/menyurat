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
        <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/buat_surat_create.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/surat.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        @yield("css")

        <script src="https://kit.fontawesome.com/82ebf8392e.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="bg-white">
            {{-- nav --}}
            <div class="text-white bg-primer py-3 d-flex justify-content-between ">
                <div class="ms-5 my-auto">
                    <a href="{{ route('dashboard') }}" class="btn dashboard">
                        <h5 class="my-auto" style="color: white"><i class="fa-solid fa-arrow-left me-2"></i>
                            Dashboard</h5>
                    </a>
                </div>
                <div class="my-auto me-5 pe-5 letter-title">
                    <input type="text" name="title" id="title" value="{{ $commonLog->title }}"
                        class="me-5 pe-5 form-control bg-transparent text-white text-center d-none" style="width: 40rem;">
                    <h6 class="my-auto me-5 pe-4">{{ $commonLog->title }} <i class="fa-solid fa-pencil fs-6"></i></h6>
                </div>
                <div class="me-5">
                    {{-- <button class="btn btn-warning me-2"><i class="fa-solid fa-rotate-left"></i></button>
                    <button class="btn btn-download"><i class="fa-solid fa-download"></i> Donwload</button> --}}
                </div>

            </div>
            {{-- end-nav --}}

            {{-- main --}}
            @yield("letter_content")
        </div>

        @include("layouts.toast")
        @include("layouts.alert")
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/input_letter.js') }}"></script>
        @yield("javascript")
    </body>
</html>
