@can('violations.edit')
<a href="{{ route('violations.edit', $uuid) }}" class="text-warning me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.violations.edit') }}"><i class="fa fa-sm fa-pencil"></i></a>
@endcan
@can('violations.destroy')
<a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-danger me-1 delete-violations" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.violations.delete') }}"><i class="fa fa-sm fa-trash"></i></a>
@endcan

@vite('resources/js/utils/tooltip.js')
