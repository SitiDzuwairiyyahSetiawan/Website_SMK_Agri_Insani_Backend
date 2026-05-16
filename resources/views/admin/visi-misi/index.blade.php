@extends('admin.layouts.app')

@section('title', 'Manajemen Visi & Misi')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-0">Manajemen Visi & Misi</h2>

        <p class="text-muted">
            Kelola semua catatan visi dan misi sekolah
        </p>
    </div>

    <div>

        <a href="{{ route('admin.visi-misi.create', 'visi') }}"
           class="btn btn-primary me-2 custom-btn">

            <i class="fas fa-plus-circle me-2"></i>
            Tambah Visi

        </a>

        <a href="{{ route('admin.visi-misi.create', 'misi') }}"
           class="btn btn-success custom-btn">

            <i class="fas fa-plus-circle me-2"></i>
            Tambah Misi

        </a>

    </div>

</div>

<!-- Statistik -->
<div class="row mb-4">

    <!-- TOTAL VISI -->
    <div class="col-md-4 mb-3">

        <div class="card bg-primary text-white border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="card-title text-white-50 mb-1">
                            Total Visi
                        </h6>

                        <h3 class="mb-0">
                            {{ $totalVisi ?? 0 }}
                        </h3>

                    </div>

                    <i class="fas fa-bullseye fa-3x opacity-50"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- TOTAL MISI -->
    <div class="col-md-4 mb-3">

        <div class="card bg-success text-white border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="card-title text-white-50 mb-1">
                            Total Misi
                        </h6>

                        <h3 class="mb-0">
                            {{ $totalMisi ?? 0 }}
                        </h3>

                    </div>

                    <i class="fas fa-tasks fa-3x opacity-50"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- TERAKHIR DITAMBAHKAN -->
    <div class="col-md-4 mb-3">

        <div class="card bg-warning text-white border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="card-title text-white-50 mb-1">
                            Terakhir Ditambahkan
                        </h6>

                        <h3 class="mb-0">
                            {{ $visimisis->first()?->created_at->format('d/m') ?? '-' }}
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

        <form action="{{ route('admin.visi-misi.index') }}"
              method="GET"
              class="row g-3">

            <div class="col-md-9">

                <div class="input-group">

                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>

                    <input type="text"
                           name="search"
                           class="form-control border-start-0 ps-0"
                           placeholder="Cari visi atau misi..."
                           value="{{ request('search') }}">

                </div>

            </div>

            <div class="col-md-3">

                <button type="submit"
                        class="btn btn-primary w-100">

                    <i class="fas fa-filter me-2"></i>
                    Filter

                </button>

            </div>

        </form>

    </div>

</div>

<!-- Table -->
<div class="card shadow-sm border-0">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-striped mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="5%" class="ps-3">
                            ID
                        </th>

                        <th width="15%">
                            Tipe
                        </th>

                        <th width="45%">
                            Konten
                        </th>

                        <th width="15%">
                            Dibuat
                        </th>

                        <th width="20%">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($visimisis as $item)

                    <tr>

                        <td class="ps-3">
                            {{ $item->id }}
                        </td>

                        <td>

                            @if($item->type == 'visi')

                                <span class="badge bg-primary px-3 py-2">

                                    <i class="fas fa-bullseye me-1"></i>
                                    Visi

                                </span>

                            @else

                                <span class="badge bg-success px-3 py-2">

                                    <i class="fas fa-tasks me-1"></i>
                                    Misi

                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="fw-bold">

                                {{ Str::limit(strip_tags($item->type == 'visi' ? $item->visi : $item->misi), 100) }}

                            </div>

                        </td>

                        <td>

                            <small>
                                {{ $item->created_at->format('d/m/Y H:i') }}
                            </small>

                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <a href="{{ route('admin.visi-misi.show', $item->id) }}"
                                class="btn btn-info btn-sm action-btn">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a href="{{ route('admin.visi-misi.edit', $item->id) }}"
                                class="btn btn-warning btn-sm action-btn">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <button type="button"
                                        class="btn btn-danger btn-sm action-btn"
                                        onclick='confirmDelete(
                                            "{{ $item->id }}",
                                            {!! json_encode(Str::limit(strip_tags($item->type == "visi" ? $item->visi : $item->misi), 50)) !!}
                                        )'>

                                    <i class="fas fa-trash"></i>

                                </button>

                            </div>

                            <form id="delete-form-{{ $item->id }}"
                                  action="{{ route('admin.visi-misi.destroy', $item->id) }}"
                                  method="POST"
                                  class="d-none">

                                @csrf
                                @method('DELETE')

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center py-5">

                            <i class="fas fa-bullseye fa-4x text-muted mb-3 d-block"></i>

                            <h5 class="text-muted">
                                Belum ada data visi atau misi
                            </h5>

                            <p class="text-muted">
                                Silakan tambah data baru
                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        @if($visimisis->hasPages())

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-3 border-top">

            <div class="text-muted small mb-2 mb-md-0">

                <i class="fas fa-chart-line me-1"></i>

                Menampilkan
                {{ $visimisis->firstItem() ?? 0 }}
                -
                {{ $visimisis->lastItem() ?? 0 }}

                dari

                {{ $visimisis->total() ?? 0 }}
                data

            </div>

            <div>
                {{ $visimisis->appends(request()->query())->links() }}
            </div>

        </div>

        @endif

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
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="text-center mb-3">

                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>

                </div>

                <p class="text-center">
                    Apakah Anda yakin ingin menghapus data:
                </p>

                <p class="fw-bold text-danger text-center"
                   id="deleteJudul"></p>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    <i class="fas fa-times me-2"></i>
                    Batal

                </button>

                <button type="button"
                        class="btn btn-danger"
                        id="confirmDeleteBtn">

                    <i class="fas fa-trash-alt me-2"></i>
                    Ya, Hapus!

                </button>

            </div>

        </div>

    </div>

</div>

@push('scripts')

<script>

    let deleteId = '';

    function confirmDelete(id, konten)
    {
        deleteId = id;

        document.getElementById('deleteJudul').innerHTML = konten;

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