@can('achievements.edit')
<a href="{{ route('achievements.edit', $uuid) }}" class="text-warning me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.achievements.edit') }}"><i class="fa fa-sm fa-pencil"></i></a>
@endcan
@can('achievements.destroy')
<a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-danger me-1 delete-achievements" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.achievements.delete') }}"><i class="fa fa-sm fa-trash"></i></a>
@endcan

@vite('resources/js/utils/tooltip.js')
