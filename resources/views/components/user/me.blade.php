<div>
    <x-app.card>
        <x-slot name="title">
            Benutzerdaten
        </x-slot>

        <!-- ToDo mehr Angaben zum Standartuser hinzufügen -->
        <div>
            <div>@lang('l.userName') {{ $user->firstname }} {{ $user->lastname }}</div>
            <div>@lang('l.role') </div>
            <div>@lang('l.studyField')</div>
            <div>@lang('l.studyProgram')</div>
        </div>
    </x-app.card>
</div>
