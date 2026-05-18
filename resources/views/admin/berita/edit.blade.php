@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('content')

<style>

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

    .modern-card{
        border:none;
        border-radius:28px;
        background:white;
        overflow:hidden;
        box-shadow:
            0 10px 30px rgba(0,0,0,.05),
            0 2px 10px rgba(0,0,0,.03);
    }

    .card-body-modern{
        padding:32px;
    }

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

    .form-control,
    textarea{
        border-radius:18px !important;
        border:1px solid #e5e7eb !important;
        background:#f9fafb !important;
        padding:16px 18px !important;
        font-size:15px;
        box-shadow:none !important;
    }

    .form-control:focus,
    textarea:focus{
        background:white !important;
        border-color:#bbf7d0 !important;
        box-shadow:0 0 0 4px rgba(22,163,74,.10) !important;
    }

    textarea.form-control{
        resize:none;
        min-height:320px !important;
        height:320px !important;
        padding-top:18px !important;
        line-height:1.8;
    }

    .upload-preview{
        width:100%;
        height:280px;
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
    }

    .upload-placeholder i{
        font-size:58px;
        color:#9ca3af;
        margin-bottom:18px;
    }

    .upload-placeholder h6{
        font-weight:700;
        color:#374151;
        margin-bottom:6px;
    }

    .upload-placeholder p{
        color:#9ca3af;
        font-size:14px;
        margin:0;
    }

    .custom-file{
        position:relative;
    }

    .custom-file input[type=file]{
        opacity:0;
        position:absolute;
        inset:0;
        width:100%;
        cursor:pointer;
    }

    .custom-file-label{
        width:100%;
        height:58px;
        border-radius:18px;
        background:linear-gradient(
            135deg,
            #166534,
            #15803d
        );
        color:white;
        display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;
        font-weight:700;
        cursor:pointer;
        transition:.3s;
    }

    .custom-file-label:hover{
        transform:translateY(-2px);
        box-shadow:
            0 10px 20px rgba(21,128,61,.20);
    }

    .form-switch{
        padding-left:0;
        display:flex;
        align-items:center;
        justify-content:space-between;
    }

    .form-switch .form-check-input{
        width:58px;
        height:30px;
    }

    .tips-card{
        border:none;
        border-radius:24px;
        background:linear-gradient(
            135deg,
            #f0fdf4,
            #dcfce7
        );
        padding:24px;
    }

    .tips-title{
        font-size:16px;
        font-weight:800;
        color:#166534;
        margin-bottom:14px;
    }

    .tips-list{
        padding-left:18px;
        margin:0;
    }

    .tips-list li{
        color:#166534;
        margin-bottom:8px;
        line-height:1.6;
    }

    .btn-back{
        border:none !important;
        border-radius:18px !important;
        padding:14px 24px !important;
        font-weight:700;
        background:#f3f4f6 !important;
        color:#374151 !important;
        transition:.3s;
    }

    .btn-back:hover{
        background:#e5e7eb !important;
    }

    .btn-save{
        border:none !important;
        border-radius:18px !important;
        padding:14px 28px !important;
        font-weight:700;
        color:white !important;
        background:linear-gradient(
            135deg,
            #166534,
            #15803d
        ) !important;
        transition:.3s;
    }

    .btn-save:hover{
        transform:translateY(-2px);
        box-shadow:
            0 10px 20px rgba(21,128,61,.25);
    }

    .invalid-feedback{
        font-size:13px;
        margin-top:8px;
        display:block;
    }

    .slug-preview{
        padding:16px 18px;
        border-radius:18px;
        background:#f9fafb;
        border:1px solid #e5e7eb;
        color:#166534;
        font-size:14px;
        word-break:break-all;
    }

    .status-box{
        display:flex;
        flex-direction:column;
        gap:14px;
    }

    .status-item{
        display:flex;
        align-items:center;
        gap:12px;
        padding:14px 16px;
        border-radius:18px;
        background:#f9fafb;
        border:1px solid #eef2f7;
    }

    .status-item input{
        width:20px;
        height:20px;
    }

    .status-item label{
        margin:0;
        font-weight:600;
        color:#374151;
        cursor:pointer;
        flex:1;
    }

</style>

{{-- HEADER --}}
<div class="page-header">

    <div>

        <h1 class="page-title">
            Edit Berita
        </h1>

        <p class="page-subtitle">
            Update berita dan informasi terbaru website sekolah
        </p>

    </div>

</div>

<div class="modern-card">

    <div class="card-body-modern">

        <form action="{{ route('admin.berita.update', $berita->slug) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    <div class="section-title">
                        Informasi Berita
                    </div>

                    {{-- JUDUL --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Judul Berita
                        </label>

                        <input type="text"
                               id="judul"
                               name="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $berita->judul) }}"
                               placeholder="Masukkan judul berita">

                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- SLUG --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Slug URL
                        </label>

                        <input type="text"
                               id="slug"
                               name="slug"
                               class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug', $berita->slug) }}"
                               placeholder="Slug berita">

                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- SLUG PREVIEW --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Preview Link
                        </label>

                        <div class="slug-preview"
                             id="slugPreview">
                            {{ url('/berita/' . $berita->slug) }}
                        </div>

                    </div>

                    {{-- KONTEN --}}
                    <div>

                        <label class="form-label">
                            Konten Berita
                        </label>

                        <textarea name="konten"
                                  class="form-control @error('konten') is-invalid @enderror"
                                  placeholder="Tulis konten berita...">{{ old('konten', $berita->konten) }}</textarea>

                        @error('konten')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-4">

                    {{-- IMAGE --}}
                    <div class="modern-card mb-4">

                        <div class="card-body-modern">

                            <div class="section-title">
                                Upload Gambar
                            </div>

                            <div id="imagePreview"
                                 class="upload-preview mb-4">

                                @if($berita->gambar)

                                    <img src="{{ asset('storage/' . $berita->gambar) }}">

                                @else

                                    <div class="upload-placeholder">

                                        <i class="fas fa-image"></i>

                                        <h6>
                                            Belum Ada Gambar
                                        </h6>

                                        <p>
                                            Upload thumbnail berita
                                        </p>

                                    </div>

                                @endif

                            </div>

                            <div class="custom-file">

                                <label class="custom-file-label">

                                    <i class="fas fa-upload"></i>
                                    Ganti Gambar

                                    <input type="file"
                                           name="gambar"
                                           id="gambar"
                                           accept="image/*">

                                </label>

                            </div>

                            <small class="text-muted d-block mt-3">
                                Kosongkan jika tidak ingin mengganti gambar
                            </small>

                            @error('gambar')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- SETTINGS --}}
                    <div class="modern-card mb-4">

                        <div class="card-body-modern">

                            <div class="section-title">
                                Pengaturan
                            </div>

                            {{-- TANGGAL --}}
                            <div class="mb-4">

                                <label class="form-label">
                                    Tanggal Berita
                                </label>

                                <input type="date"
                                       name="tanggal"
                                       class="form-control @error('tanggal') is-invalid @enderror"
                                       value="{{ old('tanggal', $berita->tanggal) }}">

                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- STATUS --}}
                            <div>

                                <label class="form-label mb-3">
                                    Status Publikasi
                                </label>

                                <div class="status-box">

                                    <div class="status-item">

                                        <input type="radio"
                                               name="is_published"
                                               id="published"
                                               value="1"
                                               {{ old('is_published', $berita->is_published) == '1' ? 'checked' : '' }}>

                                        <label for="published">
                                            <i class="fas fa-globe text-success me-2"></i>
                                            Publish Berita
                                        </label>

                                    </div>

                                    <div class="status-item">

                                        <input type="radio"
                                               name="is_published"
                                               id="draft"
                                               value="0"
                                               {{ old('is_published', $berita->is_published) == '0' ? 'checked' : '' }}>

                                        <label for="draft">
                                            <i class="fas fa-pencil-alt text-secondary me-2"></i>
                                            Simpan Sebagai Draft
                                        </label>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- INFO --}}
                    <div class="tips-card">

                        <div class="tips-title">
                            Informasi Berita
                        </div>

                        <ul class="tips-list">

                            <li>
                                Dibuat:
                                {{ $berita->created_at->format('d M Y') }}
                            </li>

                            <li>
                                Jam:
                                {{ $berita->created_at->format('H:i') }}
                            </li>

                            <li>
                                Update:
                                {{ $berita->updated_at->diffForHumans() }}
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-4 mt-4 d-flex gap-3">

                <a href="{{ route('admin.berita.index') }}"
                   class="btn btn-back">

                    Batal

                </a>

                <button type="submit"
                        class="btn btn-save">

                    <i class="fas fa-save me-2"></i>
                    Update Berita

                </button>

            </div>

        </form>

    </div>

</div>

@push('scripts')

<script>

document.getElementById('gambar')
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
                <img src="${e.target.result}">
            `;
        }

        reader.readAsDataURL(file);
    }
});

// AUTO SLUG
document.getElementById('judul')
.addEventListener('keyup', function()
{
    let judul = this.value;

    let slug = judul.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');

    document.getElementById('slug').value = slug;

    document.getElementById('slugPreview').innerHTML =
        "{{ url('/berita') }}/" + slug;
});

// UPDATE PREVIEW SLUG MANUAL
document.getElementById('slug')
.addEventListener('keyup', function()
{
    document.getElementById('slugPreview').innerHTML =
        "{{ url('/berita') }}/" + this.value;
});

</script>

@endpush

@endsection