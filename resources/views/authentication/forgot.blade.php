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
    <style>
        a {
            font-weight: 600;
        }

        a:hover {}

        small {
            color: rgb(122, 122, 122);

        }

        small:hover {
            color: rgb(133, 56, 234);
        }
    </style>
</head>

<body class="bg-login">
    <div class="card w-30 mb-3 m-auto " style="margin-top: 20vh !important">
        <div class="row p-3 bg-white m-1">
            @if (session("status"))
                <div class="m-auto alert alert-success col-md-12 text-center">
                    {{ session("status") }}
                </div>
            @endif
            <div class="col-md-12 mt-4">
                <h1 class="text-center  text-primer">Reset Password</h1>
                <div class="d-flex flex-column">
                    <small class="text-center m-auto">Silahkan Masukan Email untuk reset password</small>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="d-flex flex-column mb-3 mt-4">
                        <label for="email" class="mb-1"><strong>Email</strong></label>
                        <input type="text" value="{{ old("email") }}" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email..." required>

                        @error("email")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="w-100 btn btn-primer mt-3 ">Kirim</button>
                </form>
            </div>
        </div>
    </div>
    @include("layouts.toast")
</body>

</html>
