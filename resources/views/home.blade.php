@extends('layouts.app')
@section('title', trans('page.overview.title'))
@section('hero')
<div class="content content-full">
  <h2 class="content-heading">
    {{ trans('page.overview.title') }}
    <nav class="breadcrumb push my-0">
      {{ Breadcrumbs::render('home') }}
    </nav>
  </h2>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-6 col-xl-3">
    <a class="block block-rounded block-link-shadow text-end" href="javascript:void(0)">
      <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
        <div class="d-none d-sm-block">
          <i class="fa fa-history fa-2x opacity-25"></i>
        </div>
        <div>
          <div class="fs-3 fw-semibold">{{ $items['counts'] }}</div>
          <div class="fs-sm fw-semibold text-uppercase text-muted">{{ trans('Penentuan') }}</div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-6 col-xl-3">
    <a class="block block-rounded block-link-shadow text-end" href="javascript:void(0)">
      <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
        <div class="d-none d-sm-block">
          <i class="fa fa-user fa-2x opacity-25"></i>
        </div>
        <div>
          <div class="fs-3 fw-semibold">{{ $items['users'] }}</div>
          <div class="fs-sm fw-semibold text-uppercase text-muted">{{ trans('Pengguna') }}</div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-6 col-xl-3">
    <a class="block block-rounded block-link-shadow text-end" href="javascript:void(0)">
      <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
        <div class="d-none d-sm-block">
          <i class="fa fa-school-flag fa-2x opacity-25"></i>
        </div>
        <div>
          <div class="fs-3 fw-semibold">{{ $items['rooms'] }}</div>
          <div class="fs-sm fw-semibold text-uppercase text-muted">{{ trans('Kelas') }}</div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-6 col-xl-3">
    <a class="block block-rounded block-link-shadow text-end" href="javascript:void(0)">
      <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
        <div class="d-none d-sm-block">
          <i class="fa fa-users fa-2x opacity-25"></i>
        </div>
        <div>
          <div class="fs-3 fw-semibold">{{ $items['students'] }}</div>
          <div class="fs-sm fw-semibold text-uppercase text-muted">{{ trans('Siswa') }}</div>
        </div>
      </div>
    </a>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="block block-rounded">
      <div class="block-header">
        <h3 class="block-title">
          {{ trans('Jumlah Siswa') }} <small>{{ trans('Per Kelas') }}</small>
        </h3>
      </div>
      <div class="block-content p-1 bg-body-light">
        <canvas id="room-students-chart" style="height: 290px; display: block; box-sizing: border-box; width: 580px;" width="725" height="362"></canvas>
      </div>
      <div class="block-content">
        <h6 class="block-title">
          <small>{{ trans('Keterangan :') }}</small>
        </h6>
        <div class="row items-push">
          @foreach ($items['charts'] as $item)
          <div class="col-6 col-sm-4 text-center text-sm-start">
            <div class="fs-sm fw-semibold text-uppercase text-muted">{{ "Kelas {$item->name}" }}</div>
            <div class="fs-4 fw-semibold">{{ "{$item->students_count} Siswa" }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="block block-rounded">
      <div class="block-header">
        <h3 class="block-title">
          {{ trans('Jumlah Pelanggaran') }} <small>{{ "Perbulan pada tahun " . date('Y') }}</small>
        </h3>
      </div>
      <div class="block-content p-1 bg-body-light">
        <canvas id="count-students-chart" style="height: 290px; display: block; box-sizing: border-box; width: 580px;" width="725" height="362"></canvas>
      </div>
      <div class="block-content">
        <h6 class="block-title">
          <small>{{ trans('Pelanggaran 3 Bulan Terakhir :') }}</small>
        </h6>
        <div class="row items-push">
          @foreach ($items['month'] as $data)
          <div class="col-6 col-sm-4 text-center text-sm-start">
            <div class="fs-sm fw-semibold text-uppercase text-muted">{{ $data->month_name }}</div>
            <div class="fs-4 fw-semibold">{{ "{$data->student_count} Siswa" }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('javascript')
<script>
  var chartDataUrl = "{{ route('home.chart') }}"

</script>
@endpush
@vite('resources/js/dashboard/index.js')
