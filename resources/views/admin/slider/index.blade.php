@extends('admin.layouts.app')

@section('title', 'Manajemen Slider')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Manajemen Slider</h2>
        <p class="text-muted">
            Kelola semua slider homepage website
        </p>
    </div>

    <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle me-2"></i>
        Tambah Slider
    </a>
</div>

<!-- Statistik Cards -->
<div class="row mb-4">

    <div class="col-md-4 mb-3 mb-md-0">
        <div class="card bg-primary text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="card-title text-white-50 mb-1">
                            Total Slider
                        </h6>

                        <h3 class="mb-0">
                            {{ $sliders->count() }}
                        </h3>
                    </div>

                    <i class="fas fa-images fa-3x opacity-50"></i>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3 mb-md-0">
        <div class="card bg-success text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="card-title text-white-50 mb-1">
                            Active
                        </h6>

                        <h3 class="mb-0">
                            {{ $sliders->where('is_active', true)->count() }}
                        </h3>
                    </div>

                    <i class="fas fa-check-circle fa-3x opacity-50"></i>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-secondary text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="card-title text-white-50 mb-1">
                            Non Active
                        </h6>

                        <h3 class="mb-0">
                            {{ $sliders->where('is_active', false)->count() }}
                        </h3>
                    </div>

                    <i class="fas fa-times-circle fa-3x opacity-50"></i>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Search -->
<div class="card mb-4 shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.slider.index') }}"
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
                           placeholder="Cari title slider..."
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

<!-- Tabel Slider -->
<div class="card shadow-sm border-0">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-striped mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="5%" class="ps-3">ID</th>

                        <th width="25%">Slider</th>

                        <th width="10%">Image</th>

                        <th width="12%">Tag</th>

                        <th width="8%">Order</th>

                        <th width="10%">Status</th>

                        <th width="15%">Dibuat</th>

                        <th width="15%">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($sliders as $key => $slider)

                    <tr>

                        <!-- ID -->
                        <td class="ps-3">

                            @if(method_exists($sliders, 'firstItem'))
                                {{ $sliders->firstItem() + $key }}
                            @else
                                {{ $key + 1 }}
                            @endif

                        </td>

                        <!-- Title -->
                        <td>

                            <div class="fw-bold">
                                {{ Str::limit($slider->title, 45) }}
                            </div>

                        </td>

                        <!-- Image -->
                        <td>

                            @if($slider->image)

                                <img src="{{ asset('storage/' . $slider->image) }}"
                                     alt="{{ $slider->title }}"
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

                        <!-- Tag -->
                        <td>

                            @if($slider->tag)

                                <span class="badge bg-info text-dark">
                                    {{ $slider->tag }}
                                </span>

                            @else

                                <span class="text-muted">-</span>

                            @endif

                        </td>

                        <!-- Order -->
                        <td>

                            <span class="badge bg-dark">
                                {{ $slider->order }}
                            </span>

                        </td>

                        <!-- Status -->
                        <td>

                            @if($slider->is_active)

                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Active
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    <i class="fas fa-times-circle me-1"></i>
                                    Non Active
                                </span>

                            @endif

                        </td>

                        <!-- Created -->
                        <td>

                            <small>
                                {{ $slider->created_at->format('d/m/Y H:i') }}
                            </small>

                        </td>

                        <!-- Action -->
                        <td>

                            <div class="d-flex gap-2">

                                <a href="{{ route('admin.slider.show', $slider->id) }}"
                                    class="btn btn-info btn-sm action-btn"
                                    title="Detail">

                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                    class="btn btn-warning btn-sm action-btn"
                                    title="Edit">

                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button type="button"
                                            class="btn btn-danger btn-sm action-btn"
                                            onclick="confirmDelete('{{ $slider->id }}', '{{ addslashes($slider->title) }}')">

                                        <i class="fas fa-trash"></i>
                                    </button>

                            </div>

                            <form id="delete-form-{{ $slider->id }}"
                                action="{{ route('admin.slider.destroy', $slider->id) }}"
                                method="POST"
                                class="d-none">

                                @csrf
                                @method('DELETE')

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center py-5">

                            <i class="fas fa-images fa-4x text-muted mb-3 d-block"></i>

                            <h5 class="text-muted">
                                Belum ada slider
                            </h5>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        @if(method_exists($sliders, 'hasPages') && $sliders->hasPages())

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-3 border-top">

            <div class="text-muted small mb-2 mb-md-0">

                <i class="fas fa-chart-line me-1"></i>

                Menampilkan
                {{ $sliders->firstItem() ?? 0 }}
                -
                {{ $sliders->lastItem() ?? 0 }}

                dari
                {{ $sliders->total() ?? 0 }}
                data slider

            </div>

            <div>
                {{ $sliders->appends(request()->query())->links() }}
            </div>

        </div>

        @endif

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
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="text-center mb-3">

                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>

                </div>

                <p class="text-center">
                    Apakah Anda yakin ingin menghapus slider:
                </p>

                <p class="fw-bold text-danger text-center"
                   id="deleteTitle">
                </p>

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

function confirmDelete(id, title)
{
    deleteId = id;

    document.getElementById('deleteTitle').innerHTML = title;

    let modal = new bootstrap.Modal(
        document.getElementById('deleteModal')
    );

    modal.show();
}

document.getElementById('confirmDeleteBtn')
.addEventListener('click', function()
{
    if(deleteId)
    {
        document.getElementById('delete-form-' + deleteId).submit();
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