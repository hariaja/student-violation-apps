@extends('layouts.app')
@section('title', trans('page.students.title'))
@section('hero')
<div class="content content-full">
  <h2 class="content-heading">
    {{ trans('page.students.title') }}
    <nav class="breadcrumb push my-0">
      {{ Breadcrumbs::render('students.index') }}
    </nav>
  </h2>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.students.index') }}
    </h3>
  </div>
  <div class="block-content">

    @can('students.create')
    <div class="mb-4">
      <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary">
        <i class="fa fa-plus fa-sm me-1"></i>
        {{ trans('page.students.create') }}
      </a>
    </div>
    @endcan

    <div class="my-3">
      {{ $dataTable->table() }}
    </div>

  </div>
</div>

@includeIf('students.show')
@endsection
@push('javascript')
{{ $dataTable->scripts() }}
@vite('resources/js/students/index.js')
<script>
  var urlShowDetail = "{{ route('students.show', ':uuid') }}"
  var urlDestroy = "{{ route('students.destroy', ':uuid') }}"

</script>
@endpush
