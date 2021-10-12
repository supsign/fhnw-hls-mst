<div class="py-2 border-t">
    <div>{{ $student->studyFieldYear->studyField->studyProgram->name ?? __("l.studyField") . ': -' }}</div>
    <div>{{ $student->studyFieldYear->studyField->name ?? __("l.studyProgram") .  ': -' }}</div>
    <div>{{ $student->studyFieldYear->beginSemester->year ?? __("l.term") .  ': -' }}</div>
    <div>@lang('l.ects'):</div>
    <div class="mt-4">
        <a href="{{ route('user.index') }}" class="button-primary ">Details</a>
    </div>
</div>
