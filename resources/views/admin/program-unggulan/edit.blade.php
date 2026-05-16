@extends('admin.layouts.app')

@section('title', 'Edit Program Unggulan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Edit Program Unggulan</h2>
        <p class="text-muted">Edit atau update data program unggulan</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.program-unggulan.update', $programUnggulan->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

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
                               class="form-control"
                               value="{{ old('nama_program_unggulan', $programUnggulan->nama_program_unggulan) }}">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  rows="12"
                                  class="form-control">{{ old('deskripsi', $programUnggulan->deskripsi) }}</textarea>
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
                                    class="form-select">

                                <option value="🌱" {{ $programUnggulan->ikon == '🌱' ? 'selected' : '' }}>🌱 Tani Hasil Siswa</option>
                                <option value="🐄" {{ $programUnggulan->ikon == '🐄' ? 'selected' : '' }}>🐄 Ternak Hasil Siswa</option>
                                <option value="🏦" {{ $programUnggulan->ikon == '🏦' ? 'selected' : '' }}>🏦 Bank Ternak Indonesia</option>
                                <option value="👨‍🌾" {{ $programUnggulan->ikon == '👨‍🌾' ? 'selected' : '' }}>👨‍🌾 Kelompok Tani</option>

                            </select>

                            <div class="display-1 mt-3" id="previewIcon">
                                {{ $programUnggulan->ikon }}
                            </div>

                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Informasi:</strong>
                        <ul class="mb-0 mt-2 small">
                            <li>Data akan langsung diperbarui</li>
                            <li>Ikon akan tampil di halaman depan</li>
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
                    <i class="fas fa-save"></i> Update
                </button>

            </div>

        </form>

    </div>
</div>

@push('scripts')
<script>

document.getElementById('ikon').addEventListener('change', function() {
    document.getElementById('previewIcon').innerHTML = this.value;
});


</script>
@endpush

@endsection