@extends('admin.layouts.app')

@section('title', $pengumuman->judul)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Detail Pengumuman</h2>
        <p class="text-muted">Lihat informasi lengkap pengumuman</p>
    </div>
    <div>
        <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Konten Pengumuman -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <!-- File Preview -->
                <div class="mb-4 text-center">
                    @if($pengumuman->file_path)

                        @if($pengumuman->file_type == 'image')
                            <img src="{{ $pengumuman->file_url }}"
                                 alt="{{ $pengumuman->judul }}"
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height: 400px; width: 100%; object-fit: cover;">
                        @else
                            <div class="bg-light rounded p-5 text-center">
                                <i class="fas fa-file-pdf fa-5x text-danger"></i>
                                <p class="text-muted mt-3 mb-0">
                                    File PDF Terlampir
                                </p>

                                <a href="{{ $pengumuman->file_url }}"
                                   target="_blank"
                                   class="btn btn-outline-danger btn-sm mt-3">
                                    <i class="fas fa-download"></i> Download PDF
                                </a>
                            </div>
                        @endif

                    @else
                        <div class="bg-light rounded p-5 text-center">
                            <i class="fas fa-bullhorn fa-5x text-muted"></i>
                            <p class="text-muted mt-2">Tidak ada file lampiran</p>
                        </div>
                    @endif
                </div>

                <!-- Judul -->
                <h1 class="h3 mb-3">{{ $pengumuman->judul }}</h1>

                <!-- Meta -->
                <div class="text-muted mb-4">
                    <i class="fas fa-calendar-alt"></i>
                    {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d F Y') }}

                    <span class="mx-2">|</span>

                    <i class="fas fa-clock"></i>
                    {{ $pengumuman->created_at->format('H:i') }}

                    <span class="mx-2">|</span>

                    <i class="fas fa-tag"></i>
                    Slug: {{ $pengumuman->slug }}
                </div>

                <!-- Isi -->
                <div class="border-top pt-4">
                    <div class="pengumuman-konten">
                        {!! nl2br(e($pengumuman->isi)) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">

        <!-- Informasi -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle"></i> Informasi Pengumuman
                </h5>
            </div>

            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="40%">
                            <strong>Status</strong>
                        </td>
                        <td>
                            @if($pengumuman->is_published)
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Published
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="fas fa-clock"></i> Draft
                                </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Tanggal</strong>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d/m/Y') }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Dibuat</strong>
                        </td>
                        <td>
                            {{ $pengumuman->created_at->format('d/m/Y H:i:s') }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Diupdate</strong>
                        </td>
                        <td>
                            {{ $pengumuman->updated_at->format('d/m/Y H:i:s') }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>ID</strong>
                        </td>
                        <td>
                            #{{ $pengumuman->id }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Link -->
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-link"></i> Link Publikasi
                </h5>
            </div>

            <div class="card-body">
                <div class="input-group">
                    <input type="text"
                           class="form-control"
                           id="publicUrl"
                           value="{{ url('/pengumuman/' . $pengumuman->slug) }}"
                           readonly>

                    <button class="btn btn-primary"
                            onclick="copyToClipboard()"
                            type="button">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>

                <small class="text-muted mt-2 d-block">
                    <i class="fas fa-external-link-alt"></i>
                    Klik tombol copy untuk menyalin link
                </small>
            </div>
        </div>

    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
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
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus pengumuman:</p>

                <p class="fw-bold text-danger">
                    {{ $pengumuman->judul }}
                </p>

                <p class="text-muted small">
                    Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait!
                </p>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Batal
                </button>

                <form action="{{ route('admin.pengumuman.destroy', $pengumuman->slug) }}"
                      method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger">
                        Ya, Hapus!
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete() {
        var modal = new bootstrap.Modal(
            document.getElementById('deleteModal')
        );

        modal.show();
    }

    function copyToClipboard() {
        const urlInput = document.getElementById('publicUrl');

        urlInput.select();
        urlInput.setSelectionRange(0, 99999);

        document.execCommand('copy');

        alert('Link berhasil disalin!');
    }
</script>
@endpush
@endsection