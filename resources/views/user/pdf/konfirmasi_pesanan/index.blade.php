@extends('layouts.pdf')

@section('title', 'Konfirmasi Pesanan')

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
                <p style="text-indent: 30px; margin-top: -10px">Kami dari {{ $user->name }} ingin mengucapkan terima kasih atas pesanan yang Anda lakukan. Kami dengan senang hati ingin mengkonfirmasi bahwa pesanan Anda dengan rincian sebagai berikut telah kami terima dan sedang diproses:</p>

                 <p>
                    <span>Nomor pesanan</span>
                    <span style="margin-left: 18px">: </span>
                    <span id="order_number_data">{{ old("order_number") ?? $logs["order_number"] ?? "[Nomor pesanan anda]" }}</span>
                </p>
                <p style="margin-top: -10px">
                    <span>Tanggal pesanan</span>
                    <span style="margin-left: 12px">: </span>
                    <span id="order_date_data">{{ old("order_date") ?? $logs["order_date"] ?? "[Tanggal pesanan]" }}</span>
                </p>
                <p style="margin-top: -10px">
                    <span>Detail pesanan</span>
                    <span style="margin-left: 23px">: </span>
                </p>

                <table width="100%" style="text-align: center; border: 0.5px solid #ccc;  border-collapse: collapse;">
                    <thead style="background-color: #e5e7eb">
                        <tr>
                            <th style="padding: 8px;">No.</th>
                            <th style="padding: 8px;">Nama Barang</th>
                            <th style="padding: 8px;">Jumlah</th>
                            <th style="padding: 8px;">Harga</th>
                        </tr>
                    </thead>
                    <tbody id="order_details_data">
                        @if (old("order_details"))
                            @foreach (old("order_details") as $index => $item)
                                <tr id="{{ sprintf('order_details_%s_data', $index) }}">
                                    <td style="border: 0.5px solid #ccc; padding: 8px;">{{ $loop->iteration }}.</td>
                                    <td style="border: 0.5px solid #ccc; padding: 8px;" id="{{ sprintf('order_details_%s_name_data', $index) }}">{{ $item["name"] }}</td>
                                    <td style="border: 0.5px solid #ccc; padding: 8px;" id="{{ sprintf('order_details_%s_quantity_data', $index) }}">{{ $item["quantity"] }}</td>
                                    <td style="border: 0.5px solid #ccc; padding: 8px;" id="{{ sprintf('order_details_%s_price_data', $index) }}">{{ $item["price"] }}</td>
                                </tr>
                            @endforeach

                        @else
                            @foreach ($logs["order_details"] as $index => $item)
                                <tr id="{{ sprintf('order_details_%s_data', $index) }}">
                                    <td style="border: 0.5px solid #ccc; padding: 8px;">{{ $loop->iteration }}.</td>
                                    <td style="border: 0.5px solid #ccc; padding: 8px;" id="{{ sprintf('order_details_%s_name_data', $index) }}">{{ $item["name"] }}</td>
                                    <td style="border: 0.5px solid #ccc; padding: 8px;" id="{{ sprintf('order_details_%s_quantity_data', $index) }}">{{ $item["quantity"] }}</td>
                                    <td style="border: 0.5px solid #ccc; padding: 8px;" id="{{ sprintf('order_details_%s_price_data', $index) }}">{{ $item["price"] }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <p style="text-indent: 30px; margin-top: 10px;">Terima kasih atas kepercayaan Anda kepada {{ $user->name }}. Kami berkomitmen untuk memberikan layanan terbaik kepada Anda dan berharap Anda puas dengan layanan di perusahaan kami.</p>
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
