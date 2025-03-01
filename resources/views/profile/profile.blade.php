@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/style_profil_perusahaan.css') }}">

    <div class="content px-5 py-3 mb-3 bg-white">
        <h2 class="fw-bold mb-3 mt-1" style="font-size: 20px;"><Strong>Profil Perusahaan</Strong></h2>
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf

            {{-- <div class="d-flex flex-column">
                <p class="mb-1"><Strong>Logo Perusahaan<sup class="text-danger fs-6">*</sup></Strong></p>
                <div class="image-container rounded">
                    @if ($user->logo_url)
                        <img src="{{ asset('storage/' . $user->logo_url) }}" class="img-preview rounded"
                            style="width: 215px;height:215px;margin:0;object-fit: cover" alt="Logo perusahaan">
                        <input type="file" name="logo" id="logo" accept="image/*"
                            value="{{ old('logo') ?? $user->logo_url }}"
                            class="form-control @error('logo') is-invalid @enderror" onchange="previewImage()">
                    @else
                        <img src="{{ asset('assets/img/profil2.png') }}" class="img-preview rounded"
                            style="width: 215px;height:215px;margin:0;object-fit: cover" alt="Logo perusahaan">
                        <input type="file" name="logo" id="logo" accept="image/*"
                            value="{{ old('logo') ?? $user->logo_url }}"
                            class="form-control @error('logo') is-invalid @enderror" onchange="previewImage()">
                    @endif
                </div>

                @error('logo')
                    <span class="text-danger fs-6 fw-normal" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div> --}}

            <div class="d-flex flex-column">
                <p class="mb-1"><Strong>Logo Perusahaan<sup class="text-danger fs-6">*</sup></Strong></p>

                <div class="image-container rounded">
                    @if ($user->logo_url)
                        <img src="{{ asset('storage/' . $user->logo_url) }}" class="img-preview rounded"
                            style="width: 215px;height:215px;margin:0;object-fit: cover" alt="Logo perusahaan">
                    @else
                        <img src="{{ asset('assets/img/profil2.png') }}" class="img-preview rounded"
                            style="width: 215px;height:215px;margin:0;object-fit: cover" alt="Logo perusahaan">
                    @endif

                </div>

                <div style="width: 215px">
                    <!-- Tombol untuk membuka modal -->
                    <button type="button" class="btn btn-primary mt-2 form-control" data-bs-toggle="modal" data-bs-target="#cropperModal">
                        Pilih & Edit Logo
                    </button>

                    <!-- Input hidden untuk menyimpan data cropped image -->
                    <input type="hidden" name="logo" id="logo-data">
                </div>

                @error('logo')
                    <span class="text-danger fs-6 fw-normal" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mt-4 mb-3">
                <div class="col-md-6">
                    <label for="name" class="mb-1">
                        <strong>Nama Perusahaan<sup class="text-danger fs-6">*</sup></strong>
                    </label>
                    <input type="text" name="name" value="{{ old('name') ?? $user->name }}"
                        class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Nama Perusahaan..." required>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="street" class="mb-1">
                        <strong>Nama jalan<sup class="text-danger fs-6">*</sup></strong>
                    </label>
                    <input type="text" name="street" value="{{ old('street') ?? $user->street }}"
                        class="form-control @error('street') is-invalid @enderror" id="street"
                        placeholder="Alamat Perusahaan..." required>

                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="mb-1">
                        <strong>Email<sup class="text-danger fs-6">*</sup></strong>
                    </label>
                    <input type="email" name="email" value="{{ old('email') ?? $user->email }}"
                        class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email..."
                        required>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="province" class="mb-1">
                        <strong>Provinsi<sup class="text-danger fs-6">*</sup></strong>
                    </label>
                    <input type="text" id="default-province" value="{{ old('province_id') ?? $user->province_id }}" class="d-none">

                    <select class="form-select @error('province_id') is-invalid @enderror" aria-label="Default select example"
                        onchange="changeProvince()" id="province" name="province_id">
                        <option value="" hidden>Provinsi...</option>

                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">
                                {{ ucwords($province->name) }}
                            </option>
                        @endforeach
                    </select>

                    @error('province_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="phone_number" class="mb-1">
                        <strong>Nomor Telepon <span style="font-size: 10pt; font-weight: normal">(Format : 08xx)</span><sup class="text-danger fs-6 ps-1">*</sup></strong>
                    </label>
                    <input type="tel" name="phone_number" value="{{ old('phone_number') ?? $user->phone_number }}"
                        class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                        placeholder="Nomor telpon (08xx)..." required>

                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="region" class="mb-1">
                        <strong>Kota/Kabupaten<sup class="text-danger fs-6">*</sup></strong>
                    </label>
                    <input type="text" id="default-region" value="{{ old('region_id') ?? $user->region_id }}" class="d-none">

                    <select class="form-select @error('region_id') is-invalid @enderror" aria-label="Default select example"
                        id="region" name="region_id" onchange="changeRegion()" disabled>
                        <option value="" hidden>Kota/Kabupaten...</option>
                    </select>

                    @error('region_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="web_url" class="mb-1"><strong>Website <span style="font-size: 10pt; font-weight: normal">(Format : https://xxxxxxx)</span></strong></label>
                    <input type="text" name="web_url" value="{{ old('web_url') ?? $user->web_url }}"
                        class="form-control @error('web_url') is-invalid @enderror" id="web_url" placeholder="Website...">

                    @error('web_url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="district" class="mb-1">
                        <strong>Kecamatan<sup class="text-danger fs-6">*</sup></strong>
                    </label>
                    <input type="text" id="default-district" value="{{ old('district_id') ?? $user->district_id }}" class="d-none">

                    <select class="form-select @error('district_id') is-invalid @enderror" aria-label="Default select example" id="district" name="district_id" onchange="changeDistrict()" disabled>
                        <option value="" hidden>Kecamatan...</option>
                    </select>

                    @error('district_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3 justify-content-md-end">
                <div class="col-md-6">
                    <label for="urban_village" class="mb-1">
                        <strong>Kelurahan<sup class="text-danger fs-6">*</sup></strong>
                    </label>
                    <input type="text" id="default-urban-village" value="{{ old('urban_village_id') ?? $user->urban_village_id }}" class="d-none">

                    <select class="form-select @error('urban_village_id') is-invalid @enderror"
                        aria-label="Default select example" id="urban_village" name="urban_village_id" disabled>
                        <option value="" hidden>Kelurahan</option>
                    </select>

                    @error('urban_village_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

        <div class="row bg-primer p-3 rounded mt-5">
            <h1 class="text-white">Ubah Password</h1>

            <form action="{{ route('password.change') }}" method="post">
                @method('put')
                @csrf
                <div class="row mt-3">

                    <div class="col-md-6 mb-2 ">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="current_password" class="mb-1 text-white"><strong>Password</strong></label>
                                    <input type="password" name="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror" id="current_password"
                                        placeholder="Password lama..." autocomplete="off">

                                    @error('current_password')
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="col-12 mb-2">
                                <label for="new_password" class="mb-1 text-white"><strong>Password Baru</strong></label>
                                <input type="password" name="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror" id="new_password"
                                    placeholder="Password baru..." autocomplete="off">

                                @error('new_password')
                                    <span class="invalid-feedback text-dark" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-2">
                                <label for="new_password_confirmation" class="mb-1 text-white"><strong>Konfirmasi
                                        Password</strong></label>
                                <input type="password" name="new_password_confirmation"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                    id="new_password_confirmation" placeholder="Konfirmasi password baru..." autocomplete="off">

                                @error('new_password_confirmation')
                                    <span class="invalid-feedback text-dark" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-2 ">
                        <label class="mb-1 text-white"><strong>Ketentuan Password Baru</strong></label>
                        <div class="p-3 bg-light text-dark rounded">
                            <p class="mb-1"><strong>Harus mengandung:</strong></p>
                            <p class="mb-0">&bull; Minimal 8 karakter</p>
                            <p class="mb-0">&bull; Minimal 1 huruf besar (A-Z)</p>
                            <p class="mb-0">&bull; Minimal 1 huruf kecil (a-z)</p>
                            <p class="mb-0">&bull; Minimal 1 angka (0-9)</p>
                            <p class="mb-0">&bull; Minimal 1 simbol (!@#$%^&*)</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start mt-2">
                    <button type="submit" class="btn btn-white">Ubah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal untuk Cropper -->
    <div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="cropperModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropperModalLabel">Crop & Resize Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="img-container">
                                <img id="image-to-crop" src="{{ asset('assets/img/profil2.png') }}" alt="Gambar untuk di-crop">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="preview-container">
                                <div class="preview" style="width: 215px; height: 215px; overflow: hidden;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <input type="file" name="logo-input" id="logo-input" accept="image/*" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="crop-button">Crop & Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
    <script>
        function previewImage() {
            const image = document.querySelector('#logo');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFRevent) {
                imgPreview.src = oFRevent.target.result;
            }
        }
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault()
        });
    </script>

    <script>
        // Complete JavaScript for image cropping functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const imageElement = document.getElementById('image-to-crop');
            const inputElement = document.getElementById('logo-input');
            const cropButton = document.getElementById('crop-button');
            const cropperModal = document.getElementById('cropperModal');
            const previewImg = document.querySelector('.img-preview');
            const logoDataInput = document.getElementById('logo-data');

            let cropper = null;

            // Initialize Cropper when modal is shown
            cropperModal.addEventListener('shown.bs.modal', function() {
                cropper = new Cropper(imageElement, {
                    aspectRatio: 1, // 1:1 ratio for logo
                    viewMode: 1, // Restrict the crop box to not exceed the size of the canvas
                    preview: '.preview', // Add preview element
                    zoomable: true,
                    scalable: true,
                    rotatable: true,
                    minCropBoxWidth: 100,
                    minCropBoxHeight: 100,
                    responsive: true,
                    checkOrientation: true, // Check if the image is rotated and correct it
                });
            });

            // Destroy Cropper when modal is hidden to prevent memory leaks
            cropperModal.addEventListener('hidden.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
            });

            // Change image source when file input changes
            inputElement.addEventListener('change', function(e) {
                const files = e.target.files;
                if (!files || !files.length) return;

                const file = files[0];

                // Validate file is an image
                if (!/^image\/\w+/.test(file.type)) {
                    alert('File harus berupa gambar!');
                    return;
                }

                // Read file as data URL
                const reader = new FileReader();
                reader.onload = function() {
                    // Set image source
                    imageElement.src = reader.result;

                    // Destroy existing cropper if any
                    if (cropper) {
                        cropper.destroy();
                    }

                    // Initialize new cropper
                    cropper = new Cropper(imageElement, {
                        aspectRatio: 1,
                        viewMode: 1,
                        preview: '.preview',
                        zoomable: true,
                        scalable: true,
                        rotatable: true,
                        minCropBoxWidth: 100,
                        minCropBoxHeight: 100,
                        responsive: true,
                    });
                };
                reader.readAsDataURL(file);
            });

            // Handle crop button click
            cropButton.addEventListener('click', function() {
                if (!cropper) {
                    console.error('Cropper not initialized');
                    return;
                }

                // Generate cropped canvas
                const canvas = cropper.getCroppedCanvas({
                    width: 215, // Set desired width
                    height: 215, // Set desired height
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high'
                });

                if (!canvas) {
                    console.error('Could not create canvas from cropper');
                    return;
                }

                // Convert canvas to data URL
                const dataURL = canvas.toDataURL('image/png');

                // Update preview image
                previewImg.src = dataURL;

                // Set hidden input value for form submission
                logoDataInput.value = dataURL;

                if (typeof bootstrap !== 'undefined') {
                    const bsModal = bootstrap.Modal.getInstance(cropperModal);
                    if (bsModal) {
                        bsModal.hide();
                    } else {
                        $(cropperModal).modal('hide');
                    }
                } else {
                    console.error('Bootstrap is not defined');
                    $(cropperModal).modal('hide'); // Fallback jika Bootstrap tidak terdeteksi
                }
            });

            // Optional: Pre-load existing image if available
            if (previewImg && previewImg.src && !previewImg.src.includes('profil2.png')) {
                // If we have an existing image that's not the default
                imageElement.src = previewImg.src;
            }
        });
    </script>
@endsection
