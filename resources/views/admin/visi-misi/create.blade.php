@extends('admin.layouts.app')

@section('title', 'Tambah Visi & Misi')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-0">
            {{ $type == 'visi' ? 'Tambah Visi Baru' : 'Tambah Misi Baru' }}
        </h2>

        <p class="text-muted">

            {{ $type == 'visi'
                ? 'Tambahkan visi utama sekolah'
                : 'Tambahkan poin-poin misi sekolah'
            }}

        </p>

    </div>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        <form action="{{ route('admin.visi-misi.store') }}"
              method="POST">

            @csrf

            <input type="hidden"
                   name="type"
                   value="{{ $type }}">

            <div class="row">

                <div class="col-md-8">

                    @if($type == 'visi')

                    <!-- VISI -->
                    <div class="mb-3">

                        <label class="form-label fw-bold">

                            Konten Visi
                            <span class="text-danger">*</span>

                        </label>

                        <textarea name="visi"
                                  rows="15"
                                  class="form-control @error('visi') is-invalid @enderror"
                                  placeholder="Tulis visi sekolah disini...">{{ old('visi') }}</textarea>

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

                        <label class="form-label fw-bold">

                            Poin Misi
                            <span class="text-danger">*</span>

                        </label>

                        <div id="misi-container">

                            <div class="input-group mb-2 misi-item">

                                <input type="text"
                                       name="misi[]"
                                       class="form-control @error('misi.0') is-invalid @enderror"
                                       placeholder="Tulis poin misi..."
                                       required>

                                <button type="button"
                                        class="btn btn-danger remove-misi"
                                        style="display:none;">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </div>

                        </div>

                        @error('misi')

                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>

                        @enderror

                        <div class="form-text mt-2">
                            Tambahkan beberapa poin misi sekolah.
                        </div>

                    </div>

                    @endif

                </div>

                <div class="col-md-4">

                    <!-- INFO -->
                    <div class="alert alert-info">

                        <i class="fas fa-lightbulb"></i>

                        <strong>Tips:</strong>

                        <ul class="mb-0 mt-2 small">

                            @if($type == 'visi')

                                <li>Gunakan kalimat yang singkat dan jelas</li>

                                <li>Visi menggambarkan tujuan jangka panjang sekolah</li>

                                <li>Buat visi yang inspiratif dan mudah dipahami</li>

                            @else

                                <li>Gunakan kata kerja aktif</li>

                                <li>Setiap poin misi fokus pada tujuan tertentu</li>

                                <li>Tambahkan poin sesuai kebutuhan sekolah</li>

                            @endif

                        </ul>

                    </div>

                </div>

            </div>

            <div class="border-top pt-3 mt-3">

                <a href="{{ route('admin.visi-misi.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

                <button class="btn btn-primary">

                    <i class="fas fa-save me-2"></i>
                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function() {

    const addButton = document.getElementById('add-misi');

    if(addButton)
    {
        const container = document.getElementById('misi-container');

        addButton.addEventListener('click', function() {

            const newRow = document.createElement('div');

            newRow.className = 'input-group mb-2 misi-item';

            newRow.innerHTML = `
                <input type="text"
                       name="misi[]"
                       class="form-control"
                       placeholder="Tulis poin misi..."
                       required>

                <button type="button"
                        class="btn btn-danger remove-misi">

                    <i class="fas fa-trash"></i>

                </button>
            `;

            container.appendChild(newRow);

            updateRemoveButtons();
        });

        container.addEventListener('click', function(e) {

            if(e.target.closest('.remove-misi'))
            {
                const item = e.target.closest('.misi-item');

                if(container.children.length > 1)
                {
                    item.remove();

                    updateRemoveButtons();
                }
            }

        });

        function updateRemoveButtons()
        {
            const buttons = container.querySelectorAll('.remove-misi');

            buttons.forEach(btn => {

                btn.style.display =
                    container.children.length > 1
                    ? 'block'
                    : 'none';

            });
        }

        updateRemoveButtons();
    }

});

</script>

@endpush

@endsection