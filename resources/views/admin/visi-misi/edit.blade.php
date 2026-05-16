@extends('admin.layouts.app')

@section('title', 'Edit Visi & Misi')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-0">
            {{ $visiMisi->type == 'visi' ? 'Edit Visi' : 'Edit Misi' }}
        </h2>

        <p class="text-muted">
            Perbarui data visi atau misi sekolah
        </p>

    </div>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        <form action="{{ route('admin.visi-misi.update', $visiMisi->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-8">

                    @if($visiMisi->type == 'visi')

                        <!-- VISI -->
                        <div class="mb-3">

                            <label for="visi"
                                   class="form-label fw-bold">

                                Konten Visi
                                <span class="text-danger">*</span>

                            </label>

                            <textarea
                                class="form-control @error('visi') is-invalid @enderror"
                                id="visi"
                                name="visi"
                                rows="12"
                                placeholder="Tulis visi sekolah disini...">{{ old('visi', $visiMisi->visi) }}</textarea>

                            @error('visi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-text">
                                Tuliskan visi sekolah dengan jelas dan inspiratif.
                            </div>

                        </div>

                    @else

                        <!-- MISI -->
                        <div class="mb-3">

                            <label for="misi"
                                   class="form-label fw-bold">

                                Poin Misi
                                <span class="text-danger">*</span>

                            </label>

                            <textarea
                                class="form-control @error('misi') is-invalid @enderror"
                                id="misi"
                                name="misi"
                                rows="10"
                                placeholder="Tulis poin misi disini...">{{ old('misi', $visiMisi->misi) }}</textarea>

                            @error('misi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-text">
                                Tuliskan poin misi dengan jelas dan mudah dipahami.
                            </div>

                        </div>

                    @endif

                </div>

                <div class="col-md-4">

                    <!-- INFORMASI -->
                    <div class="card mb-3">

                        <div class="card-header bg-light">

                            <i class="fas fa-info-circle"></i>

                            Informasi Data

                        </div>

                        <div class="card-body">

                            <div class="mb-3">

                                <label class="fw-bold d-block mb-1">
                                    Tipe
                                </label>

                                @if($visiMisi->type == 'visi')

                                    <span class="badge bg-primary px-3 py-2">
                                        <i class="fas fa-bullseye me-1"></i>
                                        Visi
                                    </span>

                                @else

                                    <span class="badge bg-success px-3 py-2">
                                        <i class="fas fa-tasks me-1"></i>
                                        Misi
                                    </span>

                                @endif

                            </div>

                            <hr>

                            <div class="mb-3">

                                <label class="fw-bold d-block mb-1">
                                    Dibuat
                                </label>

                                <small class="text-muted">
                                    {{ $visiMisi->created_at->format('d/m/Y H:i') }}
                                </small>

                            </div>

                            <div>

                                <label class="fw-bold d-block mb-1">
                                    Terakhir Update
                                </label>

                                <small class="text-muted">
                                    {{ $visiMisi->updated_at->format('d/m/Y H:i') }}
                                </small>

                            </div>

                        </div>

                    </div>

                    <!-- TIPS -->
                    <div class="alert alert-info">

                        <i class="fas fa-lightbulb"></i>

                        <strong>Tips:</strong>

                        <ul class="mb-0 mt-2 small">

                            @if($visiMisi->type == 'visi')

                                <li>
                                    Gunakan kalimat singkat dan jelas.
                                </li>

                                <li>
                                    Visi menggambarkan tujuan jangka panjang sekolah.
                                </li>

                                <li>
                                    Buat visi yang inspiratif dan mudah diingat.
                                </li>

                            @else

                                <li>
                                    Gunakan poin misi yang spesifik.
                                </li>

                                <li>
                                    Pastikan misi mendukung visi sekolah.
                                </li>

                                <li>
                                    Gunakan bahasa yang mudah dipahami.
                                </li>

                            @endif

                        </ul>

                    </div>

                </div>

            </div>

            <div class="border-top pt-3 mt-3">

                <a href="{{ route('admin.sejarah.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit"
                        class="btn btn-primary px-4">

                    <i class="fas fa-save"></i>
                    Update

                </button>

            </div>

        </form>

    </div>

</div>

@endsection