<x-app.card>
    <!-- ToDo mehr Angaben zum Standartuser hinzufügen -->
    <div class="divide-y">
        <div class="pb-2 flex justify-between">
            <div>Aktueller Stand: {{$user->firstname}} {{$user->lastname}}</div>
            <div class="hidden sm:block">{{$now}}</div>
        </div>
        <div class="py-2 border-t">
            <div>{{ $student->studyFieldYear->studyField->studyProgram->name ?? __("l.studyField") . ': -' }}</div>
            <div>{{ $student->studyFieldYear->studyField->name ?? __("l.studyProgram") .  ': -' }}</div>
            <div>{{ $student->studyFieldYear->beginSemester->year ?? __("l.term") .  ': -' }}</div>
            <div>@lang('l.credits'): {{$studentsCredits ?? '-'}}</div>
        </div>
    </div>
</x-app.card>