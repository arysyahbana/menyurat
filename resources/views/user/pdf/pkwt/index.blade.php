@extends('layouts.pdf')

@section('title', 'PKWT')

@section('content')
    {{-- isi-surat --}}
    <div class="mt-3">
        <div style="text-align: center">
            <h4><u>PERJANJIAN KERJA WAKTU TERTENTU (PKWT)</u></h4>
            <p style="margin-top: -20px; font-size: 10pt">No. {{ $commonLog->number_of_letter ?? "[Nomor surat]" }}</p>
        </div>

        <div style="margin-top: 30px">
            <p style="font-style: bold">Yang bertanda tangan dibawah ini:</p>
            <p><span style="margin-right: 5px">1.</span>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="first_name_data">{{ old("first_name") ?? $logs["first_name"] ?? "[Nama pihak pertama]" }}</span></p>
            <p style="margin-left: 17px; margin-top: -15px;">Jabatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="first_position_data">{{ old("first_position") ?? $logs["first_position"] ?? "[Jabatan pihak pertama]" }}</span></p>
            <p style="margin-left: 17px; margin-top: -15px;">Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="first_address_data">{{ old("first_address") ?? $logs["first_address"] ?? "[Alamat pihak pertama]" }}</span></p>

            <p style="margin-top: 20px">
                Dalam Perjanjian Kerja ini bertindak untuk dan atas nama Pengusaha/Perusahaan <span>{{ $user->name }}</span> yang beralamat di <span>{{ $user->street }}, Kota {{ $user->region->name }}, {{ $user->province->name }}</span>, dan selanjutnya disebut : <span style="font-weight: bold"><u>Pihak Pertama</u></span>
            </p>

            <p><span style="margin-right: 5px">2.</span>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="second_name_data">{{ old("second_name") ?? $logs["second_name"] ?? "[Nama pihak kedua]" }}</span></p>
            <p style="margin-left: 17px; margin-top: -15px;">Tempat, Tanggal lahir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="second_place_of_birth_data">{{ old("second_place_of_birth") ?? $logs["second_place_of_birth"] ?? "[Tempat" }}</span>,
                <span id="second_date_of_birth_data">
                    @if(old("second_date_of_birth"))
                        {{ date("d", strtotime(old("second_date_of_birth"))) }}
                        {{ config(sprintf("central.months.%s", date("F", strtotime(old("second_date_of_birth"))))) }}
                        {{ date("Y", strtotime(old("second_date_of_birth"))) }}

                    @elseif ($logs["second_date_of_birth"])
                        {{ date("d", strtotime($logs["second_date_of_birth"])) }}
                        {{ config(sprintf("central.months.%s", date("F", strtotime($logs["second_date_of_birth"])))) }}
                        {{ date("Y", strtotime($logs["second_date_of_birth"])) }}

                    @else
                        {{ "Tanggal lahir]" }}
                    @endif
                </span>
            </p>
            <p style="margin-left: 17px; margin-top: -15px;">Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="second_address_data">{{ old("second_address") ?? $logs["second_address"] ?? "[Alamat pihak kedua]" }}</span></p>

            <p style="margin-top: 20px">
                Dalam Perjanjian Kerja ini bertindak  untuk dan atas nama  sendiri, yang selanjutnya disebut : <span style="font-weight: bold"><u>Pihak Kedua</u></span>
            </p>

            <p style="margin-top: 20px">
                Pada hari ini
                <span id="signed_date_day_data">
                    @if(old("signed_date"))
                        {{ config(sprintf("central.days.%s", date("l", strtotime(old("signed_date"))))) }}
                    @elseif ($logs["signed_date"])
                        {{ config(sprintf("central.days.%s", date("l", strtotime($logs["signed_date"])))) }}
                    @else
                        ………
                    @endif
                </span>
                tanggal
                <span id="signed_date_data">
                    @if(old("signed_date"))
                        {{ date("d", strtotime(old("signed_date"))) }}
                        {{ config(sprintf("central.months.%s", date("F", strtotime(old("signed_date"))))) }}
                        {{ date("Y", strtotime(old("signed_date"))) }}
                    @elseif ($logs["signed_date"])
                        {{ date("d", strtotime($logs["signed_date"])) }}
                        {{ config(sprintf("central.months.%s", date("F", strtotime($logs["signed_date"])))) }}
                        {{ date("Y", strtotime($logs["signed_date"])) }}
                    @else
                        ………
                    @endif
                </span>
                , bertempat di Perusahaan {{ $user->name }}, Pihak Pertama dan Pihak Kedua sepakat mengadakan Perjanjian Kerja dengan ketentuan-ketentuan seperti tertera dalam pasal berikut ini :
            </p>

            <div id="sections_data">
                @if (old("sections"))
                    @foreach (old("sections") as $index => $item)
                        <div id="{{ sprintf("sections_%s_data", $index) }}">
                            <p style="margin-top: -20px; font-weight: bold">Pasal {{ $loop->iteration }}</p>
                            <p style="margin-top: -20px; font-weight: bold; text-align: center;" id="{{ sprintf('sections_%s_title_data', $index) }}">{{ $item["title"] }}</p>
                            <div style="margin-top: -10px" id="{{ sprintf('sections_%s_content_data', $index) }}">
                                {!! $item["content"] !!}
                            </div>
                        </div>
                    @endforeach

                @else
                    @foreach ($logs["sections"] as $index => $item)
                        <div id="{{ sprintf("sections_%s_data", $index) }}">
                            <p style="margin-top: 20px; font-weight: bold; text-align: center;">Pasal {{ $loop->iteration }}</p>
                            <p style="margin-top: -20px; font-weight: bold; text-align: center;" class="fw-bold text-center" id="{{ sprintf('sections_%s_title_data', $index) }}">{{ $item["title"] }}</p>
                            <div style="margin-top: -10px" id="{{ sprintf('sections_%s_content_data', $index) }}">
                                {!! $item["content"] !!}
                            </div>
                        </div>
                    @endforeach

                @endif
            </div>
        </div>

        <table width="100%" style="font-size: 11pt; margin-top: 70px;">
            <tr>
                <td>
                    <p style="margin-top: 2px">Pihak Kedua</p>
                    <p style="margin-top: 80px;" id="second_name_data_2">{{ old("second_name") ?? $logs["second_name"] ?? "[Nama pihak kedua]" }}</p>
                </td>
                <td>
                    <div style="text-align: right">
                        <span id="signed_place_data">{{ old("signed_place") ?? $logs["signed_place"] ?? "[Tempat" }}</span>,
                        <span id="signed_date_data_2">
                            @if(old("signed_date"))
                                {{ date("d", strtotime(old("signed_date"))) }}
                                {{ config(sprintf("central.months.%s", date("F", strtotime(old("signed_date"))))) }}
                                {{ date("Y", strtotime(old("signed_date"))) }}

                            @elseif ($logs["signed_date"])
                                {{ date("d", strtotime($logs["signed_date"])) }}
                                {{ config(sprintf("central.months.%s", date("F", strtotime($logs["signed_date"])))) }}
                                {{ date("Y", strtotime($logs["signed_date"])) }}

                            @else
                                {{ "tanggal, bulan, tahun]" }}
                            @endif
                        </span>
                        <p style="margin-top: 2px">Pihak Pertama</p>
                        <p style="font-weight: bold; margin-top: 80px;"><u id="first_name_data_2">{{ old("signed_name") ?? $logs["signed_name"] ?? "[Nama pihak pertama]" }}</u></p>
                        <p style="margin-top: -15px" id="first_position_data_2">{{ old("signed_position") ?? $logs["signed_position"] ?? "[Jabatan pihak pertama]" }}</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    {{-- end-isi-surat --}}
@endsection
