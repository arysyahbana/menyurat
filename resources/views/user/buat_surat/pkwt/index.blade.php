@extends("layouts.letter_main")

@section("letter_content")
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
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="d-block"><strong>Pihak Pertama</strong></label>
                                        <label><strong>(Perusahaan)</strong></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <label for="first_name">Nama</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') ?? $logs['first_name'] }}">

                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="first_position">Jabatan</label>
                                            <input type="text" name="first_position" id="first_position" class="form-control @error('first_position') is-invalid @enderror" value="{{ old('first_position') ?? $logs['first_position'] }}">

                                            @error('first_position')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="first_address">Alamat</label>
                                            <input type="text" name="first_address" id="first_address" class="form-control @error('first_address') is-invalid @enderror" value="{{ old('first_address') ?? $logs['first_address'] }}">

                                            @error('first_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="d-block"><strong>Pihak Kedua</strong></label>
                                        <label><strong>(Karyawan)</strong></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <label for="second_name">Nama</label>
                                            <input type="text" name="second_name" id="second_name" class="form-control @error('second_name') is-invalid @enderror" value="{{ old('second_name') ?? $logs['second_name'] }}">

                                            @error('second_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="second_place_of_birth">Tempat Lahir</label>
                                            <input type="text" name="second_place_of_birth" id="second_place_of_birth" class="form-control @error('second_place_of_birth') is-invalid @enderror" value="{{ old('second_place_of_birth') ?? $logs['second_place_of_birth'] }}">

                                            @error('second_place_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="second_date_of_birth">Tempat Lahir</label>
                                            <input type="date" name="second_date_of_birth" id="second_date_of_birth" class="form-control @error('second_date_of_birth') is-invalid @enderror" value="{{ old('second_date_of_birth') ?? $logs['second_date_of_birth'] }}">

                                            @error('second_date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="second_address">Alamat</label>
                                            <input type="text" name="second_address" id="second_address" class="form-control @error('second_address') is-invalid @enderror" value="{{ old('second_address') ?? $logs['second_address'] }}">

                                            @error('second_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#content_of_letter" aria-expanded="false" aria-controls="content_of_letter">
                                <strong>
                                    Isi Surat
                                </strong>
                            </button>
                        </h2>
                        <div id="content_of_letter" class="accordion-collapse collapse" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div id="sections_list">
                                    @if (old("sections"))
                                        @foreach (old("sections") as $index => $item)
                                            <div class="mb-3" id="{{ sprintf('sections_%s', $index) }}">
                                                <label for="{{ sprintf('sections_%s_title', $index) }}">Pasal {{ $loop->iteration }}</label>

                                                <div class="d-flex gap-2 mb-3">
                                                    <div class="w-100">
                                                        <input type="text" name="{{ sprintf('sections[%s][title]', $index) }}" id="{{ sprintf('sections_%s_title', $index) }}" class="form-control fw-bold @error(sprintf('sections.%s.title', $index)) is-invalid @enderror" value="{{ $item['title'] }}" placeholder="Masukkan judul pasal..." required oninput="onInputSectionsTitle('{{ $index }}', this, 'title')">

                                                        @error(sprintf("sections.%s.title", $index))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <button type="button" class="btn btn-danger" id="{{ sprintf('button_remove_section_%s', $index) }}" onclick="removeSectionsData('{{ $index }}')"><i class="fa-solid fa-trash"></i></button>
                                                    </div>
                                                </div>

                                                <textarea name="{{ sprintf('sections[%s][content]', $index) }}" id="{{ sprintf('sections_%s_content', $index) }}" class="ckeditor form-control @error(sprintf('sections.%s.content', $index)) is-invalid @enderror" rows="3">{!! $logs["sections"][$index]["content"] !!}</textarea>

                                                @error(sprintf("sections.%s.content", $index))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        @endforeach

                                    @else
                                        @foreach ($logs["sections"] as $index => $item)
                                            <div class="mb-3" id="{{ sprintf('sections_%s', $index) }}">
                                                <label for="{{ sprintf('sections_%s_title', $index) }}">Pasal {{ $loop->iteration }}</label>

                                                <div class="d-flex gap-2 mb-3">
                                                    <input type="text" name="{{ sprintf('sections[%s][title]', $index) }}" id="{{ sprintf('sections_%s_title', $index) }}" class="form-control fw-bold" value="{{ $item['title'] }}" placeholder="Masukkan judul pasal..." required oninput="onInputSectionsTitle('{{ $index }}', this, 'title')">

                                                    <button type="button" class="btn btn-danger" id="{{ sprintf('button_remove_section_%s', $index) }}" onclick="removeSectionsData('{{ $index }}')"><i class="fa-solid fa-trash"></i></button>
                                                </div>

                                                <textarea name="{{ sprintf('sections[%s][content]', $index) }}" id="{{ sprintf('sections_%s_content', $index) }}" class="ckeditor form-control" rows="3">{!! $logs["sections"][$index]["content"] !!}</textarea>
                                            </div>
                                        @endforeach

                                    @endif
                                </div>

                                <button type="button" class="btn btn-white-2 w-100" id="button_add_sections_data" onclick="addSectionsData()">Tambah</button>
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

                                    @error('signed_place')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="signed_date">Tanggal</label>
                                    <input type="date" name="signed_date" id="signed_date" class="form-control @error('signed_date') is-invalid @enderror" value="{{ old('signed_date') ?? $logs['signed_date'] }}">

                                    @error('signed_date')
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
                        <h1 class="fw-bold text-dark text-8"><u>PERJANJIAN KERJA WAKTU TERTENTU (PKWT)</u></h1>
                        <p class="mt-n7">No. {{ $commonLog->number_of_letter ?? "[Nomor surat]" }}</p>
                    </div>

                    <div class="letter_body mt-4">
                        <p class="fw-bold">Yang bertanda tangan dibawah ini:</p>
                        <p><span class="me-1">1.</span>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="first_name_data">{{ old("first_name") ?? $logs["first_name"] ?? "[Nama pihak pertama]" }}</span></p>
                        <p class="ms-2">Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="first_position_data">{{ old("first_position") ?? $logs["first_position"] ?? "[Jabatan pihak pertama]" }}</span></p>
                        <p class="ms-2">Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="first_address_data">{{ old("first_address") ?? $logs["first_address"] ?? "[Alamat pihak pertama]" }}</span></p>

                        <p class="mt-2">
                            Dalam Perjanjian Kerja ini bertindak untuk dan atas nama Pengusaha/Perusahaan <span>{{ $user->name }}</span> yang beralamat di <span>{{ $user->street }}, Kota {{ $user->region->name }}, {{ $user->province->name }}</span>, dan selanjutnya disebut : <span class="fw-bold"><u>Pihak Pertama</u></span>
                        </p>

                        <p><span class="me-1">2.</span>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="second_name_data">{{ old("second_name") ?? $logs["second_name"] ?? "[Nama pihak kedua]" }}</span></p>
                        <p class="ms-2">Tempat, Tanggal lahir &nbsp;&nbsp;&nbsp;&nbsp;: <span id="second_place_of_birth_data">{{ old("second_place_of_birth") ?? $logs["second_place_of_birth"] ?? "[Tempat" }}</span>,
                            <span id="second_date_of_birth_data">
                                @if(old("second_date_of_birth"))
                                    {{ date("d", strtotime(old("second_date_of_birth"))) }}
                                    {{ config(sprintf("central.months.%s", date("F", strtotime(old("second_date_of_birth"))))) }}
                                    {{ date("Y", strtotime(old("second_date_of_birth"))) }}

                                @elseif ($logs["second_date_of_birth"])
                                    {{ date("d", strtotime($logs["second_date_of_birth"])) }}
                                    {{ config(sprintf("central.months.%s", date("F", strtotime($logs["second_date_of_birth"])))) }}
                                    {{ date("Y", strtotime($logs["second_date_of_birth"])) }}

                                @else
                                    {{ "Tanggal lahir]" }}
                                @endif
                            </span>
                        </p>
                        <p class="ms-2">Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="second_address_data">{{ old("second_address") ?? $logs["second_address"] ?? "[Alamat pihak kedua]" }}</span></p>

                        <p class="mt-2">
                            Dalam Perjanjian Kerja ini bertindak  untuk dan atas nama  sendiri, yang selanjutnya disebut : <span class="fw-bold"><u>Pihak Kedua</u></span>
                        </p>

                        <p class="mt-3">
                            Pada hari ini
                            <span id="signed_date_day_data">
                                @if(old("signed_date"))
                                    {{ config(sprintf("central.days.%s", date("l", strtotime(old("signed_date"))))) }}
                                @elseif ($logs["signed_date"])
                                    {{ config(sprintf("central.days.%s", date("l", strtotime($logs["signed_date"])))) }}
                                @else
                                    ………
                                @endif
                            </span>
                            tanggal
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
                                    ………
                                @endif
                            </span>
                            , bertempat di Perusahaan {{ $user->name }}, Pihak Pertama dan Pihak Kedua sepakat mengadakan Perjanjian Kerja dengan ketentuan-ketentuan seperti tertera dalam pasal berikut ini :
                        </p>

                        <div id="sections_data">
                            @if (old("sections"))
                                @foreach (old("sections") as $index => $item)
                                    <div id="{{ sprintf("sections_%s_data", $index) }}">
                                        <p class="mt-3 fw-bold text-center">Pasal {{ $loop->iteration }}</p>
                                        <p class="fw-bold text-center" id="{{ sprintf('sections_%s_title_data', $index) }}">{{ $item["title"] }}</p>
                                        <div id="{{ sprintf('sections_%s_content_data', $index) }}">
                                            {!! $item["content"] !!}
                                        </div>
                                    </div>
                                @endforeach

                            @else
                                @foreach ($logs["sections"] as $index => $item)
                                    <div id="{{ sprintf("sections_%s_data", $index) }}">
                                        <p class="mt-3 fw-bold text-center">Pasal {{ $loop->iteration }}</p>
                                        <p class="fw-bold text-center" id="{{ sprintf('sections_%s_title_data', $index) }}">{{ $item["title"] }}</p>
                                        <div id="{{ sprintf('sections_%s_content_data', $index) }}">
                                            {!! $item["content"] !!}
                                        </div>
                                    </div>
                                @endforeach

                            @endif
                        </div>
                    </div>

                    <div class="letter_footer mt-5">
                        <p class="text-end">
                            <span id="signed_place_data">{{ old("signed_place") ?? $logs["signed_place"] ?? "[Tempat" }}</span>,
                            <span id="signed_date_data_2">
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

                        <div class="d-flex gap-2 justify-content-between">
                            <div>
                                <p class="mb-5">Pihak Kedua</p>
                                <p id="second_name_data_2">{{ old("second_name") ?? $logs["second_name"] ?? "[Nama pihak kedua]" }}</p>
                            </div>

                            <div class="text-end">
                                <p class="mb-5">Pihak Pertama</p>
                                <p class="fw-bold"><u id="first_name_data_2">{{ old("signed_name") ?? $logs["signed_name"] ?? "[Nama pihak pertama]" }}</u></p>
                                <p id="first_position_data_2">{{ old("signed_position") ?? $logs["signed_position"] ?? "[Jabatan pihak pertama]" }}</p>
                            </div>
                        </div>


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
    <script src="{{ asset('assets/js/ckeditor/ckeditor-classic.js') }}"></script>
    <script src="{{ asset('assets/js/ckeditor/config.js') }}"></script>
    <script src="{{ asset('assets/js/buat_surat/pkwt_agreement.js') }}"></script>

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
