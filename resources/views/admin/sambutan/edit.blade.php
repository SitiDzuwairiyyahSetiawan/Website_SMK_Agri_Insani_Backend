@extends('admin.layouts.app')

@section('title', 'Edit Sambutan')

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
        height:320px;
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
        padding:20px;
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
        line-height:1.7;
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

        .upload-preview{
            height:260px;
        }

        textarea.form-control{
            height:260px !important;
            min-height:260px !important;
        }

    }

</style>

{{-- HEADER --}}
<div class="page-header">

    <div>

        <h1 class="page-title">
            Edit Sambutan
        </h1>

        <p class="page-subtitle">
            Perbarui sambutan kepala sekolah website sekolah
        </p>

    </div>

</div>

<div class="modern-card">

    <div class="card-body-modern">

        <form action="{{ route('admin.sambutan.update', $sambutan->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    <div class="section-title">
                        Informasi Sambutan
                    </div>

                    {{-- NAMA --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Nama Kepala Sekolah
                        </label>

                        <input type="text"
                               name="nama_kepala_sekolah"
                               class="form-control @error('nama_kepala_sekolah') is-invalid @enderror"
                               value="{{ old('nama_kepala_sekolah', $sambutan->nama_kepala_sekolah) }}"
                               placeholder="Masukkan nama kepala sekolah">

                        @error('nama_kepala_sekolah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- JABATAN --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Jabatan
                        </label>

                        <input type="text"
                               name="jabatan"
                               class="form-control @error('jabatan') is-invalid @enderror"
                               value="{{ old('jabatan', $sambutan->jabatan) }}"
                               placeholder="Masukkan jabatan">

                        @error('jabatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- PESAN --}}
                    <div>

                        <label class="form-label">
                            Pesan Sambutan
                        </label>

                        <textarea name="pesan"
                                  class="form-control @error('pesan') is-invalid @enderror"
                                  placeholder="Tulis pesan sambutan kepala sekolah...">{{ old('pesan', $sambutan->pesan) }}</textarea>

                        @error('pesan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-4">

                    {{-- FOTO --}}
                    <div class="modern-card mb-4">

                        <div class="card-body-modern">

                            <div class="section-title">
                                Foto Kepala Sekolah
                            </div>

                            <div id="imagePreview"
                                 class="upload-preview mb-4">

                                @if($sambutan->foto)

                                    <img src="{{ asset('storage/' . $sambutan->foto) }}">

                                @else

                                    <div class="upload-placeholder">

                                        <i class="fas fa-user-tie"></i>

                                        <h6>
                                            Belum Ada Foto
                                        </h6>

                                        <p>
                                            Upload foto kepala sekolah terbaik
                                        </p>

                                    </div>

                                @endif

                            </div>

                            <div class="custom-file">

                                <label class="custom-file-label">

                                    <i class="fas fa-upload"></i>
                                    Ganti Foto

                                    <input type="file"
                                           name="foto"
                                           id="foto"
                                           accept="image/*">

                                </label>

                            </div>

                            <small class="text-muted d-block mt-3">
                                Kosongkan jika tidak ingin mengganti foto
                            </small>

                            @error('foto')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- INFORMASI --}}
                    <div class="tips-card">

                        <div class="tips-title">
                            Informasi Sambutan
                        </div>

                        <ul class="tips-list">

                            <li>
                                Dibuat:
                                {{ $sambutan->created_at->format('d M Y') }}
                            </li>

                            <li>
                                Jam:
                                {{ $sambutan->created_at->format('H:i') }}
                            </li>

                            <li>
                                Update:
                                {{ $sambutan->updated_at->diffForHumans() }}
                            </li>

                            <li>
                                Gunakan bahasa formal & mudah dipahami
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-4 mt-4 d-flex gap-3">

                <a href="{{ route('admin.sambutan.index') }}"
                   class="btn btn-back">

                    Batal

                </a>

                <button type="submit"
                        class="btn btn-save">

                    <i class="fas fa-save me-2"></i>
                    Update Sambutan

                </button>

            </div>

        </form>

    </div>

</div>

@push('scripts')

<script>

document.getElementById('foto')
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