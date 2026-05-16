@extends('admin.layouts.app')

@section('title', 'Manajemen Pendaftaran')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-0">Manajemen Pendaftaran</h2>
        <p class="text-muted">Kelola data SPMB siswa baru</p>
    </div>

</div>

<!-- STATISTIK -->
<div class="row mb-4 g-3 flex-nowrap overflow-auto">

    <div class="col">
        <div class="card bg-primary text-white shadow-sm h-100 border-0">
            <div class="card-body text-center">
                <h6>Total</h6>
                <h3>{{ \App\Models\Pendaftaran::count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card bg-warning text-white shadow-sm h-100 border-0">
            <div class="card-body text-center">
                <h6>Pending</h6>
                <h3>{{ \App\Models\Pendaftaran::where('status','pending')->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card bg-secondary text-white shadow-sm h-100 border-0">
            <div class="card-body text-center">
                <h6>Dibaca</h6>
                <h3>{{ \App\Models\Pendaftaran::where('status','dibaca')->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card bg-info text-white shadow-sm h-100 border-0">
            <div class="card-body text-center">
                <h6>Diverifikasi</h6>
                <h3>{{ \App\Models\Pendaftaran::where('status','diverifikasi')->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card bg-primary text-white shadow-sm h-100 border-0">
            <div class="card-body text-center">
                <h6>Lolos Berkas</h6>
                <h3>{{ \App\Models\Pendaftaran::where('status','lolos_berkas')->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card bg-success text-white shadow-sm h-100 border-0">
            <div class="card-body text-center">
                <h6>Diterima</h6>
                <h3>{{ \App\Models\Pendaftaran::where('status','diterima')->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card bg-danger text-white shadow-sm h-100 border-0">
            <div class="card-body text-center">
                <h6>Ditolak</h6>
                <h3>{{ \App\Models\Pendaftaran::where('status','ditolak')->count() }}</h3>
            </div>
        </div>
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
                        <th width="25%">Nama</th>
                        <th width="15%">NISN</th>
                        <th width="15%">Program</th>
                        <th width="15%">Status</th>
                        <th width="15%">Tanggal</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($pendaftarans as $p)

                    <tr>

                        <td class="ps-3">
                            {{ $p->id }}
                        </td>

                        <td>
                            <div class="fw-bold">
                                {{ $p->nama_lengkap }}
                            </div>

                            <small>
                                {{ $p->email }}
                            </small>
                        </td>

                        <td>
                            {{ $p->nisn }}
                        </td>

                        <td>
                            {{ $p->program->nama_program_unggulan ?? '-' }}
                        </td>

                        <td>

                            @if($p->status == 'pending')

                                <span class="badge bg-warning">
                                    Pending
                                </span>

                            @elseif($p->status == 'dibaca')

                                <span class="badge bg-secondary">
                                    Dibaca
                                </span>

                            @elseif($p->status == 'diverifikasi')

                                <span class="badge bg-info">
                                    Diverifikasi
                                </span>

                            @elseif($p->status == 'lolos_berkas')

                                <span class="badge bg-primary">
                                    Lolos Berkas
                                </span>

                            @elseif($p->status == 'diterima')

                                <span class="badge bg-success">
                                    Diterima
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Ditolak
                                </span>

                            @endif

                        </td>

                        <td>
                            <small>
                                {{ $p->created_at->format('d/m/Y') }}
                            </small>
                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <!-- DETAIL -->
                                <a href="{{ route('admin.pendaftaran.show',$p->id) }}"
                                   class="btn btn-info btn-sm action-btn">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <!-- EDIT -->
                                <a href="{{ route('admin.pendaftaran.edit',$p->id) }}"
                                   class="btn btn-warning btn-sm action-btn">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <!-- DELETE -->
                                <button type="button"
                                        class="btn btn-danger btn-sm action-btn"
                                        title="Hapus"
                                        onclick="confirmDelete('{{ $p->id }}', '{{ addslashes($p->nama_lengkap) }}')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </div>

                            <!-- FORM DELETE -->
                            <form id="delete-form-{{ $p->id }}"
                                  action="{{ route('admin.pendaftaran.destroy', $p->id) }}"
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

                            <i class="fas fa-user-graduate fa-4x text-muted mb-3 d-block"></i>

                            <h5 class="text-muted">
                                Belum ada data pendaftaran
                            </h5>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- PAGINATION -->
<div class="mt-4">
    {{ $pendaftarans->links() }}
</div>

<!-- MODAL DELETE -->
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

            <div class="modal-body text-center">

                <div class="mb-3">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                </div>

                <p>
                    Yakin ingin menghapus data:
                </p>

                <p class="fw-bold text-danger" id="deleteNama"></p>

                <small class="text-muted">
                    Data yang dihapus tidak dapat dikembalikan
                </small>

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

                    Ya, Hapus

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