@extends('admin.layouts.app')

@section('title', 'Detail Slider')

@section('content')

<style>
    .slider-image{
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 18px;
    }

    .info-table td{
        padding: 10px 0;
        vertical-align: top;
    }

    .copy-btn{
        transition: 0.3s ease;
    }

    .copy-btn:hover{
        background: #198754;
        border-color: #198754;
    }

    .card{
        border-radius: 18px;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-0 fw-bold">
            Detail Slider
        </h2>

        <p class="text-muted">
            Lihat informasi lengkap slider homepage
        </p>
    </div>

    <div>

        <a href="{{ route('admin.slider.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left me-2"></i>
            Kembali

        </a>

    </div>

</div>

<div class="row">

    {{-- KONTEN --}}
    <div class="col-md-8">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body">

                {{-- IMAGE --}}
                <div class="mb-4 text-center">

                    @if($slider->image)

                        <img src="{{ asset('storage/' . $slider->image) }}"
                             alt="{{ $slider->title }}"
                             class="slider-image shadow-sm">

                    @else

                        <div class="bg-light rounded p-5 text-center">

                            <i class="fas fa-images fa-5x text-muted"></i>

                            <p class="text-muted mt-3">
                                Tidak ada gambar slider
                            </p>

                        </div>

                    @endif

                </div>

                {{-- TITLE --}}
                <h1 class="h3 fw-bold mb-3">
                    {{ $slider->title }}
                </h1>

                {{-- META --}}
                <div class="text-muted mb-4">

                    <i class="fas fa-calendar-alt"></i>

                    {{ $slider->created_at->format('d F Y') }}

                    <span class="mx-2">|</span>

                    <i class="fas fa-clock"></i>

                    {{ $slider->created_at->format('H:i') }}

                    <span class="mx-2">|</span>

                    <i class="fas fa-sort-numeric-down"></i>

                    Order:
                    {{ $slider->order }}

                </div>

                {{-- DESCRIPTION --}}
                <div class="border-top pt-4">

                    <h5 class="fw-bold mb-3">
                        Deskripsi Slider
                    </h5>

                    <div style="line-height: 1.9; font-size:15px;">

                        {!! nl2br(e($slider->description ?? 'Tidak ada deskripsi.')) !!}

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- SIDEBAR --}}
    <div class="col-md-4">

        {{-- INFO --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-success text-white">

                <h5 class="mb-0">

                    <i class="fas fa-info-circle me-2"></i>

                    Informasi Slider

                </h5>

            </div>

            <div class="card-body">

                <table class="table table-borderless table-sm info-table">

                    <tr>

                        <td width="40%">
                            <strong>ID</strong>
                        </td>

                        <td>
                            #{{ $slider->id }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Title</strong>
                        </td>

                        <td>
                            {{ $slider->title }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Tag</strong>
                        </td>

                        <td>

                            @if($slider->tag)

                                <span class="badge bg-info text-dark">
                                    {{ $slider->tag }}
                                </span>

                            @else

                                -

                            @endif

                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Order</strong>
                        </td>

                        <td>

                            <span class="badge bg-dark">
                                {{ $slider->order }}
                            </span>

                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Status</strong>
                        </td>

                        <td>

                            @if($slider->is_active)

                                <span class="badge bg-success">

                                    <i class="fas fa-check-circle me-1"></i>

                                    Active

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    <i class="fas fa-times-circle me-1"></i>

                                    Non Active

                                </span>

                            @endif

                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Dibuat</strong>
                        </td>

                        <td>
                            {{ $slider->created_at->format('d/m/Y H:i') }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Diupdate</strong>
                        </td>

                        <td>
                            {{ $slider->updated_at->format('d/m/Y H:i') }}
                        </td>

                    </tr>

                </table>

            </div>

        </div>

        {{-- LINK IMAGE --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-info text-white">

                <h5 class="mb-0">

                    <i class="fas fa-link me-2"></i>

                    Link Gambar

                </h5>

            </div>

            <div class="card-body">

                <div class="input-group">

                    <input type="text"
                           class="form-control"
                           id="imageUrl"
                           value="{{ asset('storage/' . $slider->image) }}"
                           readonly>

                    <button class="btn btn-primary copy-btn"
                            type="button"
                            onclick="copyToClipboard()">

                        <i class="fas fa-copy"></i>

                    </button>

                </div>

                <small class="text-muted mt-2 d-block">

                    Klik tombol copy untuk menyalin link gambar

                </small>

            </div>

        </div>

{{-- MODAL DELETE --}}
<div class="modal fade"
     id="deleteModal"
     tabindex="-1"
     data-bs-backdrop="static">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title">

                    <i class="fas fa-trash-alt me-2"></i>

                    Konfirmasi Hapus

                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center p-4">

                <i class="fas fa-exclamation-triangle text-warning fa-4x mb-3"></i>

                <h5 class="fw-bold">
                    Yakin ingin menghapus slider?
                </h5>

                <p class="fw-bold text-danger">
                    {{ $slider->title }}
                </p>

                <div class="alert alert-warning mt-3 text-start">

                    <i class="fas fa-info-circle me-2"></i>

                    Data slider dan gambar akan dihapus permanen.

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    Batal

                </button>

                <form action="{{ route('admin.slider.destroy', $slider->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger">

                        Ya, Hapus

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@push('scripts')

<script>

function confirmDelete()
{
    let modal = new bootstrap.Modal(
        document.getElementById('deleteModal')
    );

    modal.show();
}

function copyToClipboard()
{
    const copyText = document.getElementById("imageUrl");

    copyText.select();

    copyText.setSelectionRange(0, 99999);

    document.execCommand("copy");

    alert("Link gambar berhasil disalin!");
}

</script>

@endpush

@endsection