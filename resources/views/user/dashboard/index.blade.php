@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/style_dashboard.css') }}">
    <div class="content px-5 py-3 ">
        <p class="fw-bold mb-2" style="font-size: 20px;">Hai, Edu labs !</p>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="my-auto">Selamat Datang di Menyurat by Metro Software</h2>
            <div class="btn-container">
                <div class="slide-buttons">
                    <button id="scrollLeftButton" class="slide-button btn btn-primary"><i
                            class="fa fa-chevron-left"></i></button>
                    <button id="scrollRightButton" class="slide-button btn btn-primary "><i
                            class="fa fa-chevron-right"></i></button>
                </div>
            </div>
        </div>


        <div class="scrolling-wrapper mt-5">
            <button data-bs-toggle="modal" data-bs-target="#createBlankModal" class="pembungkus border-0 bg-transparent">
                <div class="card" style="width: 150px; height:180px">
                    <img src="/assets/img/putih.jpg" alt="Avatar" class="image" style=" width: 100%; height: 100%;">
                    <div class="middle">
                        <div class="text"><i class="fa-solid fa-plus"></i></div>
                    </div>
                </div>
                <p class="mt-1 text-wrap m-auto">Tambah Surat</p>
            </button>

            @foreach ($letters as $name => $value)
                <button type="button" class="pembungkus border-0 bg-transparent" onclick="createSelectedLetter('{{ Str::slug($name) }}')" data-bs-toggle="modal" data-bs-target="#createSelectedModal">
                    <div class="card " style="width: 150px; height:180px">
                        <img src="{{ asset($value["image"]) }}" alt="Avatar" class="image" style=" width: 100%; height: 100%;">
                        <div class="middle">
                            <div class="text"><i class="fa-solid fa-plus"></i></div>
                        </div>
                    </div>
                    <p class="mt-1 text-wrap m-auto">{{ $name }}</p>
                </button>
            @endforeach
        </div>

        <div class="d-flex justify-content-between mt-5">
            <h2 class="my-auto">Recently</h2>
            <form action="{{ route('dashboard') }}" method="get" class="d-inline-block">
                <div class="d-flex gap-2">
                    <div class="form-group">
                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input class="form-field" name="search" value="{{ Request::input("search") }}" type="text"
                            placeholder="Cari">
                    </div>

                    @if (Request::input('published') !== null)
                        <input type="text" name="published" id="hidden-published" class="d-none" value="{{ Request::input('published') }}">
                    @endif

                    <button type="submit" class="btn btn-primary text-center my-auto px-3">Cari</button>
                </div>
            </form>
        </div>

        <div class="d-flex gap-4 mt-3 filter-table-dashboard">
            <a href="{{ route('dashboard', ['search' => Request::input("search")]) }}"
                class="border-bottom p-1 border-2 @if (Request::input("published") === null) filter-active-table @endif">
                    <small><i class="fa-solid fa-file me-1"></i>Semua Surat</small>
            </a>

            <a href="{{ route('dashboard', ['published' => 0, 'search' => Request::input("search")]) }}"
                class="border-bottom p-1 border-2 @if (Request::input("published") !== null && Request::input("published") == 0) filter-active-table @endif">
                    <small><i class="fa-regular fa-clock me-1"></i>Belum Diterbitkan</small>
            </a>

            <a href="{{ route('dashboard', ['published' => 1, 'search' => Request::input("search")]) }}"
                class="border-bottom p-1 border-2 @if (Request::input("published") !== null && Request::input("published") == 1) filter-active-table @endif">
                    <small><i class="fa-solid fa-check me-1"></i>Sudah Diterbitkan</small
            ></a>
        </div>
        <div class="table-responsive mt-2">
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Judul Surat</th>
                        <th>Jenis</th>
                        <th>No. Surat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-white">
                    @foreach ($commonLogs as $commonLog)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date_format($commonLog->updated_at, "d-m-Y H:m") }}</td>
                            <td>{{ $commonLog->title }}</td>
                            <td>{{ $commonLog->type }}</td>
                            <td>{{ $commonLog->number_of_letter ?? "-" }}</td>
                            <td>
                                @if ($commonLog->number_of_letter)
                                    <small class="bg-success-2 px-2 py-1 rounded">Sudah Diterbitkan</small>
                                @else
                                    <small class="bg-warning-2 px-2 py-1 rounded">Belum Diterbitkan</small>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown dropstart">
                                    <button type="button" class="btn border-0 " data-bs-toggle="dropdown"
                                        aria-expanded="false" aria-haspopup="true">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if ($commonLog->number_of_letter)
                                            <li>
                                                <form action="{{ route('letter.common.download', ['commonLetterLog' => $commonLog->id]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-black btn">
                                                        <i class="fa-solid fa-download me-2"></i>Download
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('letter.common.preview', ['commonLetterLog' => $commonLog->id]) }}" method="post" target="_blank">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-black btn">
                                                        <i class="fa-regular fa-eye me-2"></i>Lihat
                                                    </button>
                                                </form>
                                            </li>
                                        @else
                                            <li>
                                                <a class="dropdown-item text-warning"
                                                    href="{{ route('letter.log.create', ['commonLetterLog' => $commonLog->id]) }}">
                                                    <i class="fa-regular fa-pen-to-square me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('letter.common.destroy', ['commonLetterLog' => $commonLog->id]) }}" method="post" onsubmit="return confirmDelete(this)">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="dropdown-item text-danger btn">
                                                        <i class="fa-solid fa-trash me-2"></i>Hapus
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item text-primer" data-bs-toggle="modal" data-bs-target="#updateNumberOfLetter" onclick="updateNumberOfLetter('{{ $commonLog->id }}')">
                                                    <i class="fa-solid fa-file-import me-2"></i>Terbitkan
                                                </button>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if (count($commonLogs) === 0)
                        <tr>
                            <td colspan="7" class="text-center fw-bold">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Create Blank Surat -->
    <div class="modal fade" id="createBlankModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen ">
            <div class="modal-content" style="background-color: white">
                <div class="modal-header">
                    <div class="mx-5">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Buat Surat</h1>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mx-5">
                        <div class="row">
                            <div class="col-lg-8 border-end ">
                                <div class="row border-bottom pb-2">
                                    <h2>Semua Template</h2>
                                </div>
                                <div class="row pt-4 ">
                                    @foreach ($letters as $name => $value)
                                        <div class="col-lg-3 mb-4">
                                            <div class="card card-border selector-image" id="{{ Str::slug($name) }}" onclick="createBlankLetter('{{ Str::slug($name) }}')" style="width: 170px; height:240px;">
                                                <img src="{{ asset($value["image"]) }}" alt="Avatar" class=""
                                                    style="width: 100%; height: 100%;">
                                                <p class="text-center mt-3">{{ $name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-4 ">
                                <div class="d-flex flex-column ms-2 mt-3 " style="position: fixed;width: 400px">
                                    <form action="{{ route('letter.common.store') }}" method="post" id="create-blank-letter">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="title" class="mb-1"><strong>Judul Surat<sup class="text-danger fs-6">*</sup></strong></label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                placeholder="Judul surat..." required>
                                        </div>
                                        <div class="mb-3 d-none">
                                            <input type="text" name="type" id="type" class="form-control d-none">
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3 w-100">Buat Surat</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div> --}}
            </div>
        </div>
    </div>

    <!-- Modal Create Selected Surat -->
    <div class="modal fade mt-5" id="createSelectedModal" tabindex="-1" aria-labelledby="createSelectedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-body my-4 mx-3">
                <form action="{{ route('letter.common.store') }}" method="post" id="create-selected-letter">
                    @csrf
                    <div class="text-center mb-4">
                        <label for="name" class="mb-3">
                            <h2 class="modal-title fs-5" id="staticBackdropLabel">Masukan Judul Surat</h2>
                        </label>
                        <input type="text" name="title" class="form-control" id="title"
                            placeholder="Judul surat..." required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Buat Surat</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Nomor Surat -->
    <div class="modal fade mt-5" id="updateNumberOfLetter" tabindex="-1" aria-labelledby="updateNumberOfLetterLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-body my-4 mx-3">
                <form action="{{ route('letter.common.update', ['commonLetterLog' => 0]) }}" method="post"
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
                        <button type="submit" class="btn btn-primary">Terbitkan Surat</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/modal_letter.js') }}"></script>
    <script src="{{ asset('assets/js/user_dashboard.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script>
        // var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        // var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        //     return new bootstrap.Popover(popoverTriggerEl)
        // })
    </script>
@endsection
