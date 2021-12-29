<div>
    <div class="p-2 md:p-3 bg-gray-100 mb-3 rounded text-sm md:text-base">
        <div>{{ $planning->studyFieldYear->studyField->studyProgram->name }}</div>
        <div>{{ $planning->studyFieldYear->studyField->name }}</div>
        <div>{{ $planning->crossQualificationYear?->crossQualification->name }}</div>
        <div>{{ $planning->specializationYear?->specialization->name }}</div>
        <div>{{ $planning->name }}</div>
        <div>@lang('l.startDate'): {{ $planning->studyFieldYear->beginSemester->year }}</div>
        @if($planning->is_locked)
            <div class="w-100 text-right text-sm text-gray-500 mt-1">schreibgeschützt</div>
        @endif
    </div>
</div>

