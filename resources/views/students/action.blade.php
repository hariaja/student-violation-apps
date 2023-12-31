@can('students.edit')
<a href="{{ route('students.edit', $uuid) }}" class="text-warning me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.students.edit') }}"><i class="fa fa-sm fa-pencil"></i></a>
@endcan
@can('students.show')
<a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-modern me-1 show-students" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.students.show') }}"><i class="fa fa-sm fa-eye"></i></a>
@endcan
@can('students.destroy')
<a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-danger me-1 delete-students" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.students.delete') }}"><i class="fa fa-sm fa-trash"></i></a>
@endcan

@vite('resources/js/utils/tooltip.js')
