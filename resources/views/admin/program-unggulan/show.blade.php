@extends('admin.layouts.app')

@section('title', $programUnggulan->nama_program_unggulan)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-0">Detail Program Unggulan</h2>
        <p class="text-muted">
            Lihat informasi lengkap program unggulan
        </p>
    </div>

    <div>
        <a href="{{ route('admin.program-unggulan.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i> Kembali

        </a>

    </div>

</div>

<div class="row">

    <div class="col-md-8">

        <!-- Konten Program -->
        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <!-- Ikon -->
                <div class="text-center mb-3">

                    <div class="display-1">
                        {{ $programUnggulan->ikon }}
                    </div>

                </div>

                <!-- Nama Program -->
                <h1 class="h3 mb-3 text-center">

                    {{ $programUnggulan->nama_program_unggulan }}

                </h1>

                <!-- Info -->
                <div class="text-muted mb-4 text-center">

                    <i class="fas fa-calendar-alt"></i>

                    Dibuat:
                    {{ $programUnggulan->created_at->format('d F Y') }}

                    <span class="mx-2">|</span>

                    <i class="fas fa-clock"></i>

                    {{ $programUnggulan->created_at->format('H:i') }}

                </div>

                <!-- Deskripsi -->
                <div class="border-top pt-4">

                    <div style="line-height: 1.9;">

                        {!! nl2br(e($programUnggulan->deskripsi)) !!}

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

                    <i class="fas fa-info-circle"></i>
                    Informasi Program

                </h5>

            </div>

            <div class="card-body">

                <table class="table table-sm table-borderless">

                    <tr>

                        <td width="40%">
                            <strong>ID</strong>
                        </td>

                        <td>
                            #{{ $programUnggulan->id }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Ikon</strong>
                        </td>

                        <td class="fs-4">
                            {{ $programUnggulan->ikon }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Dibuat</strong>
                        </td>

                        <td>
                            {{ $programUnggulan->created_at->format('d/m/Y H:i:s') }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Diupdate</strong>
                        </td>

                        <td>
                            {{ $programUnggulan->updated_at->format('d/m/Y H:i:s') }}
                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- Modal Delete -->
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

                <p>
                    Apakah Anda yakin ingin menghapus program unggulan:
                </p>

                <p class="fw-bold text-danger">

                    {{ $programUnggulan->nama_program_unggulan }}

                </p>

                <p class="text-muted small">

                    Tindakan ini tidak dapat dibatalkan.

                </p>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    Batal

                </button>

                <form action="{{ route('admin.program-unggulan.destroy', $programUnggulan->id) }}"
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

    function confirmDelete(){

        let modal = new bootstrap.Modal(
            document.getElementById('deleteModal')
        );

        modal.show();

    }

</script>

@endpush

@endsection