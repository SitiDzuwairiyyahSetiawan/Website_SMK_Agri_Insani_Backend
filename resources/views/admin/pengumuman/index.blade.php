@extends('admin.layouts.app')

@section('title', 'Manajemen Pengumuman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Manajemen Pengumuman</h2>
        <p class="text-muted">Kelola semua pengumuman, jadwal, dan informasi penting</p>
    </div>
    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle me-2"></i> Tambah Pengumuman
    </a>
</div>

<!-- Statistik Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-3 mb-md-0">
        <div class="card bg-primary text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Total Pengumuman</h6>
                        <h3 class="mb-0">{{ $totalPengumuman ?? 0 }}</h3>
                    </div>
                    <i class="fas fa-bullhorn fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3 mb-md-0">
        <div class="card bg-success text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Dipublikasikan</h6>
                        <h3 class="mb-0">{{ $publishedCount ?? 0 }}</h3>
                    </div>
                    <i class="fas fa-globe fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-secondary text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Draft</h6>
                        <h3 class="mb-0">{{ $draftCount ?? 0 }}</h3>
                    </div>
                    <i class="fas fa-pencil-alt fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filter -->
<div class="card mb-4 shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.pengumuman.index') }}" method="GET" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>

                    <input type="text"
                           name="search"
                           class="form-control border-start-0 ps-0"
                           placeholder="Cari judul pengumuman..."
                           value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                        Dipublikasikan
                    </option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>
                        Draft
                    </option>
                </select>
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Pengumuman -->
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="ps-3">ID</th>
                        <th width="30%">Judul Pengumuman</th>
                        <th width="10%">File</th>
                        <th width="15%">Tanggal</th>
                        <th width="10%">Status</th>
                        <th width="15%">Dibuat</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pengumumans as $key => $item)
                    <tr>
                        <td class="ps-3">
                            {{ $pengumumans->firstItem() + $key }}
                        </td>

                        <td>
                            <div class="fw-bold">
                                {{ Str::limit($item->judul, 50) }}
                            </div>
                        </td>

                        <td>
                            @if($item->file_path)

                                @if($item->file_type == 'image')
                                    <img src="{{ $item->file_url }}"
                                         alt="{{ $item->judul }}"
                                         class="rounded"
                                         width="50"
                                         height="40"
                                         style="object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                         style="width: 50px; height: 40px;">
                                        <i class="fas fa-file-pdf text-danger"></i>
                                    </div>
                                @endif

                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width: 50px; height: 40px;">
                                    <i class="fas fa-file text-muted"></i>
                                </div>
                            @endif
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                        </td>

                        <td>
                            @if($item->is_published)
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i> Published
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="fas fa-clock me-1"></i> Draft
                                </span>
                            @endif
                        </td>

                        <td>
                            <small>
                                {{ $item->created_at->format('d/m/Y H:i') }}
                            </small>
                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <a href="{{ route('admin.pengumuman.show', $item->slug) }}"
                                class="btn btn-info btn-sm action-btn"
                                title="Detail">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a href="{{ route('admin.pengumuman.edit', $item->slug) }}"
                                class="btn btn-warning btn-sm action-btn"
                                title="Edit">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <button type="button"
                                        class="btn btn-danger btn-sm action-btn"
                                        title="Hapus"
                                        onclick="confirmDelete('{{ $item->slug }}', '{{ addslashes($item->judul) }}')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </div>

                            <form id="delete-form-{{ $item->slug }}"
                                action="{{ route('admin.pengumuman.destroy', $item->slug) }}"
                                method="POST"
                                class="d-none">

                                @csrf
                                @method('DELETE')

                            </form>

                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fas fa-bullhorn fa-4x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">Belum ada pengumuman</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pengumumans->hasPages())
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-3 border-top">

            <div class="text-muted small mb-2 mb-md-0">
                <i class="fas fa-chart-line me-1"></i>

                Menampilkan
                {{ $pengumumans->firstItem() ?? 0 }}
                -
                {{ $pengumumans->lastItem() ?? 0 }}

                dari
                {{ $pengumumans->total() ?? 0 }}
                pengumuman
            </div>

            <div>
                {{ $pengumumans->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static">
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
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                </div>

                <p class="text-center">
                    Apakah Anda yakin ingin menghapus pengumuman:
                </p>

                <p class="fw-bold text-danger text-center" id="deleteJudul"></p>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Batal
                </button>

                <button type="button"
                        class="btn btn-danger"
                        id="confirmDeleteBtn">
                    <i class="fas fa-trash-alt me-2"></i> Ya, Hapus!
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let deleteSlug = '';

    function confirmDelete(slug, judul) {
        deleteSlug = slug;
        document.getElementById('deleteJudul').innerHTML = judul;

        let modal = new bootstrap.Modal(
            document.getElementById('deleteModal')
        );

        modal.show();
    }

    document.getElementById('confirmDeleteBtn')
        .addEventListener('click', function () {

        if (deleteSlug) {
            document.getElementById(
                'delete-form-' + deleteSlug
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