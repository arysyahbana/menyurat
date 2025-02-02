<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="{{ asset("assets/icon/favicon.ico") }}">
    <title>Invoice</title>
</head>
<style>
    .mb-0 {
        margin-bottom: 0 !important;
    }
    .mb-5{
        margin-bottom: 5px !important;
    }
    .flex {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .no-link {
        text-decoration: none;
        color: rgb(35, 144, 216) !important; /* Warna mengikuti elemen induk */
        cursor: default;
    }
    .pl-10 {
        padding-left: 10px !important;
    }
    .pl-70 {
        padding-left: 70px !important;
    }
    .v-align-top {
        vertical-align: top;
    }
    .mt-20 {
        margin-top: 20px;
    }
    .mt-30 {
        margin-top: 30px;
    }
    .compact-table {
        border-collapse: collapse;
        width: auto; /* Gunakan auto agar tidak memenuhi seluruh lebar */
        padding-top: 20px;
        margin: 20px auto; /* Pastikan tabel benar-benar berada di tengah */
        display: table;
        text-align: center;
    }

    .compact-table td {
        padding: 5px 15px; /* Sesuaikan padding agar lebih rapat */
        border-left: 2px solid;
    }

    .compact-table p {
        margin: 0; /* Menghilangkan margin agar lebih rapat */
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        overflow: hidden;
        font-size: 11pt;
        border: 0.5px solid #ccc;
        border-collapse: collapse;
    }

    .styled-table thead {
        background-color: #e5e7eb; /* Warna abu-abu mirip pada gambar */
    }

    .styled-table th {
        padding: 12px;
        text-align: center; /* Header rata tengah */
        font-weight: bold;
    }

    .styled-table td {
        border: 0.5px solid #ccc;
        padding: 8px;
        text-align: center; /* Data tetap rata kiri */
    }

    .styled-table tbody tr:not(:last-child) {
        border-bottom: 1px solid #d1d5db; /* Garis bawah antar data */
    }

    .text-11 {
        font-size: 11pt;
    }

</style>
<body>
    <table width="100%">
        <tr>
            <td width="50%">
                @if ($user->logo_url)
                    <img src="{{ public_path('storage/' . $user->logo_url) }}" alt="Logo perusahaan" style="height:100px">
                @else
                    <img src="{{ public_path('assets/img/profil2.png') }}" alt="Logo perusahaan">
                @endif
            </td>
            <td width="50%" style="text-align: right">
                <h1 class="">
                    <strong>INVOICE</strong>
                </h1>
            </td>
        </tr>
    </table>

    <table width="100%" class="mt-20 text-11">
        <tr>
            <td width="50%" class="v-align-top">
                <p class="mb-0">
                    <strong>{{ strtoupper($user->name) }}</strong>
                </p>
                <p class="mb-5">
                    {{ $user->street }}, Kelurahan {{ $user->urbanVillage->name }}, Kecamatan {{ $user->district->name }},
                    Kota {{ $user->region->name }}, Provinsi {{ $user->province->name }}
                </p>
                <div class="mb-5">
                    <img src="{{ public_path('assets/img/telp.png') }}" alt="">
                    <span class="pl-10">{{ $user->phone_number }}</span>
                </div>
                <div class="mb-5">
                    <img src="{{ public_path('assets/img/mail.png') }}" alt="">
                    <span class="no-link pl-10">{{ $user->email }}</span>
                </div>

                @if ($user->web_url)
                    <div class="d-flex gap-2 align-items-center">
                        <img src="{{ public_path('assets/img/web.png') }}" alt="">
                        <span class="no-link pl-10">{{ $user->web_url }}</span>
                    </div>
                @endif
            </td>
            <td width="50%" class="pl-70 v-align-top">
                <p>Bill to :</p>
                <p class="mb-5">
                    <strong>
                        {{ old("customer_name") ?? $logs["customer_name"] ?? "[Customer Name]" }}
                    </strong>
                </p>
                <p class="mb-5">
                    {{ old("customer_address") ?? $logs["customer_address"] ?? "[Customer Address]" }}
                </p>
                <div class="d-flex gap-2 align-items-center">
                    <img src="{{ public_path('assets/img/telp.png') }}" alt="">
                    <span class="pl-10">{{ old("customer_phone") ?? $logs["customer_phone"] ?? "[Customer Phone]" }}</span>
                </div>
            </td>
        </tr>
    </table>

    <table class="compact-table text-11">
        <tr>
            <td style="border-left: 2px solid; padding-left: 10px; padding-right: 50px">
                <p style="text-align: left">Invoice #</p>
                <p style="text-align: left">{{ old("invoice#") ?? $logs["invoice#"] ?? "[No Invoice]" }}</p=>
            </td>
            <td style="border-left: 2px solid; padding-left: 10px; padding-right: 50px">
                <p style="text-align: left">Invoice Due</p>
                <p style="text-align: left">{{ old("invoice_due") ?? $logs["invoice_due"] ?? "[Invoice Due]" }}</p>
            </td>
            <td style="border-left: 2px solid; padding-left: 10px; padding-right: 50px">
                <p style="text-align: left">Due Date</p>
                <p style="text-align: left">{{ old("due_date") ?? $logs["due_date"] ?? "[Due Date]" }}</p>
            </td>
        </tr>
    </table>

    <table width="100%" class="mt-30 styled-table">
        <thead>
            <tr>
                <th>Item Description</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @if (old("item_details"))
                @foreach (old("item_details") as $index => $item)
                    @if ($index > 0)
                        <tr id="{{ sprintf('item_details_%s', $index) }}">
                            <td>{{ $item["item_desc"] }}</td>
                            <td>Rp. {{ number_format($item["unit_price"], 0, ',', '.') }}</td>
                            <td>{{ $item["qty"] }}</td>
                            <td>Rp. {{ number_format($item["amount"], 0, ',', '.') }}</td>
                        </tr>
                    @endif
                @endforeach
            @else
                @foreach ($logs["item_details"] as $index => $item)
                    @if ($index > 0)
                        <tr id="{{ sprintf('item_details_%s', $index) }}">
                            <td>{{ $item->item_desc }}</td>
                            <td>Rp. {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp. {{ number_format($item->amount, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>

    <table width="100%" class="text-11">
        <tr>
            <td>
                <p><b>Payment Method</b></p>
                <table width="60%">
                    <tr>
                        <td>Account</td>
                        <td>{{ old("account") ?? $logs["account"] ?? "[Account]" }}</td>
                    </tr>
                    <tr>
                        <td>A/C Name</td>
                        <td>{{ old(key: "ac_name") ?? $logs["ac_name"] ?? "[A/C Name]" }}</td>
                    </tr>
                    <tr>
                        <td>Bank Details</td>
                        <td>{{ old("bank_details") ?? $logs["bank_details"] ?? "[Bank Details]" }}</td>
                    </tr>
                </table>
            </td>
            <td>
                <table width="100%" style="margin-top: 100px">
                    <tr>
                        <td>Subtotal</td>
                        <td style="text-align: right">Rp. {{ $logs["subtotal"] ?? "Rp. 0" }}</td>
                    </tr>
                    <tr>
                        <td>Diskon</td>
                        <td style="text-align: right">Rp. {{ $logs["discount"] ?? "Rp. 0"}}</td>
                    </tr>
                    <tr>
                        <td>Tax</td>
                        <td style="text-align: right">Rp. {{ $logs["tax"] ?? "Rp. 0" }}</td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td style="text-align: right">Rp. {{ $logs["shipping"] ?? "Rp. 0" }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td><b>Total</b></td>
                        <td style="text-align: right">Rp. {{ $logs["total"] ?? "Rp. 0" }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p class="text-11"><b>Term & Condition</b></p>
    <p class="text-11">Please make the payment due date</p>
</body>
</html>
