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
      {{ Breadcrumbs::render('counts.show', $count) }}
    </nav>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.counts.show') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <div class="row">
      <div class="col-md-6">
        <p class="h6 fw-semibold mb-2">
          {{ trans('Detail Data Siswa') }}
        </p>
        <ul class="list-group push">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Nama Siswa') }}
            <span class="fw-semibold">{{ $count->student->name }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Nomor Telepon Siswa') }}
            <span class="fw-semibold">{{ $count->student->phone }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Kelas') }}
            <span class="fw-semibold">{{ $count->student->room->name }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Nama Ayah') }}
            <span class="fw-semibold">{{ $count->student->father }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Nama Ibu') }}
            <span class="fw-semibold">{{ $count->student->mother }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Wali Kelas') }}
            <span class="fw-semibold">{{ $count->student->room->user->name }}</span>
          </li>
        </ul>
      </div>
      <div class="col-md-6">
        <p class="h6 fw-semibold mb-2">
          {{ trans('Detail Data Pelanggaran dan Prestasi Siswa') }}
        </p>
        <ul class="list-group push">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Kode Prestasi') }}
            <span class="fw-semibold">{{ $count->achievement->code }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Prestasi Siswa') }}
            <span class="fw-semibold">{{ $count->achievement->name }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Point Prestasi') }}
            <span class="fw-semibold">{{ "{$count->achievement->point} Point" }}</span>
          </li>
        </ul>
        <ul class="list-group push">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Kode Pelanggaran') }}
            <span class="fw-semibold">{{ $count->violation->code }}</span>
          </li>
          <li class="list-group-item">
            {{ trans('Pelanggaran Yang Dilakukan Siswa') }}
            <p class="fw-semibold mb-0" style="text-align: justify">{{ $count->violation->name }}</p>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Point Pelanggaran') }}
            <span class="fw-semibold">{{ "{$count->violation->point} Point" }}</span>
          </li>
        </ul>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <p class="h6 fw-semibold mb-2">
          {{ trans('Kesimpulan atau Hasil Perhitungan') }}
        </p>
        <ul class="list-group push">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Jam Ditetapkan') }}
            <span class="fw-semibold">{{ $count->created_at->locale('id')->format('H:i') . " WIB" }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Tanggal Ditetapkan') }}
            <span class="fw-semibold">{{ Helper::parseDateTime($count->created_at) }}</span>
          </li>
          <li class="list-group-item">
            <p class="fw-normal mb-0" style="text-align: justify">{!! trans("Berdasarkan hasil perhitungan yang dilakukan oleh Logika Fuzzy Tsukamoto, dengan nilai point prestasi sebesar <strong>{$count->achievement->point} point</strong> dan nilai point pelanggaran sebesar <strong>{$count->violation->point} point</strong> maka <strong>{$count->student->name}</strong> dinyatakan mendapatkan <strong>{$count->qualification}</strong> berupa <strong>{$count->description}</strong> dengan score atau nilai fuzzy sebesar <strong>{$count->score}</strong>") !!}</p>
          </li>
        </ul>
      </div>
    </div>

  </div>
</div>
@endsection
