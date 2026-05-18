@extends('admin.layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')

<style>

/* ===== HEADER ===== */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    margin-bottom:32px;
    flex-wrap:wrap;
}

.page-title{
    font-size:38px;
    font-weight:800;
    color:white;
    margin-bottom:8px;
    line-height:1.1;
}

.page-subtitle{
    color:rgba(255,255,255,.7);
    margin:0;
    font-size:15px;
    font-weight:500;
}

/* ===== CARD ===== */
.modern-card{
    border:none;
    border-radius:28px;
    background:white;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.05),
               0 2px 10px rgba(0,0,0,.03);
}

.card-body-modern{
    padding:32px;
}

/* ===== SECTION ===== */
.section-title{
    font-size:13px;
    font-weight:800;
    color:#16a34a;
    text-transform:uppercase;
    letter-spacing:.08em;
    margin-bottom:22px;
}

.form-label{
    font-size:14px;
    font-weight:700;
    color:#1f2937;
    margin-bottom:10px;
}

/* ===== INPUT ===== */
.form-control,
textarea{
    border-radius:18px !important;
    border:1px solid #e5e7eb !important;
    background:#f9fafb !important;
    padding:16px 18px !important;
    font-size:15px;
}

.form-control:focus,
textarea:focus{
    background:white !important;
    border-color:#bbf7d0 !important;
    box-shadow:0 0 0 4px rgba(22,163,74,.10) !important;
}

textarea.form-control{
    resize:none;
    min-height:320px;
}

/* ===== UPLOAD ===== */
.upload-preview{
    width:100%;
    height:260px;
    border-radius:24px;
    border:2px dashed #d1d5db;
    background:#f9fafb;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
}

.upload-preview img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.upload-placeholder{
    text-align:center;
    color:#6b7280;
}

/* ===== FILE INPUT ===== */
.custom-file{
    position:relative;
}

.custom-file input{
    opacity:0;
    position:absolute;
    inset:0;
    cursor:pointer;
}

.custom-file-label{
    width:100%;
    height:56px;
    border-radius:18px;
    background:#15803d;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    transition:.3s;
}

/* ===== SLUG ===== */
.slug-preview{
    padding:14px;
    border-radius:14px;
    background:#f9fafb;
    border:1px solid #e5e7eb;
    color:#15803d;
    font-size:14px;
    word-break:break-all;
}

/* ===== STATUS ===== */
.status-box{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.status-item{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px;
    border-radius:14px;
    background:#f9fafb;
    border:1px solid #e5e7eb;
}

.status-item input{
    width:18px;
    height:18px;
    cursor:pointer;
}

.status-item label{
    margin:0;
    font-weight:600;
    color:#374151 !important;
    cursor:pointer;
    flex:1;
}

/* ===== BUTTON FIX (INI YANG BIKIN TADI PUTIH) ===== */
.btn-back{
    padding:12px 22px;
    border-radius:14px;
    background:#f3f4f6;
    font-weight:700;
    border:none;
}

.btn-save{
    padding:12px 26px;
    border-radius:14px;
    background:linear-gradient(135deg,#166534,#15803d) !important;
    color:white !important;
    font-weight:700;
    border:none !important;
}

.btn-save:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(21,128,61,.25);
}

</style>

{{-- HEADER --}}
<div class="page-header">
    <div>
        <h1 class="page-title">Edit Pengumuman</h1>
        <p class="page-subtitle">Update pengumuman website sekolah</p>
    </div>
</div>

<div class="modern-card">
<div class="card-body-modern">

<form action="{{ route('admin.pengumuman.update', $pengumuman->slug) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="row g-4">

    {{-- LEFT --}}
    <div class="col-lg-8">

        <div class="section-title">Informasi Pengumuman</div>

        {{-- JUDUL --}}
        <div class="mb-4">
            <label class="form-label">Judul Pengumuman</label>
            <input type="text"
                   id="judul"
                   name="judul"
                   class="form-control"
                   value="{{ old('judul', $pengumuman->judul) }}">
        </div>

        {{-- SLUG --}}
        <div class="mb-4">
            <label class="form-label">Slug</label>
            <input type="text"
                   id="slug"
                   name="slug"
                   class="form-control"
                   value="{{ old('slug', $pengumuman->slug) }}">
        </div>

        {{-- PREVIEW --}}
        <div class="mb-4">
            <label class="form-label">Preview Link</label>
            <div class="slug-preview" id="slugPreview">
                {{ url('/pengumuman/' . $pengumuman->slug) }}
            </div>
        </div>

        {{-- ISI --}}
        <div class="mb-4">
            <label class="form-label">Isi Pengumuman</label>
            <textarea name="isi" class="form-control">{{ old('isi', $pengumuman->isi) }}</textarea>
        </div>

    </div>

    {{-- RIGHT --}}
    <div class="col-lg-4">

        {{-- FILE --}}
        <div class="modern-card mb-4">
            <div class="card-body-modern">

                <div class="section-title">File</div>

                <div class="upload-preview mb-3">
                    @if($pengumuman->file_path)
                        @if($pengumuman->file_type == 'image')
                            <img src="{{ $pengumuman->file_url }}">
                        @else
                            <div class="upload-placeholder">
                                <i class="fas fa-file"></i>
                                <p>{{ basename($pengumuman->file_path) }}</p>
                            </div>
                        @endif
                    @else
                        <div class="upload-placeholder">Tidak ada file</div>
                    @endif
                </div>

                <div class="custom-file">
                    <label class="custom-file-label">
                        Ganti File
                        <input type="file" name="file">
                    </label>
                </div>

            </div>
        </div>

        {{-- SETTINGS --}}
        <div class="modern-card mb-4">
            <div class="card-body-modern">

                <div class="section-title">Pengaturan</div>

                {{-- TANGGAL --}}
                <div class="mb-4">
                    <label class="form-label">Tanggal Pengumuman</label>
                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ old('tanggal', $pengumuman->tanggal) }}">
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="form-label mb-3">Status Publikasi</label>

                    <div class="status-box">

                        <div class="status-item">
                            <input type="radio"
                                   name="is_published"
                                   value="1"
                                   id="published"
                                   {{ old('is_published', $pengumuman->is_published) == '1' ? 'checked' : '' }}>
                            <label for="published">Publish Pengumuman</label>
                        </div>

                        <div class="status-item">
                            <input type="radio"
                                   name="is_published"
                                   value="0"
                                   id="draft"
                                   {{ old('is_published', $pengumuman->is_published) == '0' ? 'checked' : '' }}>
                            <label for="draft">Simpan Sebagai Draft</label>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

{{-- BUTTON --}}
<div class="mt-4 d-flex gap-3">
    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-back">
        Batal
    </a>

    <button type="submit" class="btn btn-save">
        <i class="fas fa-save me-2"></i>
        Update Pengumuman
    </button>
</div>

</form>

</div>
</div>

<script>
// SLUG AUTO
document.getElementById('judul').addEventListener('keyup', function () {
    let slug = this.value.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');

    document.getElementById('slug').value = slug;
    document.getElementById('slugPreview').innerText =
        "{{ url('/pengumuman') }}/" + slug;
});
</script>

@endsection