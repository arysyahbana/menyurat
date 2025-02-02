@extends('layouts.pdf')

@section('title', 'Demosi Karyawan')

@section('content')
     {{-- isi-surat --}}
    <div class="mt-3">
        <div style="text-align: center">
            <h4><u>SURAT KEPUTUSAN</u></h4>
            <p style="margin-top: -20px; font-size: 10pt">No. {{ $commonLog->number_of_letter ?? "[Nomor surat]" }}</p>
            <p style="margin-top: -10px; font-size: 10pt">Tentang:</p>
            <p style="margin-top: -10px; font-size: 10pt; font-style: bold;">DEMOSI JABATAN KARYAWAN</p>
        </div>

        <div style="font-size: 11pt">
            <h4><u>Menimbang:</u></h4>
            <div style="margin-top: -20px; margin-bottom: 30px;">
                <ol class="mt-n5" id="considerings_data">
                    @if (old("considerings"))
                        @foreach (old("considerings") as $index => $item)
                            <li class="decimal-number" id="{{ sprintf('considerings_%s_data', $index) }}">{{ $item }}</li>
                        @endforeach

                    @else
                        @foreach ($logs["considerings"] as $index => $item)
                            <li class="decimal-number" id="{{ sprintf('considerings_%s_data', $index) }}">{{ $item }}</li>
                        @endforeach
                    @endif
                </ol>
            </div>

            <h4><u>Mengingat:</u></h4>
            <div style="margin-top: -20px; margin-bottom: 30px;">
                <ol class="mt-n5" id="rememberings_data">
                    @if (old("rememberings"))
                        @foreach (old("rememberings") as $index => $item)
                            <li class="decimal-number"  id="{{ sprintf('rememberings_%s_data', $index) }}">{{ $item }}</li>
                        @endforeach

                    @else
                        @foreach ($logs["rememberings"] as $index => $item)
                            <li class="decimal-number"  id="{{ sprintf('rememberings_%s_data', $index) }}">{{ $item }}</li>
                        @endforeach
                    @endif
                </ol>
            </div>

            <h4><u>Memutuskan:</u></h4>
            <div id="decidings_data">
                <div div style="margin-top: -35px; padding-left: 20px;">
                    <h4><u>Pertama:</u></h4>
                    <p style="margin-top: -15px;" id="decidings_first_data">{{ old("decidings.first") ?? $logs["decidings"]["first"] }}</p>

                    <p class="mt-2">
                        Nama yang bersangkutan :
                        <span id="employee_name_data">{{ old("employee_name") ?? $logs["employee_name"] ?? "[Nama yang bersangkutan]" }}</span>
                    </p>

                    <table width="100%">
                        <tr>
                            <td style="width: 15%; vertical-align: top; padding-top: 16px; padding-left: 15px;">a. Semula &nbsp;&nbsp;&nbsp;:</td>
                            <td style="vertical-align: top;">
                                <ol>
                                    <li class="lower-roman-number">
                                        <span class="row">
                                            <span class="col-3">Jabatan</span>
                                            <span class="col" id="position_data">: {{ old("position") ?? $logs["position"] ?? "[Jabatan semula]" }}</span>
                                        </span>
                                    </li>

                                    <li class="lower-roman-number">
                                        <span class="row">
                                            <span class="col-3">Gaji Pokok</span>
                                            <span class="col" id="salary_data">: {{ old("salary") ?? $logs["salary"] ?? "[Gaji pokok semula]" }}</span>
                                        </span>
                                    </li>

                                    <div id="optionals_data">
                                        @if(old("optionals"))
                                            @foreach (old("optionals") as $index => $item)
                                                <li class="lower-roman-number" id="{{ sprintf('optionals_%s_data', $index) }}">
                                                    <span class="row">
                                                        <span class="col-3" id="{{ sprintf('optionals_%s_key_data', $index) }}">{{ $item["key"] ?? "[Kata kunci semula]" }}</span>

                                                        <span class="col" id="{{ sprintf('optionals_%s_value_data', $index) }}">: {{ $item["value"] ?? "[Data tambahan semula]" }}</span>
                                                    </span>
                                                </li>
                                            @endforeach

                                        @else
                                            @foreach ($logs["optionals"] as $index => $item)
                                                <li class="lower-roman-number" id="{{ sprintf('optionals_%s_data', $index) }}">
                                                    <span class="row">
                                                        <span class="col-3" id="{{ sprintf('optionals_%s_key_data', $index) }}">{{ $item["key"] ?? "[Kata kunci semula]" }}</span>

                                                        <span class="col" id="{{ sprintf('optionals_%s_value_data', $index) }}">: {{ $item["value"] ?? "[Data tambahan semula]" }}</span>
                                                    </span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </div>
                                </ol>
                            </td>
                        </tr>
                    </table>

                    <table width="100%">
                        <tr>
                            <td style="width: 15%; vertical-align: top; padding-top: 16px; padding-left: 15px;">b. Menjadi &nbsp;&nbsp;:</td>
                            <td style="vertical-align: top;">
                                <ol>
                                    <li class="lower-roman-number">
                                        <span class="row">
                                            <span class="col-3">Jabatan</span>
                                            <span class="col" id="new_position_data">: {{ old("new_position") ?? $logs["new_position"] ?? "[Jabatan baru]" }}</span>
                                        </span>
                                    </li>

                                    <li class="lower-roman-number">
                                        <span class="row">
                                            <span class="col-3">Gaji Pokok</span>
                                            <span class="col" id="new_salary_data">: {{ old("new_salary") ?? $logs["new_salary"] ?? "[Gaji pokok baru]" }}</span>
                                        </span>
                                    </li>

                                    <div id="new_optionals_data">
                                        @if(old("new_optionals"))
                                            @foreach (old("new_optionals") as $index => $item)
                                                <li class="lower-roman-number" id="{{ sprintf('new_optionals_%s_data', $index) }}">
                                                    <span class="row">
                                                        <span class="col-3" id="{{ sprintf('new_optionals_%s_key_data', $index) }}">{{ $item["key"] ?? "[Kata kunci baru]" }}</span>

                                                        <span class="col" id="{{ sprintf('new_optionals_%s_value_data', $index) }}">: {{ $item["value"] ?? "[Data tambahan baru]" }}</span>
                                                    </span>
                                                </li>
                                            @endforeach

                                        @else
                                            @foreach ($logs["new_optionals"] as $index => $item)
                                                <li class="lower-roman-number" id="{{ sprintf('new_optionals_%s_data', $index) }}">
                                                    <span class="row">
                                                        <span class="col-3" id="{{ sprintf('new_optionals_%s_key_data', $index) }}">{{ $item["key"] ?? "[Kata kunci baru]" }}</span>

                                                        <span class="col" id="{{ sprintf('new_optionals_%s_value_data', $index) }}">: {{ $item["value"] ?? "[Data tambahan baru]" }}</span>
                                                    </span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </div>
                                </ol>
                            </td>
                        </tr>
                    </table>
                    <h4><u>Kedua:</u></h4>
                    <p style="margin-top: -15px;" id="decidings_second_data">{{ old("decidings.second") ?? $logs["decidings"]["second"] }}</p>
                </div>
            </div>
        </div>

        <div style="text-align: right; font-size: 11pt; margin-top: 100px;">
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
                        {{ "tanggal, bulan, tahun]" }}
                    @endif
                </span>
            </p>
            <p style="margin-top: -10px; margin-bottom: 70px;">{{ $user->name }}</p>

            <p style="font-style: bold; margin-bottom: -15px;"><u id="signed_name_data">{{ old("signed_name") ?? $logs["signed_name"] ?? "[Nama yang bertanda tangan]" }}</u></p>
            <p id="signed_position_data">{{ old("signed_position") ?? $logs["signed_position"] ?? "[Jabatan yang bertanda tangan]" }}</p>
        </div>
    </div>
    {{-- end-isi-surat --}}
@endsection
