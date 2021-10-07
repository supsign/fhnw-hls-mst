<div>
    <a href="">
        <div class="p-2 md:p-3 bg-gray-100 mb-3 rounded">
            <div>{{ $planning->studyFieldYear->studyField->studyProgram->name }}</div>
            <div>{{ $planning->studyFieldYear->studyField->name }}</div>
            <div>{{ $planning->name }}</div>
            <div>@lang('l.startDate'): {{ $planning->studyFieldYear->beginSemester->year }}</div>
        </div>
    </a>
</div>

