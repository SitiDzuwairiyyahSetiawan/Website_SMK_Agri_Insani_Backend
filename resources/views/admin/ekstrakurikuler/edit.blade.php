@extends('admin.layouts.app')

@section('title', 'Edit Ekstrakurikuler')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Edit Ekstrakurikuler</h2>
        <p class="text-muted">Edit atau update data ekstrakurikuler</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.ekstrakurikuler.update', $ekstrakurikuler->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                {{-- KIRI --}}
                <div class="col-md-8">

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Nama Ekstrakurikuler
                        </label>

                        <input type="text"
                               name="nama_ekstrakurikuler"
                               id="nama_ekstrakurikuler"
                               class="form-control"
                               value="{{ old('nama_ekstrakurikuler', $ekstrakurikuler->nama_ekstrakurikuler) }}">
                    </div>

                    {{-- Preview Nama --}}
                    <div class="mb-3">
                        <label class="form-label text-muted">
                            Preview Nama Ekstrakurikuler:
                        </label>

                        <div class="bg-light p-2 rounded" id="previewNama">
                            <strong>
                                {{ $ekstrakurikuler->nama_ekstrakurikuler }}
                            </strong>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  rows="12"
                                  class="form-control"
                                  id="deskripsi">{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
                    </div>

                </div>

                {{-- KANAN --}}
                <div class="col-md-4">

                    {{-- IKON --}}
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <i class="fas fa-icons"></i> Kategori Ekstrakurikuler
                        </div>

                        <div class="card-body text-center">

                            <select name="ikon"
                                    id="ikon"
                                    class="form-select">

                                <option value="📱"
                                    {{ $ekstrakurikuler->ikon == '📱' ? 'selected' : '' }}>
                                    📱 Content Creator
                                </option>

                                <option value="🤖"
                                    {{ $ekstrakurikuler->ikon == '🤖' ? 'selected' : '' }}>
                                    🤖 AI & Digital
                                </option>

                                <option value="📊"
                                    {{ $ekstrakurikuler->ikon == '📊' ? 'selected' : '' }}>
                                    📊 Sales & Marketing
                                </option>

                                <option value="💡"
                                    {{ $ekstrakurikuler->ikon == '💡' ? 'selected' : '' }}>
                                    💡 Kewirausahaan
                                </option>

                            </select>

                            <div class="display-1 mt-3" id="previewIcon">
                                {{ $ekstrakurikuler->ikon }}
                            </div>

                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Informasi:</strong>
                        <ul class="mb-0 mt-2 small">
                            <li>Data akan langsung diperbarui</li>
                            <li>Kategori akan tampil di halaman depan</li>
                        </ul>
                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-3 mt-3">

                <a href="{{ route('admin.ekstrakurikuler.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save"></i> Update
                </button>

            </div>

        </form>

    </div>
</div>

@push('scripts')
<script>

// preview nama
document.getElementById('nama_ekstrakurikuler').addEventListener('keyup', function () {
    let nama = this.value;
    let preview = document.getElementById('previewNama');

    if (nama) {
        preview.innerHTML = '<strong>' + nama + '</strong>';
    } else {
        preview.innerHTML = '<span class="text-muted">Nama ekstrakurikuler akan muncul disini</span>';
    }
});

// preview ikon
document.getElementById('ikon').addEventListener('change', function () {
    document.getElementById('previewIcon').innerHTML = this.value;
});

</script>
@endpush

@endsection