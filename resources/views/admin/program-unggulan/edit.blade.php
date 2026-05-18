@extends('admin.layouts.app')

@section('title', 'Edit Program Unggulan')

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

    .form-control:focus,
    .form-select:focus,
    textarea:focus{
        background:white !important;
        border-color:#bbf7d0 !important;
        box-shadow:0 0 0 4px rgba(22,163,74,.10) !important;
    }

    textarea.form-control{
        resize:none;
        min-height:260px !important;
        height:260px !important;
        padding-top:18px !important;
        line-height:1.7;
    }

    .icon-preview-box{
        width:100%;
        height:280px;
        border-radius:24px;
        border:2px dashed #d1d5db;
        background:#f9fafb;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
        overflow:hidden;
    }

    .icon-preview{
        font-size:100px;
        line-height:1;
        margin-bottom:12px;
    }

    .icon-preview-text{
        font-size:14px;
        color:#6b7280;
        font-weight:600;
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

    .preview-name{
        padding:18px;
        border-radius:18px;
        background:#f9fafb;
        border:1px solid #f3f4f6;
        font-weight:700;
        color:#111827;
        min-height:58px;
        display:flex;
        align-items:center;
    }

    .invalid-feedback{
        font-size:13px;
        margin-top:8px;
        display:block;
    }

    @media(max-width:768px){

        .page-title{
            font-size:30px;
        }

        .card-body-modern{
            padding:22px;
        }

        .icon-preview-box{
            height:240px;
        }

    }

</style>

{{-- HEADER --}}
<div class="page-header">

    <div>

        <h1 class="page-title">
            Edit Program Unggulan
        </h1>

        <p class="page-subtitle">
            Update data program unggulan sekolah
        </p>

    </div>

</div>

<div class="modern-card">

    <div class="card-body-modern">

        <form action="{{ route('admin.program-unggulan.update', $programUnggulan->id) }}"
              method="POST">

            @csrf
            @method('PUT')

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
                               value="{{ old('nama_program_unggulan', $programUnggulan->nama_program_unggulan) }}"
                               placeholder="Masukkan nama program unggulan">

                        @error('nama_program_unggulan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- PREVIEW --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Preview Nama Program
                        </label>

                        <div class="preview-name"
                             id="previewNama">

                            {{ $programUnggulan->nama_program_unggulan }}

                        </div>

                    </div>

                    {{-- DESKRIPSI --}}
                    <div>

                        <label class="form-label">
                            Deskripsi Program
                        </label>

                        <textarea name="deskripsi"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Tulis deskripsi program unggulan...">{{ old('deskripsi', $programUnggulan->deskripsi) }}</textarea>

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
                                Ikon Program
                            </div>

                            <div class="icon-preview-box mb-4">

                                <div class="icon-preview"
                                     id="previewIcon">

                                    {{ $programUnggulan->ikon }}

                                </div>

                                <div class="icon-preview-text">
                                    Preview Ikon Program
                                </div>

                            </div>

                            <select name="ikon"
                                    id="ikon"
                                    class="form-select @error('ikon') is-invalid @enderror">

                                <option value="🌱" {{ $programUnggulan->ikon == '🌱' ? 'selected' : '' }}>
                                    🌱 Tani Hasil Siswa
                                </option>

                                <option value="🐄" {{ $programUnggulan->ikon == '🐄' ? 'selected' : '' }}>
                                    🐄 Ternak Hasil Siswa
                                </option>

                                <option value="🏦" {{ $programUnggulan->ikon == '🏦' ? 'selected' : '' }}>
                                    🏦 Bank Ternak Indonesia
                                </option>

                                <option value="👨‍🌾" {{ $programUnggulan->ikon == '👨‍🌾' ? 'selected' : '' }}>
                                    👨‍🌾 Kelompok Tani
                                </option>

                            </select>

                            @error('ikon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- INFO --}}
                    <div class="tips-card">

                        <div class="tips-title">
                            Informasi Program
                        </div>

                        <ul class="tips-list">

                            <li>
                                Dibuat:
                                {{ $programUnggulan->created_at->format('d M Y') }}
                            </li>

                            <li>
                                Jam:
                                {{ $programUnggulan->created_at->format('H:i') }}
                            </li>

                            <li>
                                Update:
                                {{ $programUnggulan->updated_at->diffForHumans() }}
                            </li>

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
                    Update Program

                </button>

            </div>

        </form>

    </div>

</div>

@push('scripts')

<script>

document.getElementById('ikon')
.addEventListener('change', function()
{
    document.getElementById('previewIcon')
    .innerHTML = this.value;
});

document.getElementById('nama_program_unggulan')
.addEventListener('keyup', function()
{
    let nama = this.value;

    let preview = document.getElementById('previewNama');

    if(nama.trim() !== '')
    {
        preview.innerHTML = nama;
    }
    else
    {
        preview.innerHTML =
        'Nama program unggulan akan tampil di sini';
    }
});

</script>

@endpush

@endsection