@can('rooms.edit')
<a href="{{ route('rooms.edit', $uuid) }}" class="text-warning me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.rooms.edit') }}"><i class="fa fa-sm fa-pencil"></i></a>
@endcan
@can('rooms.destroy')
<a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-danger me-1 delete-rooms" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.rooms.delete') }}"><i class="fa fa-sm fa-trash"></i></a>
@endcan

@vite('resources/js/utils/tooltip.js')
