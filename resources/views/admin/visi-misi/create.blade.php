@extends('admin.layouts.app')

@section('title', 'Tambah Visi & Misi')

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

    .misi-item{
        display:flex;
        gap:12px;
        margin-bottom:14px;
    }

    .misi-item .form-control{
        flex:1;
        height:58px;
    }

    .btn-remove{
        width:58px;
        height:58px;
        border:none;
        border-radius:18px;
        background:#fee2e2;
        color:#dc2626;
        transition:.3s;
        flex-shrink:0;
    }

    .btn-remove:hover{
        background:#fecaca;
        transform:translateY(-2px);
    }

    .btn-add-misi{
        width:100%;
        height:58px;
        border:none;
        border-radius:18px;
        background:linear-gradient(
            135deg,
            #22c55e,
            #15803d
        );
        color:white;
        font-weight:700;
        transition:.3s;
    }

    .btn-add-misi:hover{
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
        line-height:1.6;
    }

    .info-box{
        width:100%;
        min-height:280px;
        border-radius:24px;
        background:linear-gradient(
            135deg,
            #166534,
            #15803d
        );
        padding:30px;
        color:white;
        position:relative;
        overflow:hidden;
    }

    .info-box::before{
        content:'';
        position:absolute;
        width:180px;
        height:180px;
        border-radius:50%;
        background:rgba(255,255,255,.08);
        top:-40px;
        right:-40px;
    }

    .info-box::after{
        content:'';
        position:absolute;
        width:120px;
        height:120px;
        border-radius:50%;
        background:rgba(255,255,255,.06);
        bottom:-30px;
        right:40px;
    }

    .info-icon{
        width:72px;
        height:72px;
        border-radius:22px;
        background:rgba(255,255,255,.12);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:30px;
        margin-bottom:22px;
        backdrop-filter:blur(8px);
    }

    .info-title{
        font-size:22px;
        font-weight:800;
        margin-bottom:10px;
    }

    .info-desc{
        color:rgba(255,255,255,.85);
        line-height:1.7;
        font-size:15px;
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

            {{ $type == 'visi'
                ? 'Tambah Visi'
                : 'Tambah Misi'
            }}

        </h1>

        <p class="page-subtitle">

            {{ $type == 'visi'
                ? 'Tambahkan visi utama sekolah'
                : 'Tambahkan poin-poin misi sekolah'
            }}

        </p>

    </div>

</div>

<div class="modern-card">

    <div class="card-body-modern">

        <form action="{{ route('admin.visi-misi.store') }}"
              method="POST">

            @csrf

            <input type="hidden"
                   name="type"
                   value="{{ $type }}">

            <div class="row g-4">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    <div class="section-title">
                        Informasi {{ ucfirst($type) }}
                    </div>

                    @if($type == 'visi')

                    {{-- VISI --}}
                    <div>

                        <label class="form-label">
                            Konten Visi
                        </label>

                        <textarea name="visi"
                                  class="form-control @error('visi') is-invalid @enderror"
                                  placeholder="Tulis visi sekolah disini...">{{ old('visi') }}</textarea>

                        @error('visi')

                            <div class="invalid-feedback d-block mt-2">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    @else

                    {{-- MISI --}}
                    <div>

                        <label class="form-label">
                            Poin Misi
                        </label>

                        <div id="misi-container">

                            <div class="misi-item">

                                <input type="text"
                                       name="misi[]"
                                       class="form-control"
                                       placeholder="Tulis poin misi..."
                                       required>

                                <button type="button"
                                        class="btn-remove remove-misi"
                                        style="display:none;">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </div>

                        </div>

                        <button type="button"
                                class="btn-add-misi mt-2"
                                id="add-misi">

                            <i class="fas fa-plus me-2"></i>
                            Tambah Poin Misi

                        </button>

                        @error('misi')

                            <div class="text-danger small mt-3">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    @endif

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-4">

                    {{-- INFO --}}
                    <div class="info-box mb-4">

                        <div class="info-icon">

                            @if($type == 'visi')

                                <i class="fas fa-bullseye"></i>

                            @else

                                <i class="fas fa-tasks"></i>

                            @endif

                        </div>

                        <div class="info-title">

                            {{ $type == 'visi'
                                ? 'Visi Sekolah'
                                : 'Misi Sekolah'
                            }}

                        </div>

                        <div class="info-desc">

                            {{ $type == 'visi'
                                ? 'Visi menggambarkan tujuan besar dan arah masa depan sekolah secara inspiratif.'
                                : 'Misi berisi langkah-langkah strategis sekolah untuk mencapai visi yang telah ditetapkan.'
                            }}

                        </div>

                    </div>

                    {{-- TIPS --}}
                    <div class="tips-card">

                        <div class="tips-title">
                            Tips Penulisan
                        </div>

                        <ul class="tips-list">

                            @if($type == 'visi')

                                <li>Gunakan kalimat yang singkat dan jelas</li>
                                <li>Buat visi yang inspiratif</li>
                                <li>Gunakan bahasa yang mudah dipahami</li>
                                <li>Fokus pada tujuan jangka panjang</li>

                            @else

                                <li>Gunakan kata kerja aktif</li>
                                <li>Buat poin yang jelas dan spesifik</li>
                                <li>Setiap misi fokus pada tujuan tertentu</li>
                                <li>Tambahkan poin sesuai kebutuhan sekolah</li>

                            @endif

                        </ul>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-4 mt-4 d-flex gap-3">

                <a href="{{ route('admin.visi-misi.index') }}"
                   class="btn btn-back">

                    Kembali

                </a>

                <button type="submit"
                        class="btn btn-save">

                    <i class="fas fa-save me-2"></i>

                    Simpan

                    {{ ucfirst($type) }}

                </button>

            </div>

        </form>

    </div>

</div>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function() {

    const addButton = document.getElementById('add-misi');

    if(addButton)
    {
        const container = document.getElementById('misi-container');

        addButton.addEventListener('click', function() {

            const newRow = document.createElement('div');

            newRow.className = 'misi-item';

            newRow.innerHTML = `
                <input type="text"
                       name="misi[]"
                       class="form-control"
                       placeholder="Tulis poin misi..."
                       required>

                <button type="button"
                        class="btn-remove remove-misi">

                    <i class="fas fa-trash"></i>

                </button>
            `;

            container.appendChild(newRow);

            updateRemoveButtons();
        });

        container.addEventListener('click', function(e) {

            if(e.target.closest('.remove-misi'))
            {
                const item = e.target.closest('.misi-item');

                if(container.children.length > 1)
                {
                    item.remove();

                    updateRemoveButtons();
                }
            }

        });

        function updateRemoveButtons()
        {
            const buttons = container.querySelectorAll('.remove-misi');

            buttons.forEach(btn => {

                btn.style.display =
                    container.children.length > 1
                    ? 'block'
                    : 'none';

            });
        }

        updateRemoveButtons();
    }

});

</script>

@endpush

@endsection