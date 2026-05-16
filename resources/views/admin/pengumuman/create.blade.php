@extends('admin.layouts.app')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Tambah Pengumuman Baru</h2>
        <p class="text-muted">Buat pengumuman, jadwal, atau informasi penting</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required>
                        <div class="form-text">Judul akan otomatis dibuatkan slug untuk URL.</div>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted"><i class="fas fa-link"></i> Preview Slug:</label>
                        <div class="bg-light p-2 rounded" id="slugPreview"></div>
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label fw-bold">Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="10" placeholder="Tulis isi pengumuman di sini...">{{ old('isi') }}</textarea>
                        @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header bg-light"><i class="fas fa-paperclip"></i> Unggah File (opsional)</div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div id="filePreview" class="border rounded p-3 bg-light">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                                    <p class="text-muted small mt-2">Belum ada file</p>
                                </div>
                            </div>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                            <div class="form-text mt-2">
                                <small><i class="fas fa-info-circle"></i> Format: JPG, PNG, PDF, DOC, DOCX (Max 5MB)</small>
                            </div>
                            @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-light"><i class="fas fa-calendar-alt"></i> Informasi Publikasi</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label fw-bold">Tanggal Pengumuman <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status Publikasi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_published" id="published" value="1" {{ old('is_published', '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="published"><i class="fas fa-globe text-success"></i> Publikasikan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_published" id="draft" value="0" {{ old('is_published') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="draft"><i class="fas fa-pencil-alt text-secondary"></i> Simpan sebagai Draft</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-lightbulb"></i> <strong>Tips:</strong>
                        <ul class="mb-0 mt-2 small">
                            <li>Gunakan judul yang jelas dan informatif.</li>
                            <li>File opsional (misalnya jadwal, kalender akademik).</li>
                            <li>Pengumuman yang dipublikasi akan tampil di h depan.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-top pt-3 mt-3">
                <a href="{{ route('admin.galeri.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save"></i> Simpan </button>            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Preview slug
    document.getElementById('judul').addEventListener('keyup', function() {
        let judul = this.value;
        let slug = judul.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        let previewDiv = document.getElementById('slugPreview');
        previewDiv.innerHTML = slug ? '<code>{{ url("/pengumuman") }}/' + slug + '</code>' : '<span class="text-muted">Slug akan muncul setelah judul diisi</span>';
    });
    document.getElementById('judul').dispatchEvent(new Event('keyup'));

    // Preview file (gambar atau nama file)
    document.getElementById('file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('filePreview');
        if (file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    preview.innerHTML = `<img src="${ev.target.result}" class="img-fluid rounded" style="max-height: 200px;">`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = `<div class="p-3"><i class="fas fa-file-alt fa-3x text-primary"></i><p class="mt-2">${file.name}</p></div>`;
            }
        } else {
            preview.innerHTML = `<i class="fas fa-cloud-upload-alt fa-3x text-muted"></i><p class="text-muted small mt-2">Belum ada file</p>`;
        }
    });
</script>
@endpush
@endsection