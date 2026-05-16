@extends('admin.layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Tambah Berita Baru</h2>
        <p class="text-muted">Buat berita atau informasi terbaru untuk publikasi</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
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
                               value="{{ old('judul') }}" 
                               placeholder="Masukkan judul berita"
                               required>
                        <div class="form-text">Judul akan otomatis dibuatkan slug untuk URL</div>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Slug Preview -->
                    <div class="mb-3">
                        <label class="form-label text-muted">
                            <i class="fas fa-link"></i> Preview Slug:
                        </label>
                        <div class="bg-light p-2 rounded" id="slugPreview"></div>
                    </div>
                    
                    <!-- Konten -->
                    <div class="mb-3">
                        <label for="konten" class="form-label fw-bold">
                            Konten Berita <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('konten') is-invalid @enderror" 
                                  id="konten" 
                                  name="konten" 
                                  rows="12" 
                                  placeholder="Tulis konten berita disini...">{{ old('konten') }}</textarea>
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
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                                    <p class="text-muted small mt-2">Belum ada gambar</p>
                                </div>
                            </div>
                            <input type="file" 
                                   class="form-control @error('gambar') is-invalid @enderror" 
                                   id="gambar" 
                                   name="gambar" 
                                   accept="image/*">
                            <div class="form-text mt-2">
                                <small>
                                    <i class="fas fa-info-circle"></i> 
                                    Format: JPG, PNG, JPEG (Max 2MB)<br>
                                    Ukuran rekomendasi: 800x500px
                                </small>
                            </div>
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
                                       value="{{ old('tanggal', date('Y-m-d')) }}"
                                       required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status Publikasi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_published" id="published" value="1" {{ old('is_published', '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="published">
                                        <i class="fas fa-globe text-success"></i> Publikasikan (Langsung tampil di website)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_published" id="draft" value="0" {{ old('is_published') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="draft">
                                        <i class="fas fa-pencil-alt text-secondary"></i> Simpan sebagai Draft
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informasi -->
                    <div class="alert alert-info">
                        <i class="fas fa-lightbulb"></i>
                        <strong>Tips:</strong>
                        <ul class="mb-0 mt-2 small">
                            <li>Gunakan judul yang menarik dan informatif</li>
                            <li>Konten yang panjang bisa menggunakan paragraf</li>
                            <li>Gambar akan membantu visualisasi berita</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="border-top pt-3 mt-3">
                <a href="{{ route('admin.galeri.index') }}"
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
    // Preview Slug dari Judul
    document.getElementById('judul').addEventListener('keyup', function() {
        let judul = this.value;
        let slug = judul.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        
        let previewDiv = document.getElementById('slugPreview');
        if (slug) {
            previewDiv.innerHTML = '<code>{{ url("/berita") }}/' + slug + '</code>';
        } else {
            previewDiv.innerHTML = '<span class="text-muted">Slug akan muncul setelah judul diisi</span>';
        }
    });
    
    // Trigger preview slug on page load
    document.getElementById('judul').dispatchEvent(new Event('keyup'));
    
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
        } else {
            document.getElementById('imagePreview').innerHTML = `
                <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                <p class="text-muted small mt-2">Belum ada gambar</p>
            `;
        }
    });
</script>
@endpush
@endsection