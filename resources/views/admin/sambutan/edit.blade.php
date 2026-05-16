@extends('admin.layouts.app')

@section('title', 'Edit Sambutan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Edit Sambutan</h2>
        <p class="text-muted">Perbarui sambutan kepala sekolah</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.sambutan.update', $sambutan->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

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
                               value="{{ old('nama_kepala_sekolah', $sambutan->nama_kepala_sekolah) }}"
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
                               value="{{ old('jabatan', $sambutan->jabatan) }}"
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
                                  placeholder="Tulis pesan sambutan disini...">{{ old('pesan', $sambutan->pesan) }}</textarea>

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

                                    @if($sambutan->foto)
                                        <img src="{{ asset('storage/' . $sambutan->foto) }}"
                                             class="img-fluid rounded"
                                             style="max-height: 200px;">
                                    @else
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                                        <p class="text-muted small mt-2">Belum ada foto</p>
                                    @endif

                                </div>
                            </div>

                            <input type="file"
                                   name="foto"
                                   id="foto"
                                   class="form-control @error('foto') is-invalid @enderror"
                                   accept="image/*">

                            @if($sambutan->foto)
                                <div class="form-text mt-2">
                                    <small class="text-warning">
                                        <i class="fas fa-info-circle"></i>
                                        Kosongkan jika tidak ingin mengubah foto
                                    </small>
                                </div>
                            @endif

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
                        <i class="fas fa-info-circle"></i>
                        <strong>Informasi:</strong>

                        <ul class="mb-0 mt-2 small">
                            <li>Dibuat: {{ $sambutan->created_at->format('d/m/Y H:i') }}</li>
                            <li>Terakhir update: {{ $sambutan->updated_at->format('d/m/Y H:i') }}</li>
                        </ul>
                    </div>

                </div>

            </div>

            <div class="border-top pt-3 mt-3">

                <a href="{{ route('admin.sambutan.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

                <button class="btn btn-primary px-4">
                    <i class="fas fa-save"></i>
                    Update
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

            @if($sambutan->foto)

                document.getElementById('imagePreview').innerHTML = `
                    <img src="{{ asset('storage/' . $sambutan->foto) }}"
                         class="img-fluid rounded"
                         style="max-height: 200px;">
                `;

            @else

                document.getElementById('imagePreview').innerHTML = `
                    <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                    <p class="text-muted small mt-2">Belum ada foto</p>
                `;

            @endif
        }
    });

</script>
@endpush
@endsection