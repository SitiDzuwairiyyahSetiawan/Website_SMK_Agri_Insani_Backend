@extends('admin.layouts.app')

@section('title', 'Tambah Slider')

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

    /* FIX TEXTAREA */
    textarea.form-control{
        resize:none;
        min-height:260px !important;
        height:260px !important;
        padding-top:18px !important;
        line-height:1.7;
    }

    .form-control:focus,
    textarea:focus{
        border-color:#16a34a !important;
        background:white !important;
        box-shadow:
            0 0 0 4px rgba(22,163,74,.10) !important;
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
        transition:.3s;
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
        font-size:16px;
        font-weight:700;
        color:#6b7280;
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
        cursor:pointer;
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

</style>

{{-- HEADER --}}
<div class="page-header">

    <div>

        <h1 class="page-title">
            Tambah Slider
        </h1>

        <p class="page-subtitle">
            Tambahkan slider baru untuk homepage website sekolah
        </p>

    </div>

</div>

<div class="modern-card">

    <div class="card-body-modern">

        <form action="{{ route('admin.slider.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row g-4">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    <div class="section-title">
                        Informasi Slider
                    </div>

                    {{-- TITLE --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Title Slider
                        </label>

                        <input type="text"
                               name="title"
                               class="form-control"
                               placeholder="Masukkan title slider">

                    </div>

                    {{-- TAG --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Tag Slider
                        </label>

                        <input type="text"
                               name="tag"
                               class="form-control"
                               placeholder="Contoh: Welcome, Education">

                    </div>

                    {{-- DESCRIPTION --}}
                    <div>

                        <label class="form-label">
                            Description
                        </label>

                        <textarea name="description"
                                  class="form-control"
                                  placeholder="Tulis deskripsi slider..."></textarea>

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

                                <div class="upload-placeholder">

                                    <i class="fas fa-image"></i>

                                    <h6>
                                        Belum Ada Gambar
                                    </h6>

                                </div>

                            </div>

                            <div class="custom-file">

                                <label class="custom-file-label">

                                    <i class="fas fa-upload"></i>
                                    Pilih Gambar

                                    <input type="file"
                                           name="image"
                                           id="image"
                                           accept="image/*">

                                </label>

                            </div>

                        </div>

                    </div>

                    {{-- SETTINGS --}}
                    <div class="modern-card mb-4">

                        <div class="card-body-modern">

                            <div class="section-title">
                                Pengaturan
                            </div>

                            <div class="mb-4">

                                <label class="form-label">
                                    Order Slider
                                </label>

                                <input type="number"
                                       name="order"
                                       class="form-control"
                                       value="0">

                            </div>

                            <div class="form-check form-switch">

                                <label class="form-check-label">
                                    Aktifkan Slider
                                </label>

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="is_active"
                                       checked>

                            </div>

                        </div>

                    </div>

                    {{-- TIPS --}}
                    <div class="tips-card">

                        <div class="tips-title">
                            Tips Upload
                        </div>

                        <ul class="tips-list">

                            <li>Gunakan gambar ukuran landscape</li>
                            <li>Resolusi ideal 1920 × 800 px</li>
                            <li>Gunakan title singkat & menarik</li>
                            <li>Pastikan gambar tidak pecah</li>

                        </ul>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-4 mt-4 d-flex gap-3">

                <a href="{{ route('admin.slider.index') }}"
                   class="btn btn-back">

                    Batal

                </a>

                <button type="submit"
                        class="btn btn-save">

                    <i class="fas fa-save me-2"></i>
                    Simpan Slider

                </button>

            </div>

        </form>

    </div>

</div>

@push('scripts')

<script>

document.getElementById('image')
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

</script>

@endpush

@endsection