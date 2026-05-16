@extends('admin.layouts.app')

@section('title', 'Tambah Ekstrakurikuler')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Tambah Ekstrakurikuler Baru</h2>
        <p class="text-muted">Tambahkan data ekstrakurikuler sekolah</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.ekstrakurikuler.store') }}" method="POST">
            @csrf

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
                               class="form-control @error('nama_ekstrakurikuler') is-invalid @enderror"
                               value="{{ old('nama_ekstrakurikuler') }}"
                               placeholder="Masukkan nama ekstrakurikuler">

                        @error('nama_ekstrakurikuler')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Preview Nama --}}
                    <div class="mb-3">
                        <label class="form-label text-muted">
                            Preview Nama Ekstrakurikuler:
                        </label>

                        <div class="bg-light p-2 rounded" id="previewNama">
                            <span class="text-muted">
                                Nama ekstrakurikuler akan muncul disini
                            </span>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  id="deskripsi"
                                  rows="12"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Tulis deskripsi ekstrakurikuler...">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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

                                <option value="">-- Pilih Kategori --</option>

                                <option value="📱" {{ old('ikon') == '📱' ? 'selected' : '' }}>
                                    📱 Content Creator
                                </option>

                                <option value="🤖" {{ old('ikon') == '🤖' ? 'selected' : '' }}>
                                    🤖 AI & Digital
                                </option>

                                <option value="📊" {{ old('ikon') == '📊' ? 'selected' : '' }}>
                                    📊 Sales & Marketing
                                </option>

                                <option value="💡" {{ old('ikon') == '💡' ? 'selected' : '' }}>
                                    💡 Kewirausahaan
                                </option>

                            </select>

                            @error('ikon')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="display-1 mt-3" id="previewIcon">
                                {{ old('ikon', '📱') }}
                            </div>

                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Informasi:</strong>
                        <ul class="mb-0 mt-2 small">
                            <li>Data akan disimpan setelah klik simpan</li>
                            <li>Kategori akan tampil di halaman depan</li>
                            <li>Gunakan deskripsi yang jelas</li>
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
                    <i class="fas fa-save"></i> Simpan
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

// trigger awal
document.getElementById('nama_ekstrakurikuler')
    .dispatchEvent(new Event('keyup'));

</script>
@endpush

@endsection