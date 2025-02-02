@extends('layouts.pdf')

@section('title', 'Surat Mutasi')

@section('content')
    {{-- isi-surat --}}
    <div class="mt-3">
        <div style="text-align: center">
            <h4><u>SURAT MUTASI</u></h4>
            <p style="margin-top: -20px; font-size: 10pt">No. {{ $commonLog->number_of_letter ?? "[Nomor surat]" }}</p>
        </div>

        <div style="font-size: 11pt">
            <p>Yang bertanda tangan dibawah ini:</p>
            <p style="margin-top: -10px">
                <span>Nama</span>
                <span style="margin-left: 18px">: </span>
                <span id="signed_name_data" style="font-style: bold">{{ old("signed_name") ?? $logs["signed_name"] ?? "[Nama yang bertanda tangan]" }}</span>
            </p>
            <p>
                <span>Jabatan</span>
                <span style="margin-left: 8px">: </span>
                <span id="signed_position_data">{{ old("signed_position") ?? $logs["signed_position"] ?? "[Jabatan yang bertanda tangan]" }}</span>
            </p>

            <p style="margin-top: 30px">Memutuskan untuk melakukan mutasi terhadap karyawan {{ $user->name }} yang tersebut di bawah ini:</p>
            <p>
                <span>Nama</span>
                <span style="margin-left: 18px">: </span>
                <span id="mutated_name_data" style="font-style: bold">{{ old("mutated_name") ?? $logs["mutated_name"] ?? "[Nama yang dimutasi]" }}</span>
            </p>
            <p>
                <span>Jabatan</span>
                <span style="margin-left: 8px">: </span>
                <span id="mutated_position_data">{{ old("mutated_position") ?? $logs["mutated_position"] ?? "[Jabatan yang dimutasi]" }}</span>
            </p>

            <p style="margin-top: 30px">Jabatan serta lokasi kantor yang baru adalah sebagai berikut:</p>
            <p>
                <span>Jabatan</span>
                <span style="margin-left: 8px">: </span>
                <span id="new_position_data">{{ old("new_position") ?? $logs["new_position"] ?? "[Jabatan baru]" }}</span>
            </p>
            <p>
                <span>Kantor</span>
                <span style="margin-left: 12px">: </span>
                <span id="new_office_location_data">{{ old("new_office_location") ?? $logs["new_office_location"] ?? "[Lokasi kantor baru]" }}</span>
            </p>

            <p style="margin-top: 30px">&emsp;&emsp;&emsp;Surat Keputusan Mutasi ini mulai efektif pada <span id="effective_date_data">
                @if(old("effective_date"))
                    {{ config(sprintf("central.days.%s", date("l", strtotime(old("effective_date"))))) }},
                    {{ date("d", strtotime(old("effective_date"))) }}
                    {{ config(sprintf("central.months.%s", date("F", strtotime(old("effective_date"))))) }}
                    {{ date("Y", strtotime(old("effective_date"))) }}
                @elseif ($logs["effective_date"])
                    {{ config(sprintf("central.days.%s", date("l", strtotime($logs["effective_date"])))) }},
                    {{ date("d", strtotime($logs["effective_date"])) }}
                    {{ config(sprintf("central.months.%s", date("F", strtotime($logs["effective_date"])))) }}
                    {{ date("Y", strtotime($logs["effective_date"])) }}
                @else
                    [hari, tanggal, bulan, tahun]
                @endif
            </span>. Oleh karena itu, kepada yang bersangkutan untuk dapat mempersiapkan segala sesuatunya sebelum tanggal tersebut.</p>
            <p>&emsp;&emsp;&emsp;Demikian Surat Keputusan Mutasi ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <div style="text-align: right; font-size: 11pt; margin-top: 50px;">
            <p>
                <span id="signed_place_data">{{ old("signed_place") ?? $logs["signed_place"] ?? "[Tempat" }}</span>,
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
                        tanggal, bulan, tahun]
                    @endif
                </span>
            </p>
            <p style="margin-top: -10px; margin-bottom: 70px;">{{ $user->name }}</p>
            <p style="font-style: bold"><u id="signed_name_data_2">{{ old("signed_name") ?? $logs["signed_name"] ?? "[Nama yang bertanda tangan]" }}</u></p>
            <p style="margin-top: -15px" id="signed_position_data_2">{{ old("signed_position") ?? $logs["signed_position"] ?? "[Jabatan yang bertanda tangan]" }}</p>
        </div>
    </div>
    {{-- end-isi-surat --}}
@endsection
