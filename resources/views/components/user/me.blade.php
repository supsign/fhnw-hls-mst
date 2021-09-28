<div>
    <x-app.card>
        <x-slot name="title">
            Benutzerdaten
        </x-slot>

        <!-- ToDo mehr Angaben zum Standartuser hinzufügen -->
        <div>
            <div>@lang('l.userName') {{ $user->firstname }} {{ $user->lastname }}</div>
            <div>@lang('l.userRole') </div>
            <div>@lang('l.userStudyCourse')</div>
            <div>@lang('l.userStudyField')</div>
        </div>
    </x-app.card>
</div>
