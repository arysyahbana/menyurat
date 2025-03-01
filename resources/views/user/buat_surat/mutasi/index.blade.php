@extends('layouts.letter_main')

@section('letter_content')
    <div class="row vh-100">
        <div class="col-lg-6 create p-5">
            <form action="{{ route('letter.log.store', ['commonLetterLog' => $commonLog->id]) }}" method="post" id="input-letter-form">
                @csrf
                <div class="accordion" id="accordionParent">
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#information_letter" aria-expanded="true" aria-controls="information_letter">
                                <strong>
                                    Informasi Surat
                                </strong>
                            </button>
                        </h2>
                        <div id="information_letter" class="accordion-collapse collapse show" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="mutated_name">Nama yang dimutasi</label>
                                    <input type="text" name="mutated_name" id="mutated_name" class="form-control @error('mutated_name') is-invalid @enderror" value="{{ old('mutated_name') ?? $logs['mutated_name'] }}">

                                    @error("mutated_name")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="mutated_position">Jabatan yang dimutasi</label>
                                    <input type="text" name="mutated_position" id="mutated_position" class="form-control @error('mutated_position') is-invalid @enderror" value="{{ old('mutated_position') ?? $logs['mutated_position'] }}">

                                    @error("mutated_position")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="new_position">Jabatan Baru</label>
                                    <input type="text" name="new_position" id="new_position" class="form-control @error('new_position') is-invalid @enderror" value="{{ old('new_position') ?? $logs['new_position'] }}">

                                    @error("new_position")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="new_office_location">Lokasi kantor yang baru</label>
                                    <input type="text" name="new_office_location" id="new_office_location" class="form-control @error('new_office_location') is-invalid @enderror" value="{{ old('new_office_location') ?? $logs['new_office_location'] }}">

                                    @error("new_office_location")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="effective_date">Tanggal efektif berlaku</label>
                                    <input type="date" name="effective_date" id="effective_date" class="form-control @error('effective_date') is-invalid @enderror" value="{{ old('effective_date') ?? $logs['effective_date'] }}">

                                    @error("effective_date")
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
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#letter_validation" aria-expanded="false" aria-controls="letter_validation">
                                <strong>
                                    Pengesahan Surat
                                </strong>
                            </button>
                        </h2>
                        <div id="letter_validation" class="accordion-collapse collapse" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="signed_place">Tempat</label>
                                    <input type="text" name="signed_place" id="signed_place" class="form-control @error('signed_place') is-invalid @enderror" value="{{ old('signed_place') ?? $logs['signed_place'] }}">

                                    @error("signed_place")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="signed_date">Tanggal</label>
                                    <input type="date" name="signed_date" id="signed_date" class="form-control @error('signed_date') is-invalid @enderror" value="{{ old('signed_date') ?? $logs['signed_date'] }}">

                                    @error("signed_date")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="signed_name">Nama yang bertanda-tangan</label>
                                    <input type="text" name="signed_name" id="signed_name" class="form-control @error('signed_name') is-invalid @enderror" value="{{ old('signed_name') ?? $logs['signed_name'] }}">

                                    @error("signed_name")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="signed_position">Jabatan Penanda tangan</label>
                                    <input type="text" name="signed_position" id="signed_position" class="form-control @error('signed_position') is-invalid @enderror" value="{{ old('signed_position') ?? $logs['signed_position'] }}">

                                    @error("signed_position")
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
                    <div class="letter_header text-center">
                        <h1 class="fw-bold text-dark text-8"><u>SURAT MUTASI</u></h1>
                        <p class="mt-n7">No. {{ $commonLog->number_of_letter ?? "[Nomor surat]" }}</p>
                    </div>

                    <div class="letter_body mt-4">
                        <p>Yang bertanda tangan dibawah ini:</p>
                        <p>
                            <span>Nama</span>
                            <span style="margin-left: 18px">: </span>
                            <span class="fw-bold" id="signed_name_data">{{ old("signed_name") ?? $logs["signed_name"] ?? "[Nama yang bertanda tangan]" }}</span>
                        </p>
                        <p>
                            <span>Jabatan</span>
                            <span style="margin-left: 8px">: </span>
                            <span id="signed_position_data">{{ old("signed_position") ?? $logs["signed_position"] ?? "[Jabatan yang bertanda tangan]" }}</span>
                        </p>

                        <p class="mt-2">Memutuskan untuk melakukan mutasi terhadap karyawan {{ $user->name }} yang tersebut di bawah ini:</p>
                        <p>
                            <span>Nama</span>
                            <span style="margin-left: 18px">: </span>
                            <span class="fw-bold" id="mutated_name_data">{{ old("mutated_name") ?? $logs["mutated_name"] ?? "[Nama yang dimutasi]" }}</span>
                        </p>
                        <p>
                            <span>Jabatan</span>
                            <span style="margin-left: 8px">: </span>
                            <span id="mutated_position_data">{{ old("mutated_position") ?? $logs["mutated_position"] ?? "[Jabatan yang dimutasi]" }}</span>
                        </p>

                        <p class="mt-2">Jabatan serta lokasi kantor yang baru adalah sebagai berikut:</p>
                        <p>
                            <span>Jabatan</span>
                            <span style="margin-left: 8px">: </span>
                            <span id="new_position_data">{{ old("new_position") ?? $logs["new_position"] ?? "[Jabatan baru]" }}</span>
                        </p>
                        <p>
                            <span>Kantor</span>
                            <span style="margin-left: 16px">: </span>
                            <span id="new_office_location_data">{{ old("new_office_location") ?? $logs["new_office_location"] ?? "[Lokasi kantor baru]" }}</span>
                        </p>

                        <p class="mt-2">&emsp;&emsp;&emsp;Surat Keputusan Mutasi ini mulai efektif pada <span id="effective_date_data">
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

                    <div class="letter_footer text-end mt-5">
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
                        <p class="mb-5">{{ $user->name }}</p>
                        <p class="fw-bold"><u id="signed_name_data_2">{{ old("signed_name") ?? $logs["signed_name"] ?? "[Nama yang bertanda tangan]" }}</u></p>
                        <p id="signed_position_data_2">{{ old("signed_position") ?? $logs["signed_position"] ?? "[Jabatan yang bertanda tangan]" }}</p>
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
    <script src="{{ asset("assets/js/date.js") }}"></script>
    <script src="{{ asset('assets/js/page_break.js') }}"></script>
    <script src="{{ asset("assets/js/buat_surat/mutasi.js") }}"></script>

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
