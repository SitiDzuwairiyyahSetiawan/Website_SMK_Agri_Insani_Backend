@extends('admin.layouts.app')

@section('title', 'Detail Visi & Misi')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-0">
            Detail {{ $visiMisi->type == 'visi' ? 'Visi' : 'Misi' }}
        </h2>

        <p class="text-muted">
            Lihat informasi lengkap data visi & misi
        </p>

    </div>

    <div>

        <a href="{{ route('admin.visi-misi.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>
            Kembali

        </a>

    </div>

</div>

<div class="row">

    <div class="col-md-8">

        <!-- Konten -->
        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <!-- Icon Header -->
                <div class="mb-4 text-center">

                    @if($visiMisi->type == 'visi')

                        <div class="bg-primary bg-opacity-10 rounded p-5">

                            <i class="fas fa-bullseye fa-5x text-primary"></i>

                            <h4 class="mt-3 text-primary mb-0">
                                VISI SEKOLAH
                            </h4>

                        </div>

                    @else

                        <div class="bg-success bg-opacity-10 rounded p-5">

                            <i class="fas fa-tasks fa-5x text-success"></i>

                            <h4 class="mt-3 text-success mb-0">
                                MISI SEKOLAH
                            </h4>

                        </div>

                    @endif

                </div>

                <!-- Judul -->
                <h1 class="h3 mb-3">

                    {{ $visiMisi->type == 'visi'
                        ? 'Visi Sekolah'
                        : 'Poin Misi Sekolah'
                    }}

                </h1>

                <!-- Info -->
                <div class="text-muted mb-4">

                    <i class="fas fa-clock"></i>

                    Dibuat:
                    {{ $visiMisi->created_at->format('d F Y H:i') }}

                    <span class="mx-2">|</span>

                    <i class="fas fa-edit"></i>

                    Diupdate:
                    {{ $visiMisi->updated_at->format('d F Y H:i') }}

                </div>

                <!-- Konten -->
                <div class="border-top pt-4">

                    <div class="visi-misi-konten">

                        @if($visiMisi->type == 'visi')

                            {!! nl2br(e($visiMisi->visi)) !!}

                        @else

                            <div class="d-flex align-items-start">

                                <span class="badge bg-success me-3 mt-1">
                                    <i class="fas fa-check"></i>
                                </span>

                                <div>
                                    {!! nl2br(e($visiMisi->misi)) !!}
                                </div>

                            </div>

                        @endif

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

                    Informasi Data

                </h5>

            </div>

            <div class="card-body">

                <table class="table table-sm table-borderless">

                    <tr>

                        <td width="40%">
                            <strong>ID</strong>
                        </td>

                        <td>
                            #{{ $visiMisi->id }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Tipe</strong>
                        </td>

                        <td>

                            @if($visiMisi->type == 'visi')

                                <span class="badge bg-primary">
                                    Visi
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Misi
                                </span>

                            @endif

                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Dibuat</strong>
                        </td>

                        <td>
                            {{ $visiMisi->created_at->format('d/m/Y H:i:s') }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            <strong>Diupdate</strong>
                        </td>

                        <td>
                            {{ $visiMisi->updated_at->format('d/m/Y H:i:s') }}
                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- Modal Hapus -->
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

                <p>
                    Apakah Anda yakin ingin menghapus data ini?
                </p>

                <p class="fw-bold text-danger">

                    ID #{{ $visiMisi->id }}

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

                <form action="{{ route('admin.visi-misi.destroy', $visiMisi->id) }}"
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

@endsection