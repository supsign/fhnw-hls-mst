<div>
    <x-app.card>
        <!-- ToDo mehr Angaben zum Standartuser hinzufügen -->
        <div class="divide-y">
            <div class="pb-2">
                <div>{{ $user->firstname }} {{ $user->lastname }}</div>
                @if($user->role !== 'student')
                    <div>@lang('l.role'):</div>
                @endif
            </div>

            <div class="py-2">
                <div>@lang('l.studyField'):</div>
                <div>@lang('l.studyProgram'):</div>
                <div>@lang('l.term'):</div>
                <div>@lang('l.ects'):</div>
                <div class="mt-4 flex md:flex-none text-center">
                    <a href="" class="button-primary md:w-auto">aktueller Studienstand</a>
                </div>
            </div>
        </div>
    </x-app.card>
</div>
