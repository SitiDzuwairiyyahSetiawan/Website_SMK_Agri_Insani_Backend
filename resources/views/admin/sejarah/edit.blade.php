@extends('admin.layouts.app')

@section('title', 'Edit Sejarah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Edit Sejarah</h2>
        <p class="text-muted">Perbarui catatan sejarah yang sudah ada</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.sejarah.update', $sejarah->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-8">

                    <!-- Konten -->
                    <div class="mb-3">
                        <label for="konten" class="form-label fw-bold">
                            Konten Sejarah <span class="text-danger">*</span>
                        </label>

                        <textarea class="form-control @error('konten') is-invalid @enderror"
                                  id="konten"
                                  name="konten"
                                  rows="15"
                                  placeholder="Tulis sejarah sekolah disini...">{{ old('konten', $sejarah->konten) }}</textarea>

                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-text">
                            Tuliskan sejarah sekolah dengan jelas dan terstruktur.
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <!-- Gambar -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <i class="fas fa-image"></i> Gambar Pendukung
                        </div>

                        <div class="card-body">

                            <div class="text-center mb-3">
                                <div id="imagePreview" class="border rounded p-3 bg-light">

                                    @if($sejarah->gambar)
                                        <img src="{{ asset('storage/' . $sejarah->gambar) }}"
                                             class="img-fluid rounded"
                                             style="max-height: 200px;">
                                    @else
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                                        <p class="text-muted small mt-2">Belum ada gambar</p>
                                    @endif

                                </div>
                            </div>

                            <input type="file"
                                   class="form-control @error('gambar') is-invalid @enderror"
                                   id="gambar"
                                   name="gambar"
                                   accept="image/*">

                            @if($sejarah->gambar)
                                <div class="form-text mt-2">
                                    <small class="text-warning">
                                        <i class="fas fa-info-circle"></i>
                                        Kosongkan jika tidak ingin mengubah gambar
                                    </small>
                                </div>
                            @endif

                            <div class="form-text mt-2">
                                <small>
                                    <i class="fas fa-info-circle"></i>
                                    Format: JPG, PNG, JPEG, GIF (Max 2MB)<br>
                                    Ukuran rekomendasi: 800x500px
                                </small>
                            </div>

                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>

                    <!-- Informasi -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Informasi:</strong>

                        <ul class="mb-0 mt-2 small">
                            <li>Dibuat: {{ $sejarah->created_at->format('d/m/Y H:i') }}</li>
                            <li>Terakhir update: {{ $sejarah->updated_at->format('d/m/Y H:i') }}</li>
                        </ul>
                    </div>

                </div>

            </div>

            <div class="border-top pt-3 mt-3">

                <a href="{{ route('admin.sejarah.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save"></i>
                    Update
                </button>

            </div>

        </form>

    </div>
</div>

@push('scripts')
<script>

    // Preview Gambar
    document.getElementById('gambar').addEventListener('change', function(e) {

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

            @if($sejarah->gambar)

                document.getElementById('imagePreview').innerHTML = `
                    <img src="{{ asset('storage/' . $sejarah->gambar) }}"
                         class="img-fluid rounded"
                         style="max-height: 200px;">
                `;

            @else

                document.getElementById('imagePreview').innerHTML = `
                    <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                    <p class="text-muted small mt-2">Belum ada gambar</p>
                `;

            @endif
        }
    });

</script>
@endpush
@endsection