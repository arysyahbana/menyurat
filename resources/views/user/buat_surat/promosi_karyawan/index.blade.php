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
                                    <label for="employee_name">Nama Karyawan</label>
                                    <input type="text" name="employee_name" id="employee_name" class="form-control @error('employee_name') is-invalid @enderror" value="{{ old('employee_name') ?? $logs['employee_name'] }}">

                                    @error('employee_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="position">Jabatan (semula)</label>
                                    <input type="text" name="position" id="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position') ?? $logs['position'] }}">

                                    @error('position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="salary">Gaji Pokok (semula)</label>
                                    <input type="number" name="salary" id="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') ?? $logs['salary'] }}">

                                    @error('salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 d-flex gap-2 justify-content-between">
                                    <label class="align-self-center">Data tambahan (semula)</label>
                                    <button type="button" class="btn btn-primary" id="button_add_optional_data" onclick="addOptionalData()"><i class="fa-solid fa-plus"></i></button>
                                </div>

                                <div id="optionals_list">
                                    @if(old("optionals"))
                                        @foreach (old("optionals") as $index => $item)
                                            <div class="mb-3" id="{{ sprintf('optionals_%s', $index) }}">
                                                <div class="d-flex gap-2 mb-3">
                                                    <div class="w-100">
                                                        <input type="text" name="{{ sprintf('optionals[%s][key]', $index) }}" id="{{ sprintf('optionals_%s_key', $index) }}" class="form-control fw-bold @error(sprintf('optionals.%s.key', $index)) is-invalid @enderror" value="{{ $item['key'] }}" placeholder="Masukkan kata kunci..." required oninput="onInputOptionals('{{ $index }}', this, 'key')">

                                                        @error(sprintf("optionals.%s.key", $index))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <button type="button" class="btn btn-danger" id="{{ sprintf('button_remove_optionals_%s', $index) }}" onclick="removeOptionalsList('{{ $index }}')"><i class="fa-solid fa-trash"></i></button>
                                                    </div>
                                                </div>

                                                <input type="text" name="{{ sprintf('optionals[%s][value]', $index) }}" id="{{ sprintf('optionals_%s_value', $index) }}" class="form-control @error(sprintf("optionals.%s.value", $index)) is-invalid @enderror" value="{{ $item['value'] }}" placeholder="Masukkan Isi..." required oninput="onInputOptionals('{{ $index }}', this, 'value')">

                                                @error(sprintf("optionals.%s.value", $index))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        @endforeach

                                    @else
                                        @foreach ($logs["optionals"] as $index => $item)
                                            <div class="mb-3" id="{{ sprintf('optionals_%s', $index) }}">
                                                <div class="d-flex gap-2 mb-3">
                                                    <input type="text" name="{{ sprintf('optionals[%s][key]', $index) }}" id="{{ sprintf('optionals_%s_key', $index) }}" class="form-control fw-bold" value="{{ $item['key'] }}" placeholder="Masukkan kata kunci..." required oninput="onInputOptionals('{{ $index }}', this, 'key')">

                                                    <button type="button" class="btn btn-danger" id="{{ sprintf('button_remove_optionals_%s', $index) }}" onclick="removeOptionalsList('{{ $index }}')"><i class="fa-solid fa-trash"></i></button>
                                                </div>

                                                <input type="text" name="{{ sprintf('optionals[%s][value]', $index) }}" id="{{ sprintf('optionals_%s_value', $index) }}" class="form-control" value="{{ $item['value'] }}" placeholder="Masukkan Isi..." required oninput="onInputOptionals('{{ $index }}', this, 'value')">
                                            </div>
                                        @endforeach

                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="new_position">Jabatan Baru (menjadi)</label>
                                    <input type="text" name="new_position" id="new_position" class="form-control @error('new_position') is-invalid @enderror" value="{{ old('new_position') ?? $logs['new_position'] }}">

                                    @error('new_position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="new_salary">Gaji Pokok Baru (menjadi)</label>
                                    <input type="number" name="new_salary" id="new_salary" class="form-control @error('new_salary') is-invalid @enderror" value="{{ old('new_salary') ?? $logs['new_salary'] }}">

                                    @error('new_salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 d-flex gap-2 justify-content-between">
                                    <label class="align-self-center">Data tambahan (menjadi)</label>
                                    <button type="button" class="btn btn-primary" id="button_add_new_optional_data" onclick="addNewOptionalData()"><i class="fa-solid fa-plus"></i></button>
                                </div>

                                <div id="new_optionals_list">
                                    @if(old("new_optionals"))
                                        @foreach (old("new_optionals") as $index => $item)
                                            <div class="mb-3" id="{{ sprintf('new_optionals_%s', $index) }}">
                                                <div class="d-flex gap-2 mb-3">
                                                    <div class="w-100">
                                                        <input type="text" name="{{ sprintf('new_optionals[%s][key]', $index) }}" id="{{ sprintf('new_optionals_%s_key', $index) }}" class="form-control fw-bold @error(sprintf('new_optionals.%s.key', $index)) is-invalid @enderror" value="{{ $item['key'] }}" placeholder="Masukkan kata kunci..." required oninput="onInputNewOptionals('{{ $index }}', this, 'key')">

                                                        @error(sprintf("new_optionals.%s.key", $index))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <button type="button" class="btn btn-danger" id="{{ sprintf('button_remove_new_optionals_%s', $index) }}" onclick="removeNewOptionalsList('{{ $index }}')"><i class="fa-solid fa-trash"></i></button>
                                                    </div>
                                                </div>

                                                <input type="text" name="{{ sprintf('new_optionals[%s][value]', $index) }}" id="{{ sprintf('new_optionals_%s_value', $index) }}" class="form-control @error(sprintf("new_optionals.%s.value", $index)) is-invalid @enderror" value="{{ $item['value'] }}" placeholder="Masukkan Isi..." required oninput="onInputNewOptionals('{{ $index }}', this, 'value')">

                                                @error(sprintf("new_optionals.%s.value", $index))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        @endforeach

                                    @else
                                        @foreach ($logs["new_optionals"] as $index => $item)
                                            <div class="mb-3" id="{{ sprintf('new_optionals_%s', $index) }}">
                                                <div class="d-flex gap-2 mb-3">
                                                    <input type="text" name="{{ sprintf('new_optionals[%s][key]', $index) }}" id="{{ sprintf('new_optionals_%s_key', $index) }}" class="form-control fw-bold" value="{{ $item['key'] }}" placeholder="Masukkan kata kunci..." required oninput="onInputNewOptionals('{{ $index }}', this, 'key')">

                                                    <button type="button" class="btn btn-danger" id="{{ sprintf('button_remove_new_optionals_%s', $index) }}" onclick="removeNewOptionalsList('{{ $index }}')"><i class="fa-solid fa-trash"></i></button>
                                                </div>

                                                <input type="text" name="{{ sprintf('new_optionals[%s][value]', $index) }}" id="{{ sprintf('new_optionals_%s_value', $index) }}" class="form-control" value="{{ $item['value'] }}" placeholder="Masukkan Isi..." required oninput="onInputNewOptionals('{{ $index }}', this, 'value')">
                                            </div>
                                        @endforeach

                                    @endif
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
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label><strong>Menimbang</strong></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div id="considerings_list">
                                            @if (old("considerings"))
                                                @foreach (old("considerings") as $index => $item)
                                                    <div class="mb-3">
                                                        <label for="{{ sprintf('considerings_%s', $index) }}">Poin {{ $loop->iteration }}</label>
                                                        <textarea name="considerings[]" id="{{ sprintf('considerings_%s', $index) }}" class="form-control" rows="3" required oninput="onInputConsiderings('{{ $index }}', this)">{{ $item }}</textarea>
                                                    </div>
                                                @endforeach

                                            @else
                                                @foreach ($logs["considerings"] as $index => $item)
                                                    <div class="mb-3">
                                                        <label for="{{ sprintf('considerings_%s', $index) }}">Poin {{ $loop->iteration }}</label>
                                                        <textarea name="considerings[]" id="{{ sprintf('considerings_%s', $index) }}" class="form-control" rows="3" required oninput="onInputConsiderings('{{ $index }}', this)">{{ $item }}</textarea>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-white-2 w-100" id="button_add_considerings_data" onclick="addConsiderings()">Tambah</button>
                                            <button type="button" class="btn btn-danger @if((old('considerings') && count(old('considerings')) <= 1) || count($logs['considerings']) <= 1) d-none @endif" id="button_remove_considerings_data" onclick="removeConsiderings()">Hapus</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label><strong>Mengingatkan</strong></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div id="rememberings_list">
                                            @if (old("rememberings"))
                                                @foreach (old("rememberings") as $index => $item)
                                                    <div class="mb-3">
                                                        <label for="{{ sprintf('rememberings_%s', $index) }}">Poin {{ $loop->iteration }}</label>
                                                        <textarea name="rememberings[]" id="{{ sprintf('rememberings_%s', $index) }}" class="form-control" rows="3" required oninput="onInputRememberings('{{ $index }}', this)">{{ $item }}</textarea>
                                                    </div>
                                                @endforeach

                                            @else
                                                @foreach ($logs["rememberings"] as $index => $item)
                                                    <div class="mb-3">
                                                        <label for="{{ sprintf('rememberings_%s', $index) }}">Poin {{ $loop->iteration }}</label>
                                                        <textarea name="rememberings[]" id="{{ sprintf('rememberings_%s', $index) }}" class="form-control" rows="3" required oninput="onInputRememberings('{{ $index }}', this)">{{ $item }}</textarea>
                                                    </div>
                                                @endforeach

                                            @endif
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-white-2 w-100" id="button_add_rememberings_data" onclick="addRememberings()">Tambah</button>
                                            <button type="button" class="btn btn-danger @if((old('rememberings') && count(old('rememberings')) <= 1) || count($logs['rememberings']) <= 1) d-none @endif" id="button_remove_rememberings_data" onclick="removeRememberings()">Hapus</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label><strong>Memutuskan</strong></label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <label for="decidings_first">Pertama</label>
                                            <textarea name="decidings[first]" id="decidings_first" class="form-control @error('decidings.first') is-invalid @enderror" rows="3">{{ old('decidings.first') ?? $logs["decidings"]["first"] }}</textarea>

                                            @error('decidings.first')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="decidings_second">Kedua</label>
                                            <textarea name="decidings[second]" id="decidings_second" class="form-control @error('decidings.second') is-invalid @enderror" rows="3">{{ old('decidings.second') ?? $logs["decidings"]["second"] }}</textarea>

                                            @error('decidings.second')
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
                    <div class="letter_header text-center">
                        <h1 class="fw-bold text-dark text-8"><u>SURAT KEPUTUSAN</u></h1>
                        <p class="mt-n7">No. {{ $commonLog->number_of_letter ?? "[Nomor surat]" }}</p>
                        <p>Tentang:</p>
                        <p class="fw-bold text-8">PROMOSI JABATAN KARYAWAN</p>
                    </div>

                    <div class="letter_body mt-4">
                        <h2 class="text-dark text-8"><u>Menimbang:</u></h2>
                        <div>
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

                        <h2 class="text-dark text-8"><u>Mengingat:</u></h2>
                        <div>
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

                        <h2 class="text-dark text-8"><u>Memutuskan:</u></h2>
                        <div id="decidings_data">
                            <div class="ms-4 mt-n5">
                                <h3 class="fw-bold text-8"><u>Pertama:</u></h3>
                                <p class="mt-n5" id="decidings_first_data">{{ old("decidings.first") ?? $logs["decidings"]["first"] }}</p>

                                <p class="mt-2">
                                    Nama yang bersangkutan :
                                    <span id="employee_name_data">{{ old("employee_name") ?? $logs["employee_name"] ?? "[Nama yang bersangkutan]" }}</span>
                                </p>

                                <div class="ms-3 row">
                                    <div class="col-md-2 text-6">
                                        <span>a. Semula &nbsp;&nbsp;&nbsp;:</span>
                                    </div>
                                    <div class="col">
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
                                    </div>
                                </div>

                                <div class="ms-3 row">
                                    <div class="col-md-2 text-6">
                                        <span>b. Menjadi &nbsp;&nbsp;:</span>
                                    </div>
                                    <div class="col">
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
                                    </div>
                                </div>

                                <h3 class="fw-bold text-8"><u>Kedua:</u></h3>
                                <p class="mt-n5" id="decidings_second_data">{{ old("decidings.second") ?? $logs["decidings"]["second"] }}</p>
                            </div>
                        </div>
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
                                    {{ "tanggal, bulan, tahun]" }}
                                @endif
                            </span>
                        </p>
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
    <script src="{{ asset('assets/js/buat_surat/promosi.js') }}"></script>

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
