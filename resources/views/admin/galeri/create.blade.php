@extends('admin.layouts.app')

@section('title', 'Tambah Galeri')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-0 fw-bold">
            Tambah Galeri Foto
        </h2>

        <p class="text-muted">
            Upload foto dan dokumentasi terbaru sekolah
        </p>
    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <form action="{{ route('admin.galeri.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row">

                {{-- LEFT --}}
                <div class="col-md-8">

                    {{-- JUDUL --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Judul Galeri
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul') }}"
                               placeholder="Masukkan judul galeri"
                               required>

                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  rows="10"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Tulis deskripsi galeri...">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-md-4">

                    {{-- GAMBAR --}}
                    <div class="card mb-3 border-0 shadow-sm">

                        <div class="card-header bg-light">

                            <i class="fas fa-image me-2"></i>
                            Foto Galeri

                        </div>

                        <div class="card-body">

                            <div class="text-center mb-3">

                                <div id="imagePreview"
                                     class="border rounded p-3 bg-light">

                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>

                                    <p class="text-muted small mt-2">
                                        Belum ada gambar
                                    </p>

                                </div>

                            </div>

                            <input type="file"
                                   name="gambar"
                                   id="gambar"
                                   class="form-control @error('gambar') is-invalid @enderror"
                                   accept="image/*"
                                   required>

                            <div class="form-text mt-2">

                                <small>

                                    <i class="fas fa-info-circle"></i>

                                    Format: JPG, PNG, JPEG<br>
                                    Rekomendasi ukuran: 800x500px

                                </small>

                            </div>

                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- TIPS --}}
                    <div class="alert alert-info border-0 shadow-sm">

                        <i class="fas fa-lightbulb me-2"></i>

                        <strong>Tips:</strong>

                        <ul class="mb-0 mt-2 small">

                            <li>Gunakan foto berkualitas baik</li>

                            <li>Tambahkan deskripsi singkat</li>

                            <li>Pastikan gambar relevan</li>

                        </ul>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-3 mt-3">
                <a href="{{ route('admin.galeri.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
                <button class="btn btn-success px-4">
                    <i class="fas fa-save me-2"></i>
                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>

@push('scripts')

<script>

document.getElementById('gambar')
.addEventListener('change', function(e)
{
    const file = e.target.files[0];

    if(file)
    {
        const reader = new FileReader();

        reader.onload = function(e)
        {
            document.getElementById('imagePreview').innerHTML =
            `
                <img src="${e.target.result}"
                     class="img-fluid rounded"
                     style="max-height:220px;">
            `;
        }

        reader.readAsDataURL(file);
    }
});

</script>

@endpush

@endsection