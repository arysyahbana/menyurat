@extends('layouts.pdf')

@section('title', 'Balasan')

@section('content')
    {{-- isi-surat --}}
    <table width="100%" style="font-size: 11pt">
        <tr style="vertical-align: top">
            <td>
                <table width="70%">
                    <tr>
                        <td>Nomor</td>
                        <td>:</td>
                        <td>{{ $commonLog->number_of_letter ?? "[Nomor surat]" }}</td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td>{{ old("attachment") ?? $logs["attachment"] ?? "[Lampiran]" }}</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td>{{ old("subject") ?? $logs["subject"] ?? "[Perihal]" }}</td>
                    </tr>
                </table>
            </td>
            <td style="text-align: right">{{ old("signed_date") ?? $logs["signed_date"] ?? "[Tanggal]" }}</td>
        </tr>
        <tr>
            <td colspan="2" style="padding-left: 5px">
                <p style="margin-top: 30px">Kepada Yth,</p>
                <p style="font-weight: bold; margin-top: -12px;" id="recipient_name_data">{{ old("recipient_name") ?? $logs["recipient_name"] ?? "[Tujuan surat]" }}</p>
                <p style="margin-top: -12px;" id="recipient_address_data">{{ old("recipient_address") ?? $logs["recipient_address"] }}</p>
                <p style="margin-top: -8px">Di tempat</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-left: 5px">
                <p>Dengan hormat,</p>
                <p style="text-indent: 30px; margin-top: -10px">&emsp;&emsp;&emsp;<span id="contents_first_data">{{ old("contents.first") ?? $logs["contents"]["first"] }}</span></p>
                <p style="text-indent: 30px;">&emsp;&emsp;&emsp;<span id="contents_second_data">{{ old("contents.second") ?? $logs["contents"]["second"] }}</span></p>
                <p style="text-indent: 30px;">&emsp;&emsp;&emsp;<span id="contents_third_data">{{ old("contents.third") ?? $logs["contents"]["third"] }}</span></p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right">
                <p>Hormat kami,</p>
                <p style="margin-top: -15px">{{ $user->name }}</p>
                <p style="font-weight: bold; margin-top: 80px;"><u id="signed_name_data">{{ old("signed_name") ?? $logs["signed_name"] ?? "[Nama yang bertanda tangan]" }}</u></p>
                <p style="margin-top: -15px" id="signed_position_data">{{ old("signed_position") ?? $logs["signed_position"] ?? "[Jabatan yang bertanda tangan]" }}</p>
            </td>
        </tr>
    </table>
    {{-- end-isi-surat --}}
@endsection
