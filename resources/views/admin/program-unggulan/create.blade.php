@extends('admin.layouts.app')

@section('title', 'Tambah Program Unggulan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Tambah Program Unggulan Baru</h2>
        <p class="text-muted">Tambahkan data program unggulan sekolah</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.program-unggulan.store') }}"
              method="POST">

            @csrf

            <div class="row">

                {{-- KIRI --}}
                <div class="col-md-8">

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Nama Program Unggulan
                        </label>

                        <input type="text"
                               name="nama_program_unggulan"
                               class="form-control @error('nama_program_unggulan') is-invalid @enderror"
                               id="nama_program_unggulan"
                               value="{{ old('nama_program_unggulan') }}"
                               placeholder="Masukkan nama program unggulan">

                        @error('nama_program_unggulan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Preview Nama --}}
                    <div class="mb-3">
                        <label class="form-label text-muted">
                            Preview Nama Program Unggulan:
                        </label>

                        <div class="bg-light p-2 rounded" id="previewNama">
                            <span class="text-muted">
                                Nama program unggulan akan muncul disini
                            </span>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  rows="12"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi"
                                  placeholder="Tulis deskripsi program unggulan...">{{ old('deskripsi') }}</textarea>

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
                            <i class="fas fa-icons"></i> Ikon Program
                        </div>

                        <div class="card-body text-center">

                            <select name="ikon"
                                    id="ikon"
                                    class="form-select @error('ikon') is-invalid @enderror">

                                <option value="">-- Pilih Ikon --</option>

                                <option value="🌱" {{ old('ikon') == '🌱' ? 'selected' : '' }}>🌱 Tani Hasil Siswa</option>
                                <option value="🐄" {{ old('ikon') == '🐄' ? 'selected' : '' }}>🐄 Ternak Hasil Siswa</option>
                                <option value="🏦" {{ old('ikon') == '🏦' ? 'selected' : '' }}>🏦 Bank Ternak Indonesia</option>
                                <option value="👨‍🌾" {{ old('ikon') == '👨‍🌾' ? 'selected' : '' }}>👨‍🌾 Kelompok Tani</option>

                            </select>

                            @error('ikon')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="display-1 mt-3" id="previewIcon">
                                {{ old('ikon', '🌱') }}
                            </div>

                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Informasi:</strong>
                        <ul class="mb-0 mt-2 small">
                            <li>Data akan disimpan setelah klik simpan</li>
                            <li>Ikon akan tampil di halaman depan</li>
                            <li>Gunakan deskripsi yang jelas</li>
                        </ul>
                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-3 mt-3">

                <a href="{{ route('admin.program-unggulan.index') }}"
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
document.getElementById('nama_program_unggulan').addEventListener('keyup', function () {
    let nama = this.value;
    let preview = document.getElementById('previewNama');

    if (nama) {
        preview.innerHTML = '<strong>' + nama + '</strong>';
    } else {
        preview.innerHTML = '<span class="text-muted">Nama program unggulan akan muncul disini</span>';
    }
});

// preview ikon
document.getElementById('ikon').addEventListener('change', function () {
    document.getElementById('previewIcon').innerHTML = this.value;
});

</script>
@endpush

@endsection