@extends('admin.layouts.app')

@section('title', 'Manajemen Berita')

@section('content')

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Manajemen Berita</h2>
        <p class="text-muted">Kelola semua berita dan informasi terbaru sekolah</p>
    </div>

    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle me-2"></i> Tambah Berita
    </a>
</div>

<!-- STATISTIK -->
<div class="row mb-4">

    <div class="col-md-4 mb-3 mb-md-0">
        <div class="card bg-primary text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1">Total Berita</h6>
                        <h3 class="mb-0">{{ $totalBerita ?? 0 }}</h3>
                    </div>
                    <i class="fas fa-newspaper fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3 mb-md-0">
        <div class="card bg-success text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1">Dipublikasikan</h6>
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
                        <h6 class="text-white-50 mb-1">Draft</h6>
                        <h3 class="mb-0">{{ $draftCount ?? 0 }}</h3>
                    </div>
                    <i class="fas fa-pencil-alt fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- SEARCH -->
<div class="card mb-4 shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.berita.index') }}" method="GET" class="row g-3">

            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>

                    <input type="text"
                           name="search"
                           class="form-control border-start-0 ps-0"
                           placeholder="Cari judul berita..."
                           value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary w-100">
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
                        <th class="ps-3">ID</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($beritas as $key => $item)

                    <tr>

                        <td class="ps-3">
                            {{ $beritas->firstItem() + $key }}
                        </td>

                        <td class="fw-bold">
                            {{ \Illuminate\Support\Str::limit($item->judul, 50) }}
                        </td>

                        <td>
                            @if($item->gambar)
                                <img src="{{ asset('storage/'.$item->gambar) }}"
                                     width="50"
                                     height="40"
                                     class="rounded"
                                     style="object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width:50px;height:40px;">
                                    <i class="fas fa-image text-muted"></i>
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
                            <small>{{ $item->created_at->format('d/m/Y H:i') }}</small>
                        </td>

                        <td>
                            <div class="d-flex gap-2">

                                <a href="{{ route('admin.berita.show', $item->slug) }}"
                                   class="btn btn-info btn-sm action-btn">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.berita.edit', $item->slug) }}"
                                   class="btn btn-warning btn-sm action-btn">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button class="btn btn-danger btn-sm action-btn"
                                        onclick="confirmDelete('{{ $item->slug }}','{{ addslashes($item->judul) }}')">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </div>

                            <form id="delete-form-{{ $item->slug }}"
                                  action="{{ route('admin.berita.destroy', $item->slug) }}"
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fas fa-newspaper fa-4x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">Belum ada berita</h5>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        <!-- PAGINATION -->
        @if($beritas->hasPages())
        <div class="p-3 border-top d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Menampilkan {{ $beritas->firstItem() }} - {{ $beritas->lastItem() }}
            </small>

            {{ $beritas->links() }}
        </div>
        @endif

    </div>
</div>

<!-- MODAL DELETE -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <p>Yakin hapus:</p>
                <h5 class="text-danger" id="deleteJudul"></h5>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let deleteSlug = '';

function confirmDelete(slug, judul){
    deleteSlug = slug;
    document.getElementById('deleteJudul').innerText = judul;

    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    if(deleteSlug){
        document.getElementById('delete-form-' + deleteSlug).submit();
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