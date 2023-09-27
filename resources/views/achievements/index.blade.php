@extends('layouts.app')
@section('title', trans('page.achievements.title'))
@section('hero')
<div class="content content-full">
  <h2 class="content-heading">
    {{ trans('page.achievements.title') }}
    <nav class="breadcrumb push my-0">
      {{ Breadcrumbs::render('achievements.index') }}
    </nav>
  </h2>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.achievements.index') }}
    </h3>
  </div>
  <div class="block-content">

    @can('achievements.create')
    <div class="mb-4">
      <a href="{{ route('achievements.create') }}" class="btn btn-sm btn-primary">
        <i class="fa fa-plus fa-sm me-1"></i>
        {{ trans('page.achievements.create') }}
      </a>
    </div>
    @endcan

    <div class="my-3">
      {{ $dataTable->table() }}
    </div>

  </div>
</div>
@endsection
@push('javascript')
{{ $dataTable->scripts() }}
@vite('resources/js/achievements/index.js')
<script>
  var urlDestroy = "{{ route('achievements.destroy', ':uuid') }}"

</script>
@endpush
