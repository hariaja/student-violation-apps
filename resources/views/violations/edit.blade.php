@extends('layouts.app')
@section('title') {{ trans('page.violations.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="content-heading">
    <div class="d-flex justify-content-between align-items-sm-center">
      {{ trans('page.violations.title') }}
      <a href="{{ route('violations.index') }}" class="btn btn-sm btn-block-option text-danger">
        <i class="fa fa-xs fa-chevron-left me-1"></i>
        {{ trans('button.back') }}
      </a>
    </div>
    <nav class="breadcrumb push my-0">
      {{ Breadcrumbs::render('violations.edit', $violation) }}
    </nav>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.violations.edit') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('violations.update', $violation->uuid) }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf
      @method('PATCH')

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="name" class="form-label">{{ trans('Nama') }}</label>
            <span class="text-danger">*</span>
            <input type="text" name="name" id="name" value="{{ old('name', $violation->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Nama Prestasi') }}" onkeypress="return onlyLetter(event)">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="point" class="form-label">{{ trans('Point Prestasi') }}</label>
            <span class="text-danger">*</span>
            <input type="number" min="1" max="200" step="0.5" name="point" id="point" class="form-control @error('point') is-invalid @enderror" value="{{ old('point', $violation->point) }}" required placeholder="{{ trans('Point Prestasi') }}">
            <small class="text-muted">
              <em>{{ trans('Gunakan Koma (,) untuk mengganti Titik (.)') }}</em>
            </small>
            @error('point')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <button type="submit" class="btn btn-warning w-100" id="submit-button">
              <i class="fa fa-fw fa-circle-check me-1"></i>
              {{ trans('button.edit') }}
            </button>
          </div>

        </div>
      </div>

    </form>

  </div>
</div>
@endsection
@vite('resources/js/violations/input.js')
