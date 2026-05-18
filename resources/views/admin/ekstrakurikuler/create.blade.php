@extends('admin.layouts.app')

@section('title', 'Tambah Ekstrakurikuler')

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
    .form-select,
    textarea{
        border-radius:18px !important;
        border:1px solid #e5e7eb !important;
        background:#f9fafb !important;
        padding:16px 18px !important;
        font-size:15px;
        box-shadow:none !important;
    }

    textarea.form-control{
        resize:none;
        min-height:260px !important;
        height:260px !important;
        padding-top:18px !important;
        line-height:1.7;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus{
        border-color:#16a34a !important;
        background:white !important;
        box-shadow:
            0 0 0 4px rgba(22,163,74,.10) !important;
    }

    .preview-box{
        width:100%;
        min-height:120px;
        border-radius:24px;
        background:#f9fafb;
        border:2px dashed #d1d5db;
        padding:24px;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        text-align:center;
    }

    .preview-icon{
        font-size:64px;
        margin-bottom:14px;
    }

    .preview-title{
        font-size:18px;
        font-weight:700;
        color:#1f2937;
    }

    .preview-subtitle{
        font-size:14px;
        color:#6b7280;
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
        display:block;
        margin-top:8px;
    }

</style>

{{-- HEADER --}}
<div class="page-header">

    <div>

        <h1 class="page-title">
            Tambah Ekstrakurikuler
        </h1>

        <p class="page-subtitle">
            Tambahkan data ekstrakurikuler baru untuk sekolah
        </p>

    </div>

</div>

<div class="modern-card">

    <div class="card-body-modern">

        <form action="{{ route('admin.ekstrakurikuler.store') }}"
              method="POST">

            @csrf

            <div class="row g-4">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    <div class="section-title">
                        Informasi Ekstrakurikuler
                    </div>

                    {{-- NAMA --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Nama Ekstrakurikuler
                        </label>

                        <input type="text"
                               name="nama_ekstrakurikuler"
                               id="nama_ekstrakurikuler"
                               class="form-control @error('nama_ekstrakurikuler') is-invalid @enderror"
                               value="{{ old('nama_ekstrakurikuler') }}"
                               placeholder="Masukkan nama ekstrakurikuler">

                        @error('nama_ekstrakurikuler')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- DESKRIPSI --}}
                    <div>

                        <label class="form-label">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  id="deskripsi"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Tulis deskripsi ekstrakurikuler...">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-4">

                    {{-- IKON --}}
                    <div class="modern-card mb-4">

                        <div class="card-body-modern">

                            <div class="section-title">
                                Kategori & Ikon
                            </div>

                            <div class="preview-box mb-4">

                                <div class="preview-icon"
                                     id="previewIcon">

                                    {{ old('ikon', '📱') }}

                                </div>

                                <div class="preview-title"
                                     id="previewNama">

                                    Nama Ekstrakurikuler

                                </div>

                                <div class="preview-subtitle">
                                    Preview tampilan ekstrakurikuler
                                </div>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Pilih Ikon
                                </label>

                                <select name="ikon"
                                        id="ikon"
                                        class="form-select @error('ikon') is-invalid @enderror">

                                    <option value="">-- Pilih Kategori --</option>

                                    <option value="📱" {{ old('ikon') == '📱' ? 'selected' : '' }}>
                                        📱 Content Creator
                                    </option>

                                    <option value="🤖" {{ old('ikon') == '🤖' ? 'selected' : '' }}>
                                        🤖 AI & Digital
                                    </option>

                                    <option value="📊" {{ old('ikon') == '📊' ? 'selected' : '' }}>
                                        📊 Sales & Marketing
                                    </option>

                                    <option value="💡" {{ old('ikon') == '💡' ? 'selected' : '' }}>
                                        💡 Kewirausahaan
                                    </option>
                                </select>

                                @error('ikon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                    {{-- TIPS --}}
                    <div class="tips-card">

                        <div class="tips-title">
                            Tips Pengisian
                        </div>

                        <ul class="tips-list">

                            <li>Gunakan nama ekskul yang jelas</li>
                            <li>Pilih ikon sesuai kategori</li>
                            <li>Tulis deskripsi singkat & menarik</li>
                            <li>Pastikan informasi mudah dipahami</li>

                        </ul>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-4 mt-4 d-flex gap-3">

                <a href="{{ route('admin.ekstrakurikuler.index') }}"
                   class="btn btn-back">

                    Batal

                </a>

                <button type="submit"
                        class="btn btn-save">

                    <i class="fas fa-save me-2"></i>
                    Simpan Ekstrakurikuler

                </button>

            </div>

        </form>

    </div>

</div>

@push('scripts')

<script>

// preview nama
document.getElementById('nama_ekstrakurikuler')
.addEventListener('keyup', function () {

    let nama = this.value;

    let previewNama = document.getElementById('previewNama');

    if(nama){
        previewNama.innerHTML = nama;
    }else{
        previewNama.innerHTML = 'Nama Ekstrakurikuler';
    }

});

// preview ikon
document.getElementById('ikon')
.addEventListener('change', function () {

    document.getElementById('previewIcon').innerHTML =
        this.value || '📱';

});

// trigger awal
document.getElementById('nama_ekstrakurikuler')
.dispatchEvent(new Event('keyup'));

</script>

@endpush

@endsection