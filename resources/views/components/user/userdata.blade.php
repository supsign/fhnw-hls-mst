<div>
    <x-app.card>
        <!-- ToDo mehr Angaben zum Standartuser hinzufügen -->
            <div class="pb-2">
                <div>{{ $user->firstname }} {{ $user->lastname }}</div>
                <div>@lang('l.role'):</div>
            </div>

        <x-user.studentdata :student="$user->student"></x-user.studentdata>
    </x-app.card>
</div>
