@extends('admin.layouts.app')

@section('title', 'Tambah Program Unggulan')

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

    .preview-card{
        width:100%;
        min-height:280px;
        border-radius:24px;
        border:2px dashed #d1d5db;
        background:#f9fafb;
        display:flex;
        align-items:center;
        justify-content:center;
        overflow:hidden;
        transition:.3s;
        padding:24px;
        text-align:center;
    }

    .preview-content{
        width:100%;
    }

    .preview-icon{
        font-size:70px;
        margin-bottom:18px;
        line-height:1;
    }

    .preview-title{
        font-size:22px;
        font-weight:800;
        color:#166534;
        margin-bottom:12px;
    }

    .preview-description{
        color:#6b7280;
        font-size:14px;
        line-height:1.7;
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
            Tambah Program Unggulan
        </h1>

        <p class="page-subtitle">
            Tambahkan program unggulan baru untuk website sekolah
        </p>

    </div>

</div>

<div class="modern-card">

    <div class="card-body-modern">

        <form action="{{ route('admin.program-unggulan.store') }}"
              method="POST">

            @csrf

            <div class="row g-4">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    <div class="section-title">
                        Informasi Program
                    </div>

                    {{-- NAMA --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Nama Program Unggulan
                        </label>

                        <input type="text"
                               name="nama_program_unggulan"
                               id="nama_program_unggulan"
                               class="form-control @error('nama_program_unggulan') is-invalid @enderror"
                               value="{{ old('nama_program_unggulan') }}"
                               placeholder="Masukkan nama program unggulan">

                        @error('nama_program_unggulan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- IKON --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Ikon Program
                        </label>

                        <select name="ikon"
                                id="ikon"
                                class="form-select @error('ikon') is-invalid @enderror">

                            <option value="">
                                -- Pilih Ikon --
                            </option>

                            <option value="🌱" {{ old('ikon') == '🌱' ? 'selected' : '' }}>
                                🌱 Tani Hasil Siswa
                            </option>

                            <option value="🐄" {{ old('ikon') == '🐄' ? 'selected' : '' }}>
                                🐄 Ternak Hasil Siswa
                            </option>

                            <option value="🏦" {{ old('ikon') == '🏦' ? 'selected' : '' }}>
                                🏦 Bank Ternak Indonesia
                            </option>

                            <option value="👨‍🌾" {{ old('ikon') == '👨‍🌾' ? 'selected' : '' }}>
                                👨‍🌾 Kelompok Tani
                            </option>

                        </select>

                        @error('ikon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- DESKRIPSI --}}
                    <div>

                        <label class="form-label">
                            Deskripsi Program
                        </label>

                        <textarea name="deskripsi"
                                  id="deskripsi"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Tulis deskripsi program unggulan...">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-4">

                    {{-- PREVIEW --}}
                    <div class="modern-card mb-4">

                        <div class="card-body-modern">

                            <div class="section-title">
                                Preview Program
                            </div>

                            <div class="preview-card">

                                <div class="preview-content">

                                    <div class="preview-icon"
                                         id="previewIcon">

                                        {{ old('ikon', '🌱') }}

                                    </div>

                                    <div class="preview-title"
                                         id="previewNama">

                                        {{ old('nama_program_unggulan', 'Nama Program') }}

                                    </div>

                                    <div class="preview-description"
                                         id="previewDeskripsi">

                                        {{ old('deskripsi', 'Deskripsi program unggulan akan tampil disini.') }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- TIPS --}}
                    <div class="tips-card">

                        <div class="tips-title">
                            Tips Program
                        </div>

                        <ul class="tips-list">

                            <li>Gunakan nama program yang singkat</li>
                            <li>Pilih ikon sesuai kategori program</li>
                            <li>Tulis deskripsi yang jelas & menarik</li>
                            <li>Pastikan informasi mudah dipahami</li>

                        </ul>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-4 mt-4 d-flex gap-3">

                <a href="{{ route('admin.program-unggulan.index') }}"
                   class="btn btn-back">

                    Batal

                </a>

                <button type="submit"
                        class="btn btn-save">

                    <i class="fas fa-save me-2"></i>
                    Simpan Program

                </button>

            </div>

        </form>

    </div>

</div>

@push('scripts')

<script>

const namaInput = document.getElementById('nama_program_unggulan');
const ikonInput = document.getElementById('ikon');
const deskripsiInput = document.getElementById('deskripsi');

const previewNama = document.getElementById('previewNama');
const previewIcon = document.getElementById('previewIcon');
const previewDeskripsi = document.getElementById('previewDeskripsi');

namaInput.addEventListener('keyup', function(){

    previewNama.innerHTML =
        this.value || 'Nama Program';

});

ikonInput.addEventListener('change', function(){

    previewIcon.innerHTML =
        this.value || '🌱';

});

deskripsiInput.addEventListener('keyup', function(){

    previewDeskripsi.innerHTML =
        this.value || 'Deskripsi program unggulan akan tampil disini.';

});

</script>

@endpush

@endsection