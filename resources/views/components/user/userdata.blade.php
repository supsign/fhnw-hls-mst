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
                <div>@lang('l.credtis'): {{$studentCredits}}</div>
                <div class="mt-4">
                    <a href="{{ route('user.index') }}" class="button-primary ">Details</a>
                </div>
            </div>
        </div>
    </x-app.card>
</div>
