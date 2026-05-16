@extends('admin.layouts.app')

@section('title', 'Manajemen Ekstrakurikuler')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-0">Manajemen Ekstrakurikuler</h2>
        <p class="text-muted">
            Kelola semua ekstrakurikuler sekolah
        </p>
    </div>

    <a href="{{ route('admin.ekstrakurikuler.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus-circle me-2"></i>
        Tambah Ekstrakurikuler
    </a>

</div>

<!-- STATISTIK -->
<div class="row mb-4">

    <div class="col-md-4 mb-3">

        <div class="card bg-primary text-white border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-white-50 mb-1">Total Ekstrakurikuler</h6>
                        <h3 class="mb-0">{{ $totalEkstrakurikuler }}</h3>
                    </div>

                    <i class="fas fa-school fa-3x opacity-50"></i>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- SEARCH -->
<div class="card mb-4 shadow-sm border-0">

    <div class="card-body">

        <form method="GET"
              action="{{ route('admin.ekstrakurikuler.index') }}"
              class="row g-3">

            <div class="col-md-9">

                <div class="input-group">

                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>

                    <input type="text"
                           name="search"
                           class="form-control border-start-0"
                           placeholder="Cari ekstrakurikuler..."
                           value="{{ request('search') }}">

                </div>

            </div>

            <div class="col-md-3">

                <button class="btn btn-success w-100">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>

            </div>

        </form>

    </div>

</div>

<!-- TABLE -->
<div class="card shadow-sm border-0">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-striped mb-0">

                <thead class="table-light">

                    <tr>
                        <th width="5%" class="ps-3">ID</th>
                        <th width="10%">Ikon</th>
                        <th width="20%">Nama Ekstrakurikuler</th>
                        <th width="35%">Deskripsi</th>
                        <th width="10%">Dibuat</th>
                        <th width="10%" class="text-center">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($ekstrakurikulers as $key => $item)

                    <tr>

                        <td class="ps-3">
                            {{ $ekstrakurikulers->firstItem() + $key }}
                        </td>

                        <td class="fs-3">
                            {{ $item->ikon ?? '-' }}
                        </td>

                        <td>
                            <strong>{{ $item->nama_ekstrakurikuler }}</strong>
                        </td>

                        <td>
                            {{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}
                        </td>

                        <td>
                            <small>{{ $item->created_at->format('d/m/Y') }}</small>
                        </td>

                        <td class="text-center">

                            <div class="d-flex gap-2 justify-content-center">

                                <a href="{{ route('admin.ekstrakurikuler.show', $item->id) }}"
                                class="btn btn-info btn-sm action-btn">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a href="{{ route('admin.ekstrakurikuler.edit', $item->id) }}"
                                class="btn btn-warning btn-sm action-btn">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <button type="button"
                                        class="btn btn-danger btn-sm action-btn"
                                        onclick="confirmDelete('{{ $item->id }}','{{ $item->nama_ekstrakurikuler }}')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </div>

                            <form id="delete-form-{{ $item->id }}"
                                  action="{{ route('admin.ekstrakurikuler.destroy', $item->id) }}"
                                  method="POST"
                                  class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-school fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada ekstrakurikuler</h5>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL DELETE (SAMA PERSIS) -->
<div class="modal fade" id="deleteModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title">
                    <i class="fas fa-trash-alt me-2"></i> Konfirmasi Hapus
                </h5>

                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body text-center">

                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>

                <p>Apakah yakin ingin menghapus:</p>

                <p class="fw-bold text-danger" id="deleteNama"></p>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Batal
                </button>

                <button class="btn btn-danger" id="confirmDeleteBtn">
                    Ya, Hapus!
                </button>

            </div>

        </div>

    </div>

</div>

@push('scripts')
<script>
let deleteId = '';

function confirmDelete(id, nama){
    deleteId = id;
    document.getElementById('deleteNama').innerText = nama;

    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function(){
    document.getElementById('delete-form-' + deleteId).submit();
});
</script>

<style>

.custom-btn{
    border-radius: 12px;
    padding: 10px 20px;
    font-weight: 600;
    transition: all .25s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,.15);
}

.custom-btn:hover{
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0,0,0,.25) !important;
}

.action-btn{
    border-radius: 8px !important;
    transition: all .2s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,.12);
}

.action-btn:hover{
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,.18);
}

</style>
@endpush

@endsection