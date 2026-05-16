@extends('admin.layouts.app')

@section('title', 'Edit Kontak Sekolah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Edit Kontak Sekolah</h2>
        <p class="text-muted">Edit atau update informasi kontak sekolah</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.kontak.update') }}">
            @csrf
            @method('PUT')

            <div class="row">
                
                <!-- KIRI -->
                <div class="col-md-8">

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-bold">
                            Alamat Sekolah <span class="text-danger">*</span>
                        </label>
                        <textarea 
                            name="alamat" 
                            id="alamat"
                            rows="4"
                            class="form-control @error('alamat') is-invalid @enderror"
                            required>{{ old('alamat', $kontak->alamat) }}</textarea>

                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">
                            Email Sekolah <span class="text-danger">*</span>
                        </label>

                        <input 
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $kontak->email) }}"
                            required>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Whatsapp -->
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label fw-bold">
                            Nomor Whatsapp <span class="text-danger">*</span>
                        </label>

                        <input 
                            type="text"
                            name="whatsapp"
                            id="whatsapp"
                            class="form-control @error('whatsapp') is-invalid @enderror"
                            value="{{ old('whatsapp', $kontak->whatsapp) }}"
                            placeholder="Contoh: 628123456789"
                            required>

                        <div class="form-text">
                            Gunakan format nomor dengan kode negara tanpa tanda +
                        </div>

                        @error('whatsapp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Instagram -->
                    <div class="mb-3">
                        <label for="instagram" class="form-label fw-bold">
                            URL Instagram
                        </label>

                        <input 
                            type="text"
                            name="instagram"
                            id="instagram"
                            class="form-control @error('instagram') is-invalid @enderror"
                            value="{{ old('instagram', $kontak->instagram) }}"
                            placeholder="https://instagram.com/username">

                        @error('instagram')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <!-- KANAN -->
                <div class="col-md-4">

                    <!-- Informasi Kontak -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <i class="fas fa-address-book"></i> Informasi Kontak
                        </div>

                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    Preview Email
                                </label>

                                <div class="border rounded p-3 bg-light small text-muted">
                                    {{ $kontak->email ?: 'Belum ada email' }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    Preview Whatsapp
                                </label>

                                <div class="border rounded p-3 bg-light small text-muted">
                                    {{ $kontak->whatsapp ?: 'Belum ada nomor whatsapp' }}
                                </div>
                            </div>

                            <div>
                                <label class="form-label fw-bold">
                                    Preview Instagram
                                </label>

                                <div class="border rounded p-3 bg-light small text-muted text-break">
                                    {{ $kontak->instagram ?: 'Belum ada link instagram' }}
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Info -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Informasi:</strong>

                        <ul class="mb-0 mt-2 small">
                            <li>Pastikan email aktif dan valid</li>
                            <li>Nomor Whatsapp menggunakan kode negara</li>
                            <li>Gunakan URL Instagram lengkap</li>
                        </ul>
                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="border-top pt-3 mt-3 d-flex gap-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection