@extends('layouts.letter_main')

@section('letter_content')
    <div class="row vh-100">
        <div class="col-lg-6 create p-5">
            <form action="{{ route('letter.log.store', ['commonLetterLog' => $commonLog->id]) }}" method="post" id="input-letter-form">
                @csrf

                <input type="hidden" name="action" id="action" value="draft">

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
                        <h2 class="accordion-header  ">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#content_of_letter" aria-expanded="false" aria-controls="content_of_letter">
                                <strong>
                                    Isi Surat
                                </strong>
                            </button>
                        </h2>
                        <div id="content_of_letter" class="accordion-collapse collapse" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="contents_first">Paragraf Satu</label>
                                    <textarea name="contents[first]" id="contents_first" class="form-control @error('contents.first') is-invalid @enderror" rows="3">{{ old('contents.first') ?? $logs["contents"]["first"] }}</textarea>

                                    @error('contents.first')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="contents_second">Paragraf Dua</label>
                                    <textarea name="contents[second]" id="contents_second" class="form-control @error('contents.second') is-invalid @enderror" rows="3">{{ old('contents.second') ?? $logs["contents"]["second"] }}</textarea>

                                    @error('contents.second')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="contents_third">Penutup</label>
                                    <textarea name="contents[third]" id="contents_third" class="form-control @error('contents.third') is-invalid @enderror" rows="3">{{ old('contents.third') ?? $logs["contents"]["third"] }}</textarea>

                                    @error('contents.third')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header  ">
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
                        <p>&emsp;&emsp;&emsp;<span id="contents_first_data">{{ old("contents.first") ?? $logs["contents"]["first"] }}</span></p>
                        <p>&emsp;&emsp;&emsp;<span id="contents_second_data">{{ old("contents.second") ?? $logs["contents"]["second"] }}</span></p>
                        <p>&emsp;&emsp;&emsp;<span id="contents_third_data">{{ old("contents.third") ?? $logs["contents"]["third"] }}</span></p>
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
    <script src="{{ asset('assets/js/buat_surat/response.js') }}"></script>

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
