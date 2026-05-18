@extends('admin.layouts.app')

@section('title', 'Edit Ekstrakurikuler')

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
    textarea,
    .form-select{
        border-radius:18px !important;
        border:1px solid #e5e7eb !important;
        background:#f9fafb !important;
        padding:16px 18px !important;
        font-size:15px;
        box-shadow:none !important;
    }

    .form-control:focus,
    textarea:focus,
    .form-select:focus{
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

    .preview-box{
        width:100%;
        min-height:280px;
        border-radius:24px;
        border:2px dashed #d1d5db;
        background:#f9fafb;
        display:flex;
        align-items:center;
        justify-content:center;
        overflow:hidden;
        padding:30px;
        text-align:center;
    }

    .preview-content{
        width:100%;
    }

    .preview-icon{
        font-size:90px;
        margin-bottom:18px;
        line-height:1;
    }

    .preview-title{
        font-size:24px;
        font-weight:800;
        color:#111827;
        margin-bottom:10px;
    }

    .preview-subtitle{
        color:#6b7280;
        font-size:14px;
    }

    .form-switch{
        padding-left:0;
        display:flex;
        align-items:center;
        justify-content:space-between;
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

    @media(max-width:768px){

        .page-title{
            font-size:30px;
        }

        .card-body-modern{
            padding:22px;
        }

        .preview-box{
            min-height:220px;
        }

        .preview-icon{
            font-size:70px;
        }

    }

</style>

{{-- HEADER --}}
<div class="page-header">

    <div>

        <h1 class="page-title">
            Edit Ekstrakurikuler
        </h1>

        <p class="page-subtitle">
            Update data ekstrakurikuler sekolah
        </p>

    </div>

</div>

<div class="modern-card">

    <div class="card-body-modern">

        <form action="{{ route('admin.ekstrakurikuler.update', $ekstrakurikuler->id) }}"
              method="POST">

            @csrf
            @method('PUT')

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
                               value="{{ old('nama_ekstrakurikuler', $ekstrakurikuler->nama_ekstrakurikuler) }}"
                               placeholder="Masukkan nama ekstrakurikuler">

                        @error('nama_ekstrakurikuler')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- KATEGORI --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Kategori Ekstrakurikuler
                        </label>

                        <select name="ikon"
                                id="ikon"
                                class="form-select @error('ikon') is-invalid @enderror">

                            <option value="📱"
                                {{ old('ikon', $ekstrakurikuler->ikon) == '📱' ? 'selected' : '' }}>
                                📱 Content Creator
                            </option>

                            <option value="🤖"
                                {{ old('ikon', $ekstrakurikuler->ikon) == '🤖' ? 'selected' : '' }}>
                                🤖 AI & Digital
                            </option>

                            <option value="📊"
                                {{ old('ikon', $ekstrakurikuler->ikon) == '📊' ? 'selected' : '' }}>
                                📊 Sales & Marketing
                            </option>

                            <option value="💡"
                                {{ old('ikon', $ekstrakurikuler->ikon) == '💡' ? 'selected' : '' }}>
                                💡 Kewirausahaan
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
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  id="deskripsi"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Tulis deskripsi ekstrakurikuler...">{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>

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
                                Preview Ekstrakurikuler
                            </div>

                            <div class="preview-box">

                                <div class="preview-content">

                                    <div class="preview-icon"
                                         id="previewIcon">

                                        {{ old('ikon', $ekstrakurikuler->ikon) }}

                                    </div>

                                    <div class="preview-title"
                                         id="previewNama">

                                        {{ old('nama_ekstrakurikuler', $ekstrakurikuler->nama_ekstrakurikuler) }}

                                    </div>

                                    <div class="preview-subtitle">
                                        Preview tampilan ekstrakurikuler
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- INFO --}}
                    <div class="tips-card">

                        <div class="tips-title">
                            Informasi Ekstrakurikuler
                        </div>

                        <ul class="tips-list">

                            <li>
                                Dibuat:
                                {{ $ekstrakurikuler->created_at->format('d M Y') }}
                            </li>

                            <li>
                                Jam:
                                {{ $ekstrakurikuler->created_at->format('H:i') }}
                            </li>

                            <li>
                                Update:
                                {{ $ekstrakurikuler->updated_at->diffForHumans() }}
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-4 mt-4 d-flex gap-3">

                <a href="{{ route('admin.ekstrakurikuler.index') }}"
                   class="btn btn-back">

                    Kembali

                </a>

                <button type="submit"
                        class="btn btn-save">

                    <i class="fas fa-save me-2"></i>
                    Update Ekstrakurikuler

                </button>

            </div>

        </form>

    </div>

</div>

@push('scripts')

<script>

// preview nama
document.getElementById('nama_ekstrakurikuler')
.addEventListener('keyup', function ()
{
    let nama = this.value;

    if(nama)
    {
        document.getElementById('previewNama')
        .innerHTML = nama;
    }
    else
    {
        document.getElementById('previewNama')
        .innerHTML = 'Nama Ekstrakurikuler';
    }
});

// preview ikon
document.getElementById('ikon')
.addEventListener('change', function ()
{
    document.getElementById('previewIcon')
    .innerHTML = this.value;
});

</script>

@endpush

@endsection