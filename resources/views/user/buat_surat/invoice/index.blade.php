@extends('layouts.letter_main')

@section('letter_content')
    <div class="row vh-100">
        <div class="col-lg-6 create p-5">
            <form action="{{ route('letter.log.store', ['commonLetterLog' => $commonLog->id]) }}" method="post" id="input-letter-form">
                @csrf
                <div class="accordion" id="accordionParent">
                    {{-- informasi customer --}}
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#informasi_customer" aria-expanded="true" aria-controls="informasi_customer">
                                <strong>
                                    Informasi Customer
                                </strong>
                            </button>
                        </h2>
                        <div id="informasi_customer" class="accordion-collapse collapse show" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="customer_name">Nama Customer</label>
                                    <input type="text" name="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') ?? $logs['customer_name'] }}">

                                    @error("customer_name")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="customer_address">Alamat Customer</label>
                                    <textarea name="customer_address" id="customer_address" class="form-control @error('customer_address') is-invalid @enderror" id="">{{ old('customer_address') ?? $logs['customer_address'] }}</textarea>

                                    @error("customer_address")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="customer_phone">No. HP Customer</label>
                                    <input type="number" name="customer_phone" id="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') ?? $logs['customer_phone'] }}">

                                    @error("customer_phone")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end-informasi-customer --}}

                    {{-- informasi invoice --}}
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#informasi_invoice" aria-expanded="false" aria-controls="informasi_invoice">
                                <strong>
                                    Informasi Invoice
                                </strong>
                            </button>
                        </h2>
                        <div id="informasi_invoice" class="accordion-collapse collapse" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="invoice#">Invoice #</label>
                                    <input type="text" name="invoice#" id="invoice#" class="form-control @error('invoice#') is-invalid @enderror" value="{{ old('invoice#') ?? $logs['invoice#'] }}">

                                    @error("invoice#")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="invoice_due">Invoice Due</label>
                                    <input type="date" name="invoice_due" id="invoice_due" class="form-control @error('invoice_due') is-invalid @enderror" value="{{ old('invoice_due') ?? $logs['invoice_due'] }}">

                                    @error("invoice_due")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" name="due_date" id="due_date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date') ?? $logs['due_date'] }}">

                                    @error("due_date")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end-informasi-invoice --}}

                    {{-- informasi item --}}
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#informasi_item" aria-expanded="false" aria-controls="informasi_item">
                                <strong>
                                    Informasi Item
                                </strong>
                            </button>
                        </h2>
                        <div id="informasi_item" class="accordion-collapse collapse" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div id="dynamic-input-container">
                                    <input type="hidden" name="subtotal" id="subtotal">
                                    <input type="hidden" name="total" id="total">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="col col-4">
                                            <div class="mb-3">
                                                <label for="item_desc">Item Description</label>
                                                <input type="text" name="item_details[0][item_desc]" id="item_desc" class="form-control @error('item_desc') is-invalid @enderror" value="{{ old('item_desc') ?? '' }}">

                                                @error("item_desc")
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col col-2">
                                            <div class="mb-3">
                                                <label for="unit_price">Unit Price</label>
                                                <input type="number" name="item_details[0][unit_price]" id="unit_price" class="form-control @error('unit_price') is-invalid @enderror" value="{{ old('unit_price') ?? '' }}">

                                                @error("unit_price")
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col col-2">
                                            <div class="mb-3">
                                                <label for="qty">Qty</label>
                                                <input type="number" name="item_details[0][qty]" id="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty') ?? '' }}">

                                                @error("qty")
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col col-2">
                                            <div class="mb-3">
                                                <label for="amount">Amount</label>
                                                <input type="number" name="item_details[0][amount]" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') ?? '' }}">

                                                @error("amount")
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col col-2">
                                            <button type="button" class="btn btn-primary mt-2 add-item"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>

                                    @if (old('item_details'))
                                        @foreach (old('item_details') as $index => $item)
                                            @if ($index>0)
                                                <div class="d-flex align-items-center gap-3 mb-3">
                                                    <div class="col col-4">
                                                        <input type="text" name="item_details[{{ $index }}][item_desc]" class="form-control @error("item_details.$index.item_desc") is-invalid @enderror" value="{{ old("item_details.$index.item_desc") }}">
                                                        @error("item_details.$index.item_desc")
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col col-2">
                                                        <input type="number" name="item_details[{{ $index }}][unit_price]" class="form-control @error("item_details.$index.unit_price") is-invalid @enderror" value="{{ old("item_details.$index.unit_price") }}">
                                                        @error("item_details.$index.unit_price")
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col col-2">
                                                        <input type="number" name="item_details[{{ $index }}][qty]" class="form-control @error("item_details.$index.qty") is-invalid @enderror" value="{{ old("item_details.$index.qty") }}">
                                                        @error("item_details.$index.qty")
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col col-2">
                                                        <input type="number" name="item_details[{{ $index }}][amount]" class="form-control @error("item_details.$index.amount") is-invalid @enderror" value="{{ old("item_details.$index.amount") }}">
                                                        @error("item_details.$index.amount")
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col col-2">
                                                        <button type="button" class="btn btn-danger remove-item"><i class="fa-solid fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($logs['item_details'] as $index => $item)
                                            @if ($index > 0)
                                                <div class="d-flex align-items-center gap-3 mb-3">
                                                    <div class="col col-4">
                                                        <input type="text" name="item_details[{{ $index }}][item_desc]" class="form-control" value="{{ $item->item_desc }}">
                                                    </div>
                                                    <div class="col col-2">
                                                        <input type="number" name="item_details[{{ $index }}][unit_price]" class="form-control" value="{{ $item->unit_price }}">
                                                    </div>
                                                    <div class="col col-2">
                                                        <input type="number" name="item_details[{{ $index }}][qty]" class="form-control" value="{{ $item->qty }}">
                                                    </div>
                                                    <div class="col col-2">
                                                        <input type="number" name="item_details[{{ $index }}][amount]" class="form-control" value="{{ $item->amount }}">
                                                    </div>
                                                    <div class="col col-2">
                                                        <button type="button" class="btn btn-danger remove-item"><i class="fa-solid fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end-informasi-item --}}

                    {{-- harga lainnya --}}
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#harga_lainnya" aria-expanded="false" aria-controls="harga_lainnya">
                                <strong>
                                    Harga Lainnya
                                </strong>
                            </button>
                        </h2>
                        <div id="harga_lainnya" class="accordion-collapse collapse" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="discount">Diskon</label>
                                    <input type="number" name="discount" id="discount" class="form-control @error('discount') is-invalid @enderror" value="{{ old('discount') ?? $logs['discount'] }}">

                                    @error("discount")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tax">Tax</label>
                                    <input type="number" name="tax" id="tax" class="form-control @error('tax') is-invalid @enderror" value="{{ old('tax') ?? $logs['tax'] }}">

                                    @error("tax")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="shipping">Shipping</label>
                                    <input type="number" name="shipping" id="shipping" class="form-control @error('shipping') is-invalid @enderror" value="{{ old('shipping') ?? $logs['shipping'] }}">

                                    @error("shipping")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end harga lainnya --}}

                    {{-- payment method --}}
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment_method" aria-expanded="false" aria-controls="payment_method">
                                <strong>
                                    Metode Bayar
                                </strong>
                            </button>
                        </h2>
                        <div id="payment_method" class="accordion-collapse collapse" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="account">Account</label>
                                    <input type="number" name="account" id="account" class="form-control @error('account') is-invalid @enderror" value="{{ old('account') ?? $logs['account'] }}">

                                    @error("account")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ac_name">A/C Name</label>
                                    <input type="text" name="ac_name" id="ac_name" class="form-control @error('ac_name') is-invalid @enderror" value="{{ old('ac_name') ?? $logs['ac_name'] }}">

                                    @error("ac_name")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="bank_details">Bank Details</label>
                                    <input type="text" name="bank_details" id="bank_details" class="form-control @error('bank_details') is-invalid @enderror" value="{{ old('bank_details') ?? $logs['bank_details'] }}">

                                    @error("bank_details")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end payment method --}}
                </div>

                <div class="btn-group dropend mt-4">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Simpan sebagai...
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button type="submit" class="dropdown-item">Draft</button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalNomorSurat" id="btnTerbit">
                                Terbitkan
                            </button>
                        </li>
                    </ul>
                </div>
            </form>
        </div>

        <div class="col-lg-6 preview p-5 d-none d-lg-block">
            <div class="surat mx-5">
                {{-- kop-surat --}}
                <div class="kop_surat">
                    <div class="gambar">
                        @if ($user->logo_url)
                            <img src="{{ asset('storage/' . $user->logo_url) }}" alt="Logo perusahaan">
                        @else
                            <img src="{{ asset('assets/img/profil2.png') }}" alt="Logo perusahaan">
                        @endif
                    </div>
                    <div class="text-end my-3">
                        <h1 class="text-dark display-6">
                            <strong>INVOICE</strong>
                        </h1>
                    </div>
                </div>
                {{-- end-kop-surat --}}

                {{-- info --}}
                <div class="row mt-5">
                    <div class="col col-5">
                        <div class="">
                            <h1 class="text-dark text-8">
                                <strong>{{ strtoupper($user->name) }}</strong>
                            </h1>
                            <p class="mt-n7">
                                {{ $user->street }}, Kelurahan {{ $user->urbanVillage->name }}, Kecamatan {{ $user->district->name }},
                                Kota {{ $user->region->name }}, Provinsi {{ $user->province->name }}
                            </p>
                            <div class="d-flex gap-2 align-items-center">
                                <i class="bi bi-telephone-fill"></i>
                                <p>{{ $user->phone_number }}</p>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <i class="bi bi-envelope-fill"></i>
                                <p><span class="text-primary"><u>{{ $user->email }}</u></span></p>
                            </div>

                            @if ($user->web_url)
                                <div class="d-flex gap-2 align-items-center">
                                    <i class="bi bi-globe"></i>
                                    <p><span class="text-primary"><u>{{ $user->web_url }}</u></span></p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col col-2"></div>
                    <div class="col col-5">
                        <div class="">
                            <p>Bill to :</p>
                            <p class="fw-bold customer_name">{{ old("customer_name") ?? $logs["customer_name"] ?? "[Customer Name]" }}</p>
                            <p class="customer_address">
                                {{ old("customer_address") ?? $logs["customer_address"] ?? "[Customer Address]" }}
                            </p>
                            <div class="d-flex gap-2 align-items-center">
                                <i class="bi bi-telephone-fill"></i>
                                <p class="customer_phone">{{ old("customer_phone") ?? $logs["customer_phone"] ?? "[Customer Phone]" }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end-info --}}

                {{-- invoce-info --}}
                <div class="d-flex gap-5 justify-content-center mt-5">
                    <div class="border-start border-dark py-1 px-3">
                        <p class="fw-bold">Invoice #</p>
                        <p class="no_invoice">{{ old("invoice#") ?? $logs["invoice#"] ?? "[No Invoice]" }}</p>
                    </div>
                    <div class="border-start border-dark py-1 px-3">
                        <p class="fw-bold">Invoice Due</p>
                        <p class="invoice_due">{{ old("invoice_due") ?? $logs["invoice_due"] ?? "[Invoice Due]" }}</p>
                    </div>
                    <div class="border-start border-dark py-1 px-3">
                        <p class="fw-bold">Due Date</p>
                        <p class="due_date">{{ old("due_date") ?? $logs["due_date"] ?? "[Due Date]" }}</p>
                    </div>
                </div>
                {{-- end-invoce-info --}}

                {{-- isi-invoice --}}
                <div class="mt-5 table-responsive">
                    <table class="table table-hover">
                    <thead>
                        <tr class="table-secondary">
                            <th scope="col">Item Description</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Amount</th>
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
                </div>
                {{-- end-isi-invoice --}}

                {{-- payment --}}
                <div class="row mt-5">
                    <div class="col col-5">
                        <div class="row">
                            <div class="col col-12">
                                <p class="fw-bold mb-2">Payment Method</p>
                                <table>
                                    <tr>
                                        <td>Account</td>
                                        <td class="ps-4 account">{{ old("account") ?? $logs["account"] ?? "[Account]" }}</td>
                                    </tr>
                                    <tr>
                                        <td>A/C Name</td>
                                        <td class="ps-4 ac-name">{{ old(key: "ac_name") ?? $logs["ac_name"] ?? "[A/C Name]" }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bank Details</td>
                                        <td class="ps-4 bank-details">{{ old("bank_details") ?? $logs["bank_details"] ?? "[Bank Details]" }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col col-12 mt-4">
                                <p class="fw-bold mb-2">Term & Condition</p>
                                <p>Please make the payment due date</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col col-5">
                        <div class="d-flex justify-content-between">
                            <p>Subtotal</p>
                            <p class="subtotal">Rp. {{ $logs["subtotal"] ?? "0" }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Diskon</p>
                            <p class="discount">-Rp. {{ $logs["discount"] ?? "0" }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Tax</p>
                            <p class="tax">Rp. {{ $logs["tax"] ?? "Rp. 0" }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Shipping</p>
                            <p class="shipping">Rp. {{ $logs["shipping"] ?? "0" }}</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="fw-bold">Total</p>
                            <p class="total">Rp. {{ $logs["total"] ?? "0" }}</p>
                        </div>
                    </div>
                </div>
                {{-- end-payment --}}

                <div class="page-break"></div>
            </div>
        </div>
    </div>

    <!-- Modal Update Nomor Surat -->
    <div class="modal fade mt-5" id="modalNomorSurat" tabindex="-1" aria-labelledby="modalNomorSuratLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-body my-4 mx-3">
                <form action="{{ route('letter.log.publish', ['commonLetterLog' => $commonLog->id]) }}" method="post"
                    id="update-number-of-letter">
                    @csrf
                    @method("PUT")
                    <div class="text-center mb-4">
                        <label for="name" class="mb-3">
                            <h2 class="modal-title fs-5" id="staticBackdropLabel">Silahkan Masukan Nomor Surat</h2>
                        </label>
                        <input type="text" name="number_of_letter" class="form-control" id="number_of_letter"
                            placeholder="Nomor surat..." required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" id="btnSubmitNomorSurat">Terbitkan Surat</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

@section("javascript")
    <script src="{{ asset("assets/js/date.js") }}"></script>
    <script src="{{ asset('assets/js/page_break.js') }}"></script>
    <script src="{{ asset("assets/js/buat_surat/invoice.js") }}"></script>

    <script>
        $(document).ready(function () {
        $("#btnTerbit").click(function () {
            let formData = $("#input-letter-form").serialize(); // Ambil data form surat

            $.post("{{ route('letter.log.store', ['commonLetterLog' => $commonLog->id]) }}", formData, function (response) {
                console.log("Data surat berhasil disimpan sebagai draft.");

                // Tahan redirect dan tampilkan modal input nomor surat
                $("#modalNomorSurat").modal("show");
            }).fail(function (error) {
                console.error("Gagal menyimpan surat:", error);
            });
        });

        // Saat tombol submit nomor surat ditekan
        $("#btnSubmitNomorSurat").click(function () {
            let numberOfLetter = $("#number_of_letter").val(); // Ambil nomor surat yang dimasukkan

            $.post("{{ route('letter.log.publish', ['commonLetterLog' => $commonLog->id]) }}", { number_of_letter: numberOfLetter }, function (response) {
                console.log("Surat berhasil diterbitkan.");
                window.location.href = "/dashboard"; // Redirect setelah sukses
            }).fail(function (error) {
                console.error("Gagal menerbitkan surat:", error);
            });
        });
    });
    </script>
@endsection
