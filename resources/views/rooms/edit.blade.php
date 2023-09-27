@extends('layouts.app')
@section('title') {{ trans('page.rooms.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="content-heading">
    <div class="d-flex justify-content-between align-items-sm-center">
      {{ trans('page.rooms.title') }}
      <a href="{{ route('rooms.index') }}" class="btn btn-sm btn-block-option text-danger">
        <i class="fa fa-xs fa-chevron-left me-1"></i>
        {{ trans('button.back') }}
      </a>
    </div>
    <nav class="breadcrumb push my-0">
      {{ Breadcrumbs::render('rooms.edit', $room) }}
    </nav>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.rooms.edit') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('rooms.update', $room->uuid) }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf
      @method('PATCH')

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="name" class="form-label">{{ trans('Nama') }}</label>
            <span class="text-danger">*</span>
            <input type="text" name="name" id="name" value="{{ old('name', $room->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Nama Kelas') }}" onkeypress="return onlyLetter(event)">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="user_id" class="form-label">{{ trans('Wali Kelas') }}</label>
            <span class="text-danger">*</span>
            <select name="user_id" id="user_id" class="js-select2 form-select @error('user_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Wali Kelas') }}" style="width: 100%;">
              <option></option>
              @foreach ($users as $item)
              <option value="{{ $item->id }}" @if (old('user_id', $room->user_id)==$item->id) selected @endif>{{ $item->name }}</option>
              @endforeach
            </select>
            @error('user_id')
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
