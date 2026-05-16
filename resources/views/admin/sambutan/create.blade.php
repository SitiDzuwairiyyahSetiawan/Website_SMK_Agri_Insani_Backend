@extends('admin.layouts.app')

@section('title', 'Tambah Sambutan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Tambah Sambutan</h2>
        <p class="text-muted">Tambahkan sambutan kepala sekolah</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.sambutan.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row">

                <div class="col-md-8">

                    <!-- Nama Kepala Sekolah -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Nama Kepala Sekolah <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="nama_kepala_sekolah"
                               class="form-control @error('nama_kepala_sekolah') is-invalid @enderror"
                               value="{{ old('nama_kepala_sekolah') }}"
                               placeholder="Masukkan nama kepala sekolah">

                        @error('nama_kepala_sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Jabatan
                        </label>

                        <input type="text"
                               name="jabatan"
                               class="form-control @error('jabatan') is-invalid @enderror"
                               value="{{ old('jabatan', 'Kepala Sekolah') }}"
                               placeholder="Masukkan jabatan">

                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pesan Sambutan -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Pesan Sambutan <span class="text-danger">*</span>
                        </label>

                        <textarea name="pesan"
                                  rows="12"
                                  class="form-control @error('pesan') is-invalid @enderror"
                                  placeholder="Tulis pesan sambutan disini...">{{ old('pesan') }}</textarea>

                        @error('pesan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="col-md-4">

                    <!-- Foto -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <i class="fas fa-image"></i> Foto Kepala Sekolah
                        </div>

                        <div class="card-body">

                            <div class="text-center mb-3">
                                <div id="imagePreview" class="border rounded p-3 bg-light">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                                    <p class="text-muted small mt-2">Belum ada foto</p>
                                </div>
                            </div>

                            <input type="file"
                                   name="foto"
                                   id="foto"
                                   class="form-control @error('foto') is-invalid @enderror"
                                   accept="image/*">

                            <div class="form-text mt-2">
                                <small>
                                    <i class="fas fa-info-circle"></i>
                                    Format: JPG, PNG, JPEG (Max 2MB)<br>
                                    Ukuran rekomendasi: 500x500px
                                </small>
                            </div>

                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>

                    <!-- Informasi -->
                    <div class="alert alert-info">
                        <i class="fas fa-lightbulb"></i>
                        <strong>Tips:</strong>

                        <ul class="mb-0 mt-2 small">
                            <li>Gunakan bahasa formal dan mudah dipahami</li>
                            <li>Pesan sambutan sebaiknya singkat namun bermakna</li>
                            <li>Tambahkan foto kepala sekolah yang jelas</li>
                        </ul>
                    </div>

                </div>

            </div>

            <div class="border-top pt-3 mt-3">

                <a href="{{ route('admin.sambutan.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

                <button class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    Simpan
                </button>

            </div>

        </form>

    </div>
</div>

@push('scripts')
<script>

    // Preview Foto
    document.getElementById('foto').addEventListener('change', function(e) {

        const file = e.target.files[0];

        if (file) {

            const reader = new FileReader();

            reader.onload = function(e) {

                const preview = document.getElementById('imagePreview');

                preview.innerHTML = `
                    <img src="${e.target.result}"
                         class="img-fluid rounded"
                         style="max-height: 200px;">
                `;
            }

            reader.readAsDataURL(file);

        } else {

            document.getElementById('imagePreview').innerHTML = `
                <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                <p class="text-muted small mt-2">Belum ada foto</p>
            `;
        }
    });

</script>
@endpush
@endsection