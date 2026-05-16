@extends('admin.layouts.app')

@section('title', 'Edit Galeri')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Edit Galeri</h2>
        <p class="text-muted">Edit atau update foto galeri sekolah</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.galeri.update', $galeri->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                {{-- KONTEN --}}
                <div class="col-md-8">

                    {{-- JUDUL --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Judul Galeri <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $galeri->judul) }}"
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
                                  rows="12"
                                  class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>

                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                {{-- SIDEBAR --}}
                <div class="col-md-4">

                    {{-- GAMBAR --}}
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <i class="fas fa-image"></i>
                            Gambar Galeri
                        </div>

                        <div class="card-body">

                            <div class="text-center mb-3">

                                <div id="imagePreview"
                                     class="border rounded p-3 bg-light">

                                    @if($galeri->gambar)

                                        <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                             class="img-fluid rounded"
                                             style="max-height: 220px; object-fit: cover;">

                                    @else

                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>

                                        <p class="text-muted small mt-2">
                                            Belum ada gambar
                                        </p>

                                    @endif

                                </div>

                            </div>

                            <input type="file"
                                   name="gambar"
                                   id="gambar"
                                   class="form-control @error('gambar') is-invalid @enderror"
                                   accept="image/*">

                            <div class="form-text">
                                <small class="text-warning">
                                    <i class="fas fa-info-circle"></i>
                                    Kosongkan jika tidak ingin mengubah gambar
                                </small>
                            </div>

                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="alert alert-info">

                        <i class="fas fa-info-circle"></i>

                        <strong>Informasi:</strong>

                        <ul class="mb-0 mt-2 small">
                            <li>
                                Dibuat:
                                {{ $galeri->created_at->format('d/m/Y H:i') }}
                            </li>

                            <li>
                                Terakhir update:
                                {{ $galeri->updated_at->format('d/m/Y H:i') }}
                            </li>
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

                <button type="submit"
                        class="btn btn-primary px-4">

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

        if (file)
        {
            const reader = new FileReader();

            reader.onload = function(e)
            {
                const preview = document.getElementById('imagePreview');

                preview.innerHTML =
                    `<img src="${e.target.result}"
                          class="img-fluid rounded"
                          style="max-height:220px; object-fit:cover;">`;
            }

            reader.readAsDataURL(file);
        }

    });

</script>
@endpush

@endsection