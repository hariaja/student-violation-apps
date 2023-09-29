@extends('layouts.app')
@section('title') {{ trans('page.counts.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="content-heading">
    <div class="d-flex justify-content-between align-items-sm-center">
      {{ trans('page.counts.title') }}
      <a href="{{ route('counts.index') }}" class="btn btn-sm btn-block-option text-danger">
        <i class="fa fa-xs fa-chevron-left me-1"></i>
        {{ trans('button.back') }}
      </a>
    </div>
    <nav class="breadcrumb push my-0">
      {{ Breadcrumbs::render('counts.create') }}
    </nav>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.counts.create') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('counts.store') }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="student_id" class="form-label">{{ trans('Siswa') }}</label>
            <span class="text-danger">*</span>
            <select name="student_id" id="student_id" class="js-select2 form-select @error('student_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Siswa') }}" style="width: 100%;">
              <option></option>
              @foreach ($students as $item)
              <option value="{{ $item->id }}" @if (old('student_id')==$item->id) selected @endif>{{ $item->name }}</option>
              @endforeach
            </select>
            @error('student_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="achievement_id" class="form-label">{{ trans('Prestasi') }}</label>
            <span class="text-danger">*</span>
            <select name="achievement_id" id="achievement_id" class="js-select2 form-select @error('achievement_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Prestasi') }}" style="width: 100%;">
              <option></option>
              @foreach ($achievements as $item)
              <option value="{{ $item->id }}" @if (old('achievement_id')==$item->id) selected @endif>{{ $item->name }}</option>
              @endforeach
            </select>
            @error('achievement_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="violation_id" class="form-label">{{ trans('Pelanggaran') }}</label>
            <span class="text-danger">*</span>
            <select name="violation_id" id="violation_id" class="js-select2 form-select @error('violation_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Pelanggaran') }}" style="width: 100%;">
              <option></option>
              @foreach ($violations as $item)
              <option value="{{ $item->id }}" @if (old('violation_id')==$item->id) selected @endif>{{ $item->name }}</option>
              @endforeach
            </select>
            @error('violation_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <button type="submit" class="btn btn-primary w-100" id="submit-button">
              <i class="fa fa-fw fa-circle-check me-1"></i>
              {{ trans('button.create') }}
            </button>
          </div>

        </div>
      </div>

    </form>

  </div>
</div>
@endsection
