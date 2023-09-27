@extends('layouts.app')
@section('title') {{ trans('page.students.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="content-heading">
    <div class="d-flex justify-content-between align-items-sm-center">
      {{ trans('page.students.title') }}
      <a href="{{ route('students.index') }}" class="btn btn-sm btn-block-option text-danger">
        <i class="fa fa-xs fa-chevron-left me-1"></i>
        {{ trans('button.back') }}
      </a>
    </div>
    <nav class="breadcrumb push my-0">
      {{ Breadcrumbs::render('students.edit', $student) }}
    </nav>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.students.edit') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('students.update', $student->uuid) }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf
      @method('PATCH')

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="name" class="form-label">{{ trans('Nama') }}</label>
            <span class="text-danger">*</span>
            <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Nama Siswa') }}" onkeypress="return onlyLetter(event)">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="room_id" class="form-label">{{ trans('Kelas') }}</label>
            <span class="text-danger">*</span>
            <select name="room_id" id="room_id" class="js-select2 form-select @error('room_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Kelas') }}" style="width: 100%;">
              <option></option>
              @foreach ($rooms as $item)
              <option value="{{ $item->id }}" @if (old('room_id', $student->room_id)==$item->id) selected @endif>{{ $item->name }}</option>
              @endforeach
            </select>
            @error('room_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="father" class="form-label">{{ trans('Nama Ayah') }}</label>
            <span class="text-danger">*</span>
            <input type="text" name="father" id="father" value="{{ old('father', $student->father) }}" class="form-control @error('father') is-invalid @enderror" placeholder="{{ trans('Nama Ayah') }}" onkeypress="return onlyLetter(event)">
            @error('father')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="mother" class="form-label">{{ trans('Nama Ibu') }}</label>
            <span class="text-danger">*</span>
            <input type="text" name="mother" id="mother" value="{{ old('mother', $student->mother) }}" class="form-control @error('mother') is-invalid @enderror" placeholder="{{ trans('Nama Ibu') }}" onkeypress="return onlyLetter(event)">
            @error('mother')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="email" class="form-label">{{ trans('Email') }}</label>
            <span class="text-danger">*</span>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $student->email) }}" required placeholder="{{ trans('Alamat Email') }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="phone" class="form-label">{{ trans('No. Telepon') }}</label>
            <span class="text-danger">*</span>
            <input type="text" name="phone" id="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone', $student->phone) }}" oninput="formatPhoneNumber()" placeholder="{{ trans('Masukkan no. Telepon') }}">
            @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label" for="gender">{{ trans('Jenis Kelamin') }}</label>
            <span class="text-danger">*</span>
            <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
              <option value="" selected disabled>{{ trans('Pilih Jenis Kelamin') }}</option>
              @foreach (['male' => 'Laki - Laki', 'female' => 'Perempuan'] as $value => $label)
              <option value="{{ $value }}" {{ old('gender', $student->gender) == $value ? 'selected' : '' }}>{{ $label }}</option>
              @endforeach
            </select>
            @error('gender')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="row">
            <div class="col-md-7">
              <div class="form-floating mb-4">
                <input type="text" name="place_of_birth" id="place_of_birth" class="form-control @error('place_of_birth') is-invalid @enderror" value="{{ old('place_of_birth', $student->place_of_birth) }}" onkeypress="return hanyaHuruf(event)" placeholder="{{ trans('Tempat Lahir') }}">
                @error('place_of_birth')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="place_of_birth" class="form-label">{{ trans('Tempat Lahir') }}</label>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-floating mb-4">
                <input type="text" class="js-flatpickr form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" min="{{ date('Y-m-d') }}" placeholder="{{ trans('Select Tanggal Lahir') }}" value="{{ old('date_of_birth', $student->date_of_birth) }}">
                <label for="date_of_birth" class="form-label">{{ trans('Tanggal Lahir') }}</label>
                @error('date_of_birth')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="mb-4">
            <label for="address" class="form-label">{{ trans('Alamat Lengkap') }}</label>
            <span class="text-danger">*</span>
            <textarea name="address" id="address" style="height: 130px" class="form-control @error('address') is-invalid @enderror" placeholder="{{ trans('Alamat Lengkap') }}">{{ old('address', $student->address) }}</textarea>
            @error('address')
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
