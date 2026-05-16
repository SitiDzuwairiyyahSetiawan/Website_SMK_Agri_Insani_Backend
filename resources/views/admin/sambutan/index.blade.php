@extends('admin.layouts.app')

@section('title', 'Manajemen Sambutan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Manajemen Sambutan</h2>
        <p class="text-muted">Kelola semua sambutan kepala sekolah</p>
    </div>

    <a href="{{ route('admin.sambutan.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle me-2"></i> Tambah Sambutan
    </a>
</div>

<!-- Statistik Cards -->
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="card bg-primary text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Total Sambutan</h6>
                        <h3 class="mb-0">{{ $sambutans->count() }}</h3>
                    </div>
                    <i class="fas fa-comments fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card bg-success text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Terakhir Ditambahkan</h6>
                        <h3 class="mb-0">
                            {{ $sambutans->count() ? $sambutans->first()->created_at->format('d/m') : '-' }}
                        </h3>
                    </div>
                    <i class="fas fa-calendar-alt fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search -->
<div class="card mb-4 shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.sambutan.index') }}" method="GET" class="row g-3">
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>

                    <input type="text"
                           name="search"
                           class="form-control border-start-0 ps-0"
                           placeholder="Cari nama kepala sekolah..."
                           value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Sambutan -->
<div class="card shadow-sm border-0">
    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-striped mb-0">

                <thead class="table-light">
                    <tr>
                        <th width="5%" class="ps-3">ID</th>
                        <th width="30%">Nama Kepala Sekolah</th>
                        <th width="10%">Foto</th>
                        <th width="20%">Jabatan</th>
                        <th width="15%">Dibuat</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($sambutans as $key => $item)

                    <tr>

                        <td class="ps-3">
                            {{ $key + 1 }}
                        </td>

                        <td>
                            <div class="fw-bold">
                                {{ $item->nama_kepala_sekolah }}
                            </div>
                        </td>

                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                     alt="{{ $item->nama_kepala_sekolah }}"
                                     class="rounded"
                                     width="50"
                                     height="40"
                                     style="object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width: 50px; height: 40px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>

                        <td>
                            {{ $item->jabatan }}
                        </td>

                        <td>
                            <small>
                                {{ $item->created_at->format('d/m/Y H:i') }}
                            </small>
                        </td>

                        <td>
                            <div class="d-flex gap-2">

                                <a href="{{ route('admin.sambutan.show', $item->id) }}"
                                class="btn btn-info btn-sm action-btn">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a href="{{ route('admin.sambutan.edit', $item->id) }}"
                                class="btn btn-warning btn-sm action-btn">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <button type="button"
                                        class="btn btn-danger btn-sm action-btn"
                                        title="Hapus"
                                        onclick="confirmDelete('{{ $item->id }}', '{{ addslashes($item->nama_kepala_sekolah) }}')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </div>

                            <form id="delete-form-{{ $item->id }}"
                                  action="{{ route('admin.sambutan.destroy', $item->id) }}"
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
                            <i class="fas fa-comments fa-4x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">Belum ada data sambutan</h5>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-trash-alt me-2"></i> Konfirmasi Hapus
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                </div>

                <p class="text-center">
                    Apakah Anda yakin ingin menghapus sambutan:
                </p>

                <p class="fw-bold text-danger text-center" id="deleteNama"></p>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Batal
                </button>

                <button type="button"
                        class="btn btn-danger"
                        id="confirmDeleteBtn">
                    Ya, Hapus!
                </button>

            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>

    let deleteId = '';

    function confirmDelete(id, nama)
    {
        deleteId = id;

        document.getElementById('deleteNama').innerHTML = nama;

        let modal = new bootstrap.Modal(
            document.getElementById('deleteModal')
        );

        modal.show();
    }

    document.getElementById('confirmDeleteBtn')
        .addEventListener('click', function () {

            if (deleteId)
            {
                document.getElementById(
                    'delete-form-' + deleteId
                ).submit();
            }

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