@extends('admin.layouts.app')

@section('title', $ekstrakurikuler->nama_ekstrakurikuler)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-0">Detail Ekstrakurikuler</h2>
        <p class="text-muted">Lihat informasi lengkap ekstrakurikuler</p>
    </div>

    <a href="{{ route('admin.ekstrakurikuler.index') }}"
       class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

</div>

<div class="row">

    <div class="col-md-8">

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <div class="text-center mb-3">
                    <div class="display-1">
                        {{ $ekstrakurikuler->ikon }}
                    </div>
                </div>

                <h1 class="h3 text-center mb-3">
                    {{ $ekstrakurikuler->nama_ekstrakurikuler }}
                </h1>

                <div class="text-muted text-center mb-4">

                    <i class="fas fa-calendar-alt"></i>
                    Dibuat: {{ $ekstrakurikuler->created_at->format('d F Y') }}

                    <span class="mx-2">|</span>

                    <i class="fas fa-clock"></i>
                    {{ $ekstrakurikuler->created_at->format('H:i') }}

                </div>

                <div class="border-top pt-4" style="line-height:1.9;">
                    {!! nl2br(e($ekstrakurikuler->deskripsi)) !!}
                </div>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle"></i> Informasi
                </h5>
            </div>

            <div class="card-body">

                <table class="table table-borderless table-sm">

                    <tr>
                        <td><strong>ID</strong></td>
                        <td>#{{ $ekstrakurikuler->id }}</td>
                    </tr>

                    <tr>
                        <td><strong>Ikon</strong></td>
                        <td class="fs-3">{{ $ekstrakurikuler->ikon }}</td>
                    </tr>

                    <tr>
                        <td><strong>Dibuat</strong></td>
                        <td>{{ $ekstrakurikuler->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>

                    <tr>
                        <td><strong>Update</strong></td>
                        <td>{{ $ekstrakurikuler->updated_at->format('d/m/Y H:i:s') }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-trash"></i> Hapus Data
                </h5>
            </div>

            <div class="modal-body text-center">

                <p>Hapus ekstrakurikuler:</p>

                <h5 class="text-danger">
                    {{ $ekstrakurikuler->nama_ekstrakurikuler }}
                </h5>

                <p class="text-muted small">
                    Tidak dapat dibatalkan
                </p>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Batal
                </button>

                <form action="{{ route('admin.ekstrakurikuler.destroy', $ekstrakurikuler->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">
                        Hapus
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection