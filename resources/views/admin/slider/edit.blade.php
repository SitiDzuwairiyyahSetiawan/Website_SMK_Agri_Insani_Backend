@extends('admin.layouts.app')

@section('title', 'Edit Slider')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Edit Slider</h2>
        <p class="text-muted">Edit atau update slider homepage website</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.slider.update', $slider->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                {{-- KONTEN --}}
                <div class="col-md-8">

                    {{-- TITLE --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Title Slider
                        </label>

                        <input type="text"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $slider->title) }}">

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- TAG --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Tag
                        </label>

                        <input type="text"
                               name="tag"
                               class="form-control @error('tag') is-invalid @enderror"
                               value="{{ old('tag', $slider->tag) }}">

                        @error('tag')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Description
                        </label>

                        <textarea name="description"
                                  rows="12"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $slider->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                {{-- SIDEBAR --}}
                <div class="col-md-4">

                    {{-- IMAGE --}}
                    <div class="card mb-3">

                        <div class="card-header bg-light">
                            <i class="fas fa-image"></i>
                            Gambar Slider
                        </div>

                        <div class="card-body">

                            <div class="text-center mb-3">

                                <div id="imagePreview"
                                     class="border rounded p-3 bg-light">

                                    @if($slider->image)

                                        <img src="{{ asset('storage/' . $slider->image) }}"
                                             class="img-fluid rounded"
                                             style="max-height: 220px; object-fit: cover;">

                                    @else

                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>

                                        <p class="text-muted small mt-2">
                                            Belum ada gambar
                                        </p>

                                    @endif

                                </div>

                            </div>

                            <input type="file"
                                   name="image"
                                   id="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/*">

                            <div class="form-text">
                                <small class="text-warning">
                                    <i class="fas fa-info-circle"></i>
                                    Kosongkan jika tidak ingin mengubah gambar
                                </small>
                            </div>

                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- PENGATURAN --}}
                    <div class="card mb-3">

                        <div class="card-header bg-light">
                            <i class="fas fa-cog"></i>
                            Pengaturan Slider
                        </div>

                        <div class="card-body">

                            {{-- ORDER --}}
                            <div class="mb-3">

                                <label class="form-label fw-bold">
                                    Urutan Slider
                                </label>

                                <input type="number"
                                       name="order"
                                       class="form-control @error('order') is-invalid @enderror"
                                       value="{{ old('order', $slider->order) }}">

                                @error('order')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- STATUS --}}
                            <div class="mb-2">

                                <label class="form-label fw-bold d-block">
                                    Status
                                </label>

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="is_active"
                                           class="form-check-input"
                                           id="is_active"
                                           {{ $slider->is_active ? 'checked' : '' }}>

                                    <label class="form-check-label"
                                           for="is_active">

                                        <i class="fas fa-check-circle text-success"></i>
                                        Aktifkan Slider

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- INFO --}}
                    <div class="alert alert-info">

                        <i class="fas fa-info-circle"></i>

                        <strong>Informasi:</strong>

                        <ul class="mb-0 mt-2 small">

                            <li>
                                Dibuat:
                                {{ $slider->created_at->format('d/m/Y H:i') }}
                            </li>

                            <li>
                                Terakhir update:
                                {{ $slider->updated_at->format('d/m/Y H:i') }}
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-3 mt-3">

                <a href="{{ route('admin.slider.index') }}"
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

@push('scripts')
<script>

    // Preview Image
    document.getElementById('image').addEventListener('change', function(e) {

        const file = e.target.files[0];

        if (file)
        {
            const reader = new FileReader();

            reader.onload = function(e)
            {
                const preview = document.getElementById('imagePreview');

                preview.innerHTML =
                    `<img src="${e.target.result}"
                          class="img-fluid rounded"
                          style="max-height:220px; object-fit:cover;">`;
            }

            reader.readAsDataURL(file);
        }

    });

</script>
@endpush

@endsection