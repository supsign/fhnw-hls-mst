<div class="py-2 border-t">
    <div>{{ $student->studyFieldYear->studyField->studyProgram->name ?? __("l.studyField") . ': -' }}</div>
    <div>{{ $student->studyFieldYear->studyField->name ?? __("l.studyProgram") .  ': -' }}</div>
    <div>{{ $student->studyFieldYear->beginSemester->year ?? __("l.term") .  ': -' }}</div>
    <div>@lang('l.credits'): {{ $studentCredits}}</div>
    @if(isset($student->studyFieldYear))
        <div class="mt-4 flex md:flex-none text-center">
            <a href="{{route('standing.index')}}" class="button-primary md:w-auto">@lang('l.currentStatus')</a>
        </div>
    @endif
</div>
