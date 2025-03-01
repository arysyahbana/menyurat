@extends("layouts.letter_main")

@section("letter_content")
    <div class="row vh-100">
        <div class="col-lg-6 create p-5">
            <form action="{{ route('letter.log.store', ['commonLetterLog' => $commonLog->id]) }}" method="post" id="input-letter-form">
                @csrf
                <div class="accordion" id="accordionParent">
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#subject_of_letter" aria-expanded="true" aria-controls="subject_of_letter">
                                <strong>
                                    Pokok Surat
                                </strong>
                            </button>
                        </h2>
                        <div id="subject_of_letter" class="accordion-collapse collapse show" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="attachment">Lampiran</label>
                                    <input type="text" name="attachment" id="attachment" class="form-control @error('attachment') is-invalid @enderror" value="{{ old('attachment') ?? $logs['attachment'] }}">

                                    @error('attachment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="subject">Perihal</label>
                                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') ?? $logs['subject'] }}">

                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="recipient_name">Nama Penerima</label>
                                    <input type="text" name="recipient_name" id="recipient_name" class="form-control @error('recipient_name') is-invalid @enderror" value="{{ old('recipient_name') ?? $logs['recipient_name'] }}">

                                    @error('recipient_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="recipient_address">Alamat Penerima</label>
                                    <input type="text" name="recipient_address" id="recipient_address" class="form-control @error('recipient_address') is-invalid @enderror" value="{{ old('recipient_address') ?? $logs['recipient_address'] }}">

                                    @error('recipient_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#information_letter" aria-expanded="false" aria-controls="information_letter">
                                <strong>
                                    Informasi Surat
                                </strong>
                            </button>
                        </h2>
                        <div id="information_letter" class="accordion-collapse collapse" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="order_number">Nomor Pesanan</label>
                                    <input type="text" name="order_number" id="order_number" class="form-control @error('order_number') is-invalid @enderror" value="{{ old('order_number') ?? $logs['order_number'] }}">

                                    @error('order_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="order_date">Tanggal Pesanan</label>
                                    <input type="date" name="order_date" id="order_date" class="form-control @error('order_date') is-invalid @enderror" value="{{ old('order_date') ?? $logs['order_date'] }}">

                                    @error('order_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 d-flex gap-2 justify-content-between">
                                    <label class="align-self-center">Detail Pesanan</label>
                                    <button type="button" class="btn btn-primary" id="button_add_order_details_data" onclick="addOrderDetailsData()"><i class="fa-solid fa-plus"></i></button>
                                </div>

                                <div class="mb-3" id="order_details_list">
                                    @if (old("order_details"))
                                        @foreach (old("order_details") as $index => $item)
                                            <div id="{{ sprintf('order_details_%s', $index) }}">
                                                <div class="d-flex gap-2 mb-3 justify-content-between">
                                                    <label class="align-self-center text-primer">Barang {{ $loop->iteration }}</label>
                                                    <button type="button" class="btn btn-danger" id="{{ sprintf('button_remove_order_details_%s', $index) }}" onclick="removeOrderDetails('{{ $index }}')"><i class="fa-solid fa-trash"></i></button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 mb-3">
                                                        <label for="{{ sprintf('order_details_%s_name', $index) }}">Nama Barang</label>
                                                        <input type="text" name="{{ sprintf('order_details[%s][name]', $index) }}" id="{{ sprintf('order_details_%s_name', $index) }}" class="form-control @error(sprintf('order_details.%s.name', $index)) is-invalid @enderror" value="{{ $item['name'] }}" required oninput="onInputOrderDetails('{{ $index }}', this, 'name')">

                                                        @error(sprintf('order_details.%s.name', $index))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-lg-4 mb-3">
                                                        <label for="{{ sprintf('order_details_%s_quantity', $index) }}">Jumlah</label>
                                                        <input type="number" name="{{ sprintf('order_details[%s][quantity]', $index) }}" id="{{ sprintf('order_details_%s_quantity', $index) }}" class="form-control @error(sprintf('order_details.%s.quantity', $index)) is-invalid @enderror" value="{{ $item['quantity'] }}" required oninput="onInputOrderDetails('{{ $index }}', this, 'quantity')">

                                                        @error(sprintf('order_details.%s.quantity', $index))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-lg-4 mb-3">
                                                        <label for="{{ sprintf('order_details_%s_price', $index) }}">Harga Satuan</label>
                                                        <input type="number" name="{{ sprintf('order_details[%s][price]', $index) }}" id="{{ sprintf('order_details_%s_price', $index) }}" class="form-control @error(sprintf('order_details.%s.price', $index)) is-invalid @enderror" value="{{ $item['price'] }}" required oninput="onInputOrderDetails('{{ $index }}', this, 'price')">

                                                        @error(sprintf('order_details.%s.price', $index))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    @else
                                        @foreach ($logs["order_details"] as $index => $item)
                                            <div id="{{ sprintf('order_details_%s', $index) }}">
                                                <div class="d-flex gap-2 mb-3 justify-content-between">
                                                    <label class="align-self-center text-primer">Barang {{ $loop->iteration }}</label>
                                                    <button type="button" class="btn btn-danger" id="{{ sprintf('button_remove_order_details_%s', $index) }}" onclick="removeOrderDetails('{{ $index }}')"><i class="fa-solid fa-trash"></i></button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 mb-3">
                                                        <label for="{{ sprintf('order_details_%s_name', $index) }}">Nama Barang</label>
                                                        <input type="text" name="{{ sprintf('order_details[%s][name]', $index) }}" id="{{ sprintf('order_details_%s_name', $index) }}" class="form-control" value="{{ $item['name'] }}" required>
                                                    </div>

                                                    <div class="col-lg-4 mb-3">
                                                        <label for="{{ sprintf('order_details_%s_quantity', $index) }}">Jumlah</label>
                                                        <input type="number" name="{{ sprintf('order_details[%s][quantity]', $index) }}" id="{{ sprintf('order_details_%s_quantity', $index) }}" class="form-control" value="{{ $item['quantity'] }}" required>
                                                    </div>

                                                    <div class="col-lg-4 mb-3">
                                                        <label for="{{ sprintf('order_details_%s_price', $index) }}">Harga Satuan</label>
                                                        <input type="number" name="{{ sprintf('order_details[%s][price]', $index) }}" id="{{ sprintf('order_details_%s_price', $index) }}" class="form-control" value="{{ $item['price'] }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#letter_validation" aria-expanded="false" aria-controls="letter_validation">
                                <strong>
                                    Pengesahan Surat
                                </strong>
                            </button>
                        </h2>
                        <div id="letter_validation" class="accordion-collapse collapse" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="signed_date">Tanggal</label>
                                    <input type="date" name="signed_date" id="signed_date" class="form-control @error('signed_date') is-invalid @enderror" value="{{ old('signed_date') ?? $logs['signed_date'] }}">

                                    @error('signed_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="signed_name">Nama Penanda Tangan</label>
                                    <input type="text" name="signed_name" id="signed_name" class="form-control @error('signed_name') is-invalid @enderror" value="{{ old('signed_name') ?? $logs['signed_name'] }}">

                                    @error('signed_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="signed_position">Jabatan Penanda Tangan</label>
                                    <input type="text" name="signed_position" id="signed_position" class="form-control @error('signed_position') is-invalid @enderror" value="{{ old('signed_position') ?? $logs['signed_position'] }}">

                                    @error('signed_position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
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
                @include("components.buat_surat.kop")
                {{-- end-kop-surat --}}

                {{-- isi-surat --}}
                <div class="mt-3">
                    <div class="letter_header">
                        <div class="d-flex gap-2 justify-content-between">
                            <p>Nomor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $commonLog->number_of_letter ?? "[Nomor surat]" }}</p>
                            <p id="signed_date_data">{{ old("signed_date") ?? $logs["signed_date"] ?? "[Tanggal]" }}</p>
                        </div>
                        <p>Lampiran &nbsp;&nbsp;&nbsp;: <span id="attachment_data">{{ old("attachment") ?? $logs["attachment"] ?? "[Lampiran]" }}</span></p>
                        <p>Perihal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="subject_data">{{ old("subject") ?? $logs["subject"] ?? "[Perihal]" }}</span></p>

                        <p class="mt-3">Kepada Yth,</p>
                        <p class="fw-bold" id="recipient_name_data">{{ old("recipient_name") ?? $logs["recipient_name"] ?? "[Tujuan surat]" }}</p>
                        <p id="recipient_address_data">{{ old("recipient_address") ?? $logs["recipient_address"] }}</p>
                        <p>Di tempat</p>
                    </div>

                    <div class="letter_body mt-4">
                        <p>Dengan hormat,</p>
                        <p>&emsp;&emsp;&emsp;Kami dari {{ $user->name }} ingin mengucapkan terima kasih atas pesanan yang Anda lakukan. Kami dengan senang hati ingin mengkonfirmasi bahwa pesanan Anda dengan rincian sebagai berikut telah kami terima dan sedang diproses:</p>

                        <p>
                            <span>Nomor pesanan</span>
                            <span style="margin-left: 18px">: </span>
                            <span id="order_number_data">{{ old("order_number") ?? $logs["order_number"] ?? "[Nomor pesanan anda]" }}</span>
                        </p>
                        <p>
                            <span>Tanggal pesanan</span>
                            <span style="margin-left: 12px">: </span>
                            <span id="order_date_data">{{ old("order_date") ?? $logs["order_date"] ?? "[Tanggal pesanan]" }}</span>
                        </p>
                        <p>
                            <span>Detail pesanan</span>
                            <span style="margin-left: 23px">: </span>
                        </p>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody id="order_details_data">
                                @if (old("order_details"))
                                    @foreach (old("order_details") as $index => $item)
                                        <tr id="{{ sprintf('order_details_%s_data', $index) }}">
                                            <td>{{ $loop->iteration }}.</td>
                                            <td id="{{ sprintf('order_details_%s_name_data', $index) }}">{{ $item["name"] }}</td>
                                            <td id="{{ sprintf('order_details_%s_quantity_data', $index) }}">{{ $item["quantity"] }}</td>
                                            <td id="{{ sprintf('order_details_%s_price_data', $index) }}">{{ $item["price"] }}</td>
                                        </tr>
                                    @endforeach

                                @else
                                    @foreach ($logs["order_details"] as $index => $item)
                                        <tr id="{{ sprintf('order_details_%s_data', $index) }}">
                                            <td>{{ $loop->iteration }}.</td>
                                            <td id="{{ sprintf('order_details_%s_name_data', $index) }}">{{ $item["name"] }}</td>
                                            <td id="{{ sprintf('order_details_%s_quantity_data', $index) }}">{{ $item["quantity"] }}</td>
                                            <td id="{{ sprintf('order_details_%s_price_data', $index) }}">{{ $item["price"] }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <p>&emsp;&emsp;&emsp;Terima kasih atas kepercayaan Anda kepada {{ $user->name }}. Kami berkomitmen untuk memberikan layanan terbaik kepada Anda dan berharap Anda puas dengan layanan di perusahaan kami.</p>
                    </div>

                    <div class="letter_footer text-end mt-5">
                        <p>Hormat kami,</p>
                        <p class="mb-5">{{ $user->name }}</p>
                        <p class="fw-bold"><u id="signed_name_data">{{ old("signed_name") ?? $logs["signed_name"] ?? "[Nama yang bertanda tangan]" }}</u></p>
                        <p id="signed_position_data">{{ old("signed_position") ?? $logs["signed_position"] ?? "[Jabatan yang bertanda tangan]" }}</p>
                    </div>
                </div>
                 {{-- end-isi-surat --}}

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
    <script src="{{ asset('assets/js/date.js') }}"></script>
    <script src="{{ asset('assets/js/page_break.js') }}"></script>
    <script src="{{ asset('assets/js/buat_surat/order_confirmation.js') }}"></script>

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
