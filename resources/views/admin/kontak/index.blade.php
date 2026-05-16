@extends('admin.layouts.app')

@section('title', 'Manajemen Kontak')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Manajemen Kontak</h2>
        <p class="text-muted">Kelola semua pesan dan pertanyaan yang masuk dari pengunjung</p>
    </div>
    <a href="{{ route('admin.kontak.export') }}" class="btn btn-success">
        <i class="fas fa-file-excel me-2"></i> Export Excel
    </a>
</div>

<!-- Statistik -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-white-50">Total Pesan</h6><h3>{{ $statistik['total'] ?? 0 }}</h3></div>
                    <i class="fas fa-envelope fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-white-50">Pending</h6><h3>{{ $statistik['pending'] ?? 0 }}</h3></div>
                    <i class="fas fa-clock fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-white-50">Dibaca</h6><h3>{{ $statistik['dibaca'] ?? 0 }}</h3></div>
                    <i class="fas fa-eye fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-white-50">Dibalas</h6><h3>{{ $statistik['dibalas'] ?? 0 }}</h3></div>
                    <i class="fab fa-whatsapp fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">ID</th><th>Nama</th><th>WhatsApp</th><th>Topik</th><th>Pesan</th><th>Status</th><th>Tanggal</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kontaks as $item)
                    <tr>
                        <td class="ps-3">{{ ($kontaks->currentPage() - 1) * $kontaks->perPage() + $loop->iteration }}</td>
                        <td><strong>{{ $item->nama_lengkap }}</strong></td>
                        <td><a href="https://wa.me/{{ $item->no_telepon }}" target="_blank" class="text-success"><i class="fab fa-whatsapp me-1"></i>{{ $item->no_telepon }}</a></td>
                        <td>{{ Str::limit($item->topik_pertanyaan, 30) }}</td>
                        <td>{{ Str::limit($item->pesan, 50) }}</td>
                        <td>
                            @if($item->status == 'pending') <span class="badge bg-warning">Pending</span>
                            @elseif($item->status == 'dibaca') <span class="badge bg-info">Dibaca</span>
                            @else <span class="badge bg-success">Dibalas</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.kontak.show', $item->id) }}" class="btn btn-info btn-sm action-btn" title="Detail"><i class="fas fa-eye"></i></a>
                                <button type="button" class="btn btn-success btn-sm action-btn" title="Balas WhatsApp"
                                    onclick="openBalasModal({{ $item->id }}, {{ json_encode($item->nama_lengkap) }}, {{ json_encode($item->no_telepon) }}, {{ json_encode($item->topik_pertanyaan) }})">
                                    <i class="fab fa-whatsapp"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm action-btn" title="Hapus"
                                    onclick="confirmDelete({{ $item->id }}, {{ json_encode($item->nama_lengkap) }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.kontak.destroy', $item->id) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-5"><i class="fas fa-inbox fa-4x text-muted mb-3 d-block"></i><h5 class="text-muted">Belum ada pesan masuk</h5></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-3">{{ $kontaks->links() }}</div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white"><h5 class="modal-title">Konfirmasi Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body text-center"><p>Yakin ingin menghapus pesan dari:</p><h5 class="text-danger" id="deleteNama"></h5></div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button></div>
        </div>
    </div>
</div>

<!-- Modal Balas WhatsApp -->
<div class="modal fade" id="balasModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white"><h5 class="modal-title"><i class="fab fa-whatsapp me-2"></i>Balas via WhatsApp</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="alert alert-light border">
                    <p class="mb-1"><strong>Nama:</strong> <span id="modalNama"></span></p>
                    <p class="mb-1"><strong>Nomor:</strong> <span id="modalNomor"></span></p>
                    <p class="mb-0"><strong>Topik:</strong> <span id="modalTopik"></span></p>
                </div>
                <label class="form-label fw-semibold">Balasan</label>
                <textarea id="balasanText" rows="5" class="form-control" placeholder="Tulis balasan..."></textarea>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="button" class="btn btn-success" onclick="sendToWhatsApp()"><i class="fab fa-whatsapp me-2"></i>Kirim</button></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentKontakId = null, currentWaNumber = null, balasModal = null;
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('balasModal');
        if (modalEl) {
            balasModal = new bootstrap.Modal(modalEl);
            modalEl.addEventListener('hidden.bs.modal', function() {
                document.getElementById('balasanText').value = '';
                currentKontakId = null;
                currentWaNumber = null;
                document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                document.body.classList.remove('modal-open');
            });
        }
    });
    function openBalasModal(id, nama, nomor, topik) {
        currentKontakId = id;
        currentWaNumber = nomor.startsWith('0') ? '62' + nomor.substring(1) : nomor;
        document.getElementById('modalNama').innerText = nama;
        document.getElementById('modalNomor').innerText = nomor;
        document.getElementById('modalTopik').innerText = topik;
        document.getElementById('balasanText').value = `Halo ${nama},\n\nTerima kasih telah menghubungi SMK Agri Insani.\n\n📝 Topik: ${topik}\n\nBalasan:\n`;
        if (balasModal) balasModal.show();
    }
    function sendToWhatsApp() {
        const balasan = document.getElementById('balasanText').value;
        if (!balasan.trim()) { alert('Silakan isi balasan.'); return; }
        const nama = document.getElementById('modalNama').innerText;
        const topik = document.getElementById('modalTopik').innerText;
        const message = `*SMK Agri Insani*\n\nHalo *${nama}*,\n\nTerima kasih telah menghubungi kami.\n\n📝 *Topik:* ${topik}\n\n*Balasan:*\n${balasan}\n\n_SMK Agri Insani_`;
        const waUrl = `https://wa.me/${currentWaNumber}?text=${encodeURIComponent(message)}`;
        fetch('{{ route("admin.kontak.save-balasan") }}', {
            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: JSON.stringify({ kontak_id: currentKontakId, balasan: balasan })
        }).then(() => { window.open(waUrl, '_blank'); balasModal.hide(); setTimeout(() => location.reload(), 1000); })
          .catch(() => { window.open(waUrl, '_blank'); balasModal.hide(); });
    }
    let deleteId = '';
    function confirmDelete(id, nama) { deleteId = id; document.getElementById('deleteNama').innerText = nama; new bootstrap.Modal(document.getElementById('deleteModal')).show(); }
    document.getElementById('confirmDeleteBtn')?.addEventListener('click', function() { if (deleteId) document.getElementById('delete-form-' + deleteId).submit(); });
</script>
<style>
    .action-btn { border-radius: 8px !important; transition: all .2s ease; box-shadow: 0 2px 6px rgba(0,0,0,.12); }
    .action-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(0,0,0,.18); }
</style>
@endpush