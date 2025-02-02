<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset("assets/icon/favicon.ico") }}">
</head>
<style>
   .kop_surat {
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .kop_surat h1 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .kop_surat p {
        font-size: 14px;
        color: #555;
    }
    .text-primary {
        color: #007bff;
    }
</style>
<body>
    <div class="kop_surat">
        <table width="100%">
            <tr>
                <!-- Logo -->
                <td width="20%" align="left">
                    @if ($user->logo_url)
                        <img src="{{ public_path('storage/' . $user->logo_url) }}" alt="Logo perusahaan" style="height:70px;">
                    @else
                        <img src="{{ public_path('assets/img/profil2.png') }}" alt="Logo perusahaan" style="height:70px;">
                    @endif
                </td>

                <!-- Informasi Perusahaan -->
                <td width="80%" align="center">
                    <h1 style="font-size: 18px; font-weight: bold; margin: 0;">
                        {{ strtoupper($user->name) }}
                    </h1>
                    <p style="margin: 2px 0; font-size: 14px;">
                        {{ $user->street }}, Kelurahan {{ $user->urbanVillage->name }}, Kecamatan {{ $user->district->name }}
                    </p>
                    <p style="margin: 2px 0; font-size: 14px;">
                        Kota {{ $user->region->name }}, Provinsi {{ $user->province->name }}
                    </p>
                    <p style="margin: 2px 0; font-size: 14px;">
                        <span>Telp: {{ $user->phone_number }}</span> &nbsp;&nbsp;
                        <span>Email: <u class="text-primary">{{ $user->email }}</u></span> &nbsp;&nbsp;
                        @if ($user->web_url)
                            <span>Website: <u class="text-primary">{{ $user->web_url }}</u></span>
                        @endif
                    </p>
                </td>
            </tr>
        </table>
    </div>

    @yield('content')
</body>
</html>
