@extends('layouts.pdf')

@section('title', 'Peringatan')

@section('content')
    {{-- isi-surat --}}
    <div class="mt-3">
        <div>
            <p style="font-size: 11pt">Perihal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="subject_data">{{ old("subject") ?? $logs["subject"] ?? "[Perihal]" }}</span></p>

            <div style="text-align: center; margin-top: 20px">
                <h4><u>SURAT PERINGATAN</u></h4>
                <p style="margin-top: -20px; font-size: 10pt">No. {{ $commonLog->number_of_letter ?? "[Nomor surat]" }}</p>
            </div>
        </div>

        <div style="font-size: 11pt; margin-top: 20px;">
            <p>Surat peringatan ini ditujukan kepada:</p>
            <p style="margin-top: -10px">Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="recipient_name_data">{{ old("recipient_name") ?? $logs["recipient_name"] ?? "[Nama penerima]" }}</span></p>
            <p style="margin-top: -10px;"><span style=" padding-right: 2px;">Jabatan&nbsp;&nbsp;&nbsp;&nbsp;</span>: <span id="recipient_position_data">{{ old("recipient_position") ?? $logs["recipient_position"] ?? "[Jabatan penerima]" }}</span></p>

            <p style="text-indent: 30px">&emsp;&emsp;&emsp;Dengan ini kami sampaikan bahwa pada tanggal <span id="violation_date_data">{{ old("violation_date") ?? $logs["violation_date"] ?? "[tanggal pelanggaran]" }}</span>, Saudara telah melanggar kebijakan perusahaan terkait <span id="violation_description_data">{{ old("violation_description") ?? $logs["violation_description"] ?? "[deskripsi pelanggaran]" }}</span>. Pelanggaran tersebut kami identifikasi sebagai tindakan yang tidak sesuai dengan norma-norma yang telah ditetapkan oleh perusahaan.</p>
            <p style="text-indent: 30px">&emsp;&emsp;&emsp;Dengan diterbitkannya surat peringatan ini, kami ingin mengingatkan Saudara bahwa melanggar kebijakan perusahaan memiliki konsekuensi serius dan dapat merusak citra dan reputasi perusahaan. Sebagai langkah pertama, surat peringatan ini kami berikan sebagai upaya untuk memberi kesempatan kepada Saudara untuk memperbaiki perilaku Saudara.</p>
            <p style="text-indent: 30px">&emsp;&emsp;&emsp;Surat peringatan ini terhitung sejak tanggal dikeluarkannya surat peringatan ini dan apabila yang bersangkutan melakukan kesalahan yang sama atau lebih berat, maka akan diberian peringatan selanjutnya. Demikian surat peringatan ini dibuat untuk dapat diperhatikan dan dilaksanakan sebaik mungkin kepada yang bersangkutan.</p>
        </div>

        <div style="text-align: right; font-size: 11pt; margin-top: 50px">
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
            <p style="font-style: bold"><u id="signed_name_data">{{ old("signed_name") ?? $logs["signed_name"] ?? "[Nama yang bertanda tangan]" }}</u></p>
            <p style="margin-top: -15px" id="signed_position_data">{{ old("signed_position") ?? $logs["signed_position"] ?? "[Jabatan yang bertanda tangan]" }}</p>
        </div>
    </div>
    {{-- end-isi-surat --}}
@endsection
