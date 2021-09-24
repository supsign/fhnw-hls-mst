<div>
    <x-app.card>
        <x-slot name="title">
            Benutzerdaten
        </x-slot>

        <div>
            <div>Name: {{ $user->firstname }} {{ $user->lastname }}</div>
            <div>Rolle: </div>
            <div>Studiengang:</div>
            <div>Studienrichtung:</div>
        </div>
    </x-app.card>
</div>
