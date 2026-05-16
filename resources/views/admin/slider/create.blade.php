@extends('admin.layouts.app')

@section('title', 'Tambah Slider')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-0 fw-bold">
            Tambah Slider
        </h2>

        <p class="text-muted">
            Tambahkan slider baru untuk homepage website
        </p>

    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <form action="{{ route('admin.slider.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row">

                {{-- LEFT --}}
                <div class="col-md-8">

                    {{-- TITLE --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Title Slider
                        </label>

                        <input type="text"
                               name="title"
                               class="form-control"
                               value="{{ old('title') }}"
                               placeholder="Masukkan title slider">

                    </div>

                    {{-- TAG --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Tag
                        </label>

                        <input type="text"
                               name="tag"
                               class="form-control"
                               value="{{ old('tag') }}"
                               placeholder="Contoh: Welcome, SMK, Education">

                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Description
                        </label>

                        <textarea name="description"
                                  rows="8"
                                  class="form-control"
                                  placeholder="Tulis deskripsi slider...">{{ old('description') }}</textarea>

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-md-4">

                    {{-- IMAGE --}}
                    <div class="card border-0 shadow-sm mb-3">

                        <div class="card-header bg-light">

                            <i class="fas fa-image me-2"></i>
                            Gambar Slider

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
                                   name="image"
                                   id="image"
                                   class="form-control"
                                   accept="image/*">

                            <div class="form-text mt-2">

                                <small>

                                    <i class="fas fa-info-circle"></i>

                                    Ukuran rekomendasi:
                                    1920x800px

                                </small>

                            </div>

                        </div>

                    </div>

                    {{-- SETTING --}}
                    <div class="card border-0 shadow-sm mb-3">

                        <div class="card-header bg-light">

                            <i class="fas fa-cog me-2"></i>
                            Pengaturan Slider

                        </div>

                        <div class="card-body">

                            {{-- ORDER --}}
                            <div class="mb-3">

                                <label class="form-label fw-bold">
                                    Order
                                </label>

                                <input type="number"
                                       name="order"
                                       class="form-control"
                                       value="{{ old('order', 0) }}">

                            </div>

                            {{-- STATUS --}}
                            <div class="form-check">

                                <input type="checkbox"
                                       name="is_active"
                                       class="form-check-input"
                                       checked>

                                <label class="form-check-label">

                                    <i class="fas fa-check-circle text-success me-1"></i>

                                    Active

                                </label>

                            </div>

                        </div>

                    </div>

                    {{-- INFO --}}
                    <div class="alert alert-info border-0 shadow-sm">

                        <i class="fas fa-lightbulb me-2"></i>

                        <strong>Tips:</strong>

                        <ul class="mb-0 mt-2 small">

                            <li>Gunakan gambar landscape</li>

                            <li>Buat title singkat dan menarik</li>

                            <li>Pastikan slider mudah dibaca</li>

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
                <button class="btn btn-primary px-4">

                    <i class="fas fa-save me-2"></i>
                    Simpan 

                </button>

            </div>

        </form>

    </div>

</div>

@push('scripts')

<script>

document.getElementById('image')
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