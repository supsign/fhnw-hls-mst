<div class=" p-2 md:p-3 bg-gray-100 mb-3 rounded text-sm md:text-base h-full flex flex-col justify-between">
    @if ($planning->name)
        <div class="mb-1">{{ $planning->name }}</div>
    @else
        <div class="mb-1">@lang('l.planning')</div>
    @endif
    <div>
        <div>{{ $planning->studyFieldYear->studyField->studyProgram->name }}</div>
        <div>{{ $planning->studyFieldYear->studyField->name }}</div>
        <div>{{ $planning->crossQualificationYear?->crossQualification->name }}</div>
        <div>{{ $planning->specializationYear?->specialization->name }}</div>
        <div>@lang('l.startDate'): {{ $planning->studyFieldYear->beginSemester->year }}</div>
    </div>
    <div class="flex justify-between mt-1">
        <div class="text-left text-sm text-gray-500 mt-1">@lang('l.lastChange'):
            {{ $planning->updated_at->format('d.m.Y') }}</div>
        @if ($planning->is_locked)
            <div class="w-100 text-right text-gray-500 mt-1"><i class="fas fa-lock" aria-hidden="true"></i>
            </div>
        @endif
    </div>
</div>
