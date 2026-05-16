@extends('admin.layouts.app')

@section('title', 'Detail Sambutan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Detail Sambutan</h2>
        <p class="text-muted">Lihat informasi lengkap sambutan kepala sekolah</p>
    </div>

    <div>
        <a href="{{ route('admin.sambutan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">

    <div class="col-md-8">

        <!-- Konten -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <div class="mb-4 text-center">

                    @if($sambutan->foto)

                        <img src="{{ asset('storage/' . $sambutan->foto) }}"
                             alt="{{ $sambutan->nama_kepala_sekolah }}"
                             class="img-fluid rounded shadow-sm"
                             style="max-height: 400px; width: 100%; object-fit: cover;">

                    @else

                        <div class="bg-light rounded p-5 text-center">
                            <i class="fas fa-user-tie fa-5x text-muted"></i>
                            <p class="text-muted mt-2">Tidak ada foto</p>
                        </div>

                    @endif

                </div>

                <h1 class="h3 mb-2">
                    {{ $sambutan->nama_kepala_sekolah }}
                </h1>

                <div class="text-muted mb-4">

                    <i class="fas fa-user-tie"></i>
                    {{ $sambutan->jabatan }}

                    <span class="mx-2">|</span>

                    <i class="fas fa-clock"></i>
                    {{ $sambutan->created_at->format('d F Y H:i') }}

                </div>

                <div class="border-top pt-4">

                    <div class="sambutan-content">
                        {!! nl2br(e($sambutan->pesan)) !!}
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
                    Informasi Sambutan
                </h5>
            </div>

            <div class="card-body">

                <table class="table table-sm table-borderless">

                    <tr>
                        <td width="40%">
                            <strong>ID</strong>
                        </td>
                        <td>#{{ $sambutan->id }}</td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Nama</strong>
                        </td>
                        <td>{{ $sambutan->nama_kepala_sekolah }}</td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Jabatan</strong>
                        </td>
                        <td>{{ $sambutan->jabatan }}</td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Dibuat</strong>
                        </td>
                        <td>
                            {{ $sambutan->created_at->format('d/m/Y H:i:s') }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Diupdate</strong>
                        </td>
                        <td>
                            {{ $sambutan->updated_at->format('d/m/Y H:i:s') }}
                        </td>
                    </tr>

                </table>

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
                    Apakah Anda yakin ingin menghapus sambutan:
                </p>

                <p class="fw-bold text-danger">
                    {{ $sambutan->nama_kepala_sekolah }}
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

                <form action="{{ route('admin.sambutan.destroy', $sambutan->id) }}"
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

        let modal = new bootstrap.Modal(
            document.getElementById('deleteModal')
        );

        modal.show();
    }

</script>
@endpush
@endsection