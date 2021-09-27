<div>
    <x-app.card>
        <x-slot name="title">
            Benutzerdaten
        </x-slot>

        <!--ToDo mehr Angaben zum Standartuser hinzufügen-->
        <div>
            <div>@lang('l.userName') {{ $user->firstname }} {{ $user->lastname }}</div>
            <div>Rolle: </div>
            <div>Studiengang:</div>
            <div>Studienrichtung:</div>
        </div>
    </x-app.card>
</div>
