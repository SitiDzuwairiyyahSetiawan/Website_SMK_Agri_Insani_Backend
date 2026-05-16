@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Edit Berita</h2>
        <p class="text-muted">Edit atau update informasi berita yang sudah ada</p>
    </div>

</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.berita.update', $berita->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <!-- Judul -->
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">
                            Judul Berita <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('judul') is-invalid @enderror" 
                               id="judul" 
                               name="judul" 
                               value="{{ old('judul', $berita->judul) }}" 
                               required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Slug -->
                    <div class="mb-3">
                        <label for="slug" class="form-label fw-bold">Slug (URL)</label>
                        <input type="text" 
                               class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" 
                               name="slug" 
                               value="{{ old('slug', $berita->slug) }}">
                        <div class="form-text">Biarkan kosong untuk auto-generate dari judul</div>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Konten -->
                    <div class="mb-3">
                        <label for="konten" class="form-label fw-bold">
                            Konten Berita <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('konten') is-invalid @enderror" 
                                  id="konten" 
                                  name="konten" 
                                  rows="12">{{ old('konten', $berita->konten) }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <!-- Gambar -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <i class="fas fa-image"></i> Gambar Berita
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div id="imagePreview" class="border rounded p-3 bg-light">
                                    @if($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid rounded" style="max-height: 200px;">
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
                            @if($berita->gambar)
                                <div class="form-text">
                                    <small class="text-warning">
                                        <i class="fas fa-info-circle"></i> 
                                        Kosongkan jika tidak ingin mengubah gambar
                                    </small>
                                </div>
                            @endif
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Tanggal -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <i class="fas fa-calendar-alt"></i> Informasi Publikasi
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label fw-bold">
                                    Tanggal Berita <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control @error('tanggal') is-invalid @enderror" 
                                       id="tanggal" 
                                       name="tanggal" 
                                       value="{{ old('tanggal', $berita->tanggal) }}"
                                       required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status Publikasi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_published" id="published" value="1" {{ old('is_published', $berita->is_published) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="published">
                                        <i class="fas fa-globe text-success"></i> Publikasikan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_published" id="draft" value="0" {{ old('is_published', $berita->is_published) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="draft">
                                        <i class="fas fa-pencil-alt text-secondary"></i> Simpan sebagai Draft
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Informasi:</strong>
                        <ul class="mb-0 mt-2 small">
                            <li>Dibuat: {{ $berita->created_at->format('d/m/Y H:i') }}</li>
                            <li>Terakhir update: {{ $berita->updated_at->format('d/m/Y H:i') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="border-top pt-3 mt-3">
                <a href="{{ route('admin.galeri.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Auto generate slug from judul if slug field is empty
    document.getElementById('judul').addEventListener('keyup', function() {
        let slugInput = document.getElementById('slug');
        if (!slugInput.value || slugInput.value === '{{ $berita->slug }}') {
            let judul = this.value;
            let slug = judul.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
        }
    });
    
    // Preview Gambar
    document.getElementById('gambar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">`;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection