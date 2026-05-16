@extends('admin.layouts.app')

@section('title', 'Detail Galeri')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Detail Galeri</h2>
        <p class="text-muted">Lihat informasi lengkap foto galeri</p>
    </div>

    <div>
        <a href="{{ route('admin.galeri.index') }}"
           class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>
</div>

<div class="row">

    <!-- FOTO & DESKRIPSI -->
    <div class="col-md-8">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body">

                <div class="mb-4 text-center">

                    @if($galeri->gambar)

                        <img src="{{ asset('storage/' . $galeri->gambar) }}"
                             alt="{{ $galeri->judul }}"
                             class="img-fluid rounded shadow-sm"
                             style="max-height: 500px; width:100%; object-fit: cover;">

                    @else

                        <div class="bg-light rounded p-5 text-center">
                            <i class="fas fa-image fa-5x text-muted"></i>
                            <p class="text-muted mt-3">
                                Tidak ada gambar
                            </p>
                        </div>

                    @endif

                </div>

                <h1 class="h3 mb-3 fw-bold">
                    {{ $galeri->judul }}
                </h1>

                <div class="text-muted mb-4">

                    <i class="fas fa-calendar-alt"></i>
                    {{ $galeri->created_at->format('d F Y') }}

                    <span class="mx-2">|</span>

                    <i class="fas fa-clock"></i>
                    {{ $galeri->created_at->format('H:i') }}

                </div>

                <div class="border-top pt-4">

                    <div style="line-height: 1.9; font-size:15px;">
                        {!! nl2br(e($galeri->deskripsi ?? 'Tidak ada deskripsi.')) !!}
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- SIDEBAR -->
    <div class="col-md-4">

        <!-- INFO -->
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle"></i>
                    Informasi Foto
                </h5>
            </div>

            <div class="card-body">

                <table class="table table-sm table-borderless">

                    <tr>
                        <td width="40%">
                            <strong>ID</strong>
                        </td>

                        <td>
                            #{{ $galeri->id }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Judul</strong>
                        </td>

                        <td>
                            {{ $galeri->judul }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Dibuat</strong>
                        </td>

                        <td>
                            {{ $galeri->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Diupdate</strong>
                        </td>

                        <td>
                            {{ $galeri->updated_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>

                </table>

            </div>

        </div>

        <!-- LINK FOTO -->
        <div class="card shadow-sm border-0">

            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-link"></i>
                    Link Foto
                </h5>
            </div>

            <div class="card-body">

                <div class="input-group">

                    <input type="text"
                           class="form-control"
                           id="fotoUrl"
                           value="{{ asset('storage/' . $galeri->gambar) }}"
                           readonly>

                    <button class="btn btn-primary"
                            type="button"
                            onclick="copyToClipboard()">

                        <i class="fas fa-copy"></i>

                    </button>

                </div>

                <small class="text-muted mt-2 d-block">
                    Klik tombol copy untuk menyalin link foto
                </small>

            </div>

        </div>

    </div>

</div>

<!-- MODAL DELETE -->
<div class="modal fade"
     id="deleteModal"
     tabindex="-1"
     data-bs-backdrop="static">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

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

            <div class="modal-body">

                <p>Apakah Anda yakin ingin menghapus foto:</p>

                <p class="fw-bold text-danger">
                    {{ $galeri->judul }}
                </p>

                <p class="text-muted small">
                    Tindakan ini tidak dapat dibatalkan!
                </p>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Batal
                </button>

                <form action="{{ route('admin.galeri.destroy', $galeri->id) }}"
                      method="POST"
                      class="d-inline">

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
    const copyText = document.getElementById("fotoUrl");

    copyText.select();
    copyText.setSelectionRange(0, 99999);

    document.execCommand("copy");

    alert("Link foto berhasil disalin!");
}

</script>

@endpush

@endsection