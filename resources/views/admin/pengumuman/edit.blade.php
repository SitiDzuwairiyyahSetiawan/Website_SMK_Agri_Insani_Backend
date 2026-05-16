@extends('admin.layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Edit Pengumuman</h2>
        <p class="text-muted">Perbaharui informasi pengumuman</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.pengumuman.update', $pengumuman->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $pengumuman->judul) }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label fw-bold">Slug (URL)</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $pengumuman->slug) }}">
                        <div class="form-text">Kosongkan untuk auto-generate dari judul.</div>
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label fw-bold">Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="10">{{ old('isi', $pengumuman->isi) }}</textarea>
                        @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header bg-light"><i class="fas fa-paperclip"></i> Unggah File</div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div id="filePreview" class="border rounded p-3 bg-light">
                                    @if($pengumuman->file_path)
                                        @if($pengumuman->file_type == 'image')
                                            <img src="{{ $pengumuman->file_url }}" class="img-fluid rounded" style="max-height: 200px;">
                                        @else
                                            <div class="p-3">
                                                <i class="fas fa-file-alt fa-3x text-primary"></i>
                                                <p class="mt-2">{{ basename($pengumuman->file_path) }}</p>
                                            </div>
                                        @endif
                                    @else
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                                        <p class="text-muted small mt-2">Belum ada file</p>
                                    @endif
                                </div>
                            </div>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                            @if($pengumuman->file_path)
                                <div class="form-text text-warning"><i class="fas fa-info-circle"></i> Kosongkan jika tidak ingin mengubah file.</div>
                            @endif
                            @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-light"><i class="fas fa-calendar-alt"></i> Informasi Publikasi</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label fw-bold">Tanggal Pengumuman <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $pengumuman->tanggal->format('Y-m-d')) }}" required>
                                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Status Publikasi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_published" id="published" value="1" {{ old('is_published', $pengumuman->is_published) == '1' ? 'checked' : '' }}>
                                    <label for="published"><i class="fas fa-globe text-success"></i> Publikasikan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_published" id="draft" value="0" {{ old('is_published', $pengumuman->is_published) == '0' ? 'checked' : '' }}>
                                    <label for="draft"><i class="fas fa-pencil-alt text-secondary"></i> Draft</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Dibuat: {{ $pengumuman->created_at->format('d/m/Y H:i') }}<br>
                        Terakhir update: {{ $pengumuman->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>

            <div class="border-top pt-3 mt-3">
                <a href="{{ route('admin.galeri.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save"></i> Update </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Generate slug jika slug masih kosong atau sama dengan slug lama
    const judulInput = document.getElementById('judul');
    const slugInput = document.getElementById('slug');
    const oldSlug = "{{ $pengumuman->slug }}";
    judulInput.addEventListener('keyup', function() {
        if (!slugInput.value || slugInput.value === oldSlug) {
            let judul = this.value;
            let slug = judul.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
            slugInput.value = slug;
        }
    });

    // Preview file
    document.getElementById('file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('filePreview');
        if (file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(ev) { preview.innerHTML = `<img src="${ev.target.result}" class="img-fluid rounded" style="max-height: 200px;">`; };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = `<div class="p-3"><i class="fas fa-file-alt fa-3x text-primary"></i><p class="mt-2">${file.name}</p></div>`;
            }
        } else {
            @if($pengumuman->file_path)
                @if($pengumuman->file_type == 'image')
                    preview.innerHTML = `<img src="{{ $pengumuman->file_url }}" class="img-fluid rounded" style="max-height: 200px;">`;
                @else
                    preview.innerHTML = `<div class="p-3"><i class="fas fa-file-alt fa-3x text-primary"></i><p class="mt-2">{{ basename($pengumuman->file_path) }}</p></div>`;
                @endif
            @else
                preview.innerHTML = `<i class="fas fa-cloud-upload-alt fa-3x text-muted"></i><p class="text-muted small mt-2">Belum ada file</p>`;
            @endif
        }
    });
</script>
@endpush
@endsection